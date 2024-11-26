<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reg;

use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Mail\ReminderEmail;

use App\Models\myCart;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionReminderMail;

class PaymentController extends Controller
{
    public function getUserSubscription()
    {
        $user = auth()->user(); // Ensure user is authenticated

        // Assuming plan_name is in the users table or a related subscription model
        return response()->json([
            'plan_name' => $user->plan_name // Adjust if needed
        ]);
    }
    
    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        // Ensure total is a float
        $total = (float)$request->input('total');
        $userEmail = $request->session()->get('email'); // Ensure this session variable is set during login

        $order = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $total * 100, 
            'currency' => 'INR',
        ]);

        $order_id = $order->id;

        Session::put('order_id', $order_id);
        Session::put('total', $total);
        Session::put("address", $request->address);
        Session::put("city", $request->city);
        Session::put("postal_code", $request->postal_code);

        return view('payment', [
            'order_id' => $order_id,
            'total' => $total,
            'api_key' => env('RAZORPAY_KEY_ID'),
        ]);
    }

    public function show(Request $request)
    {
        $plan = $request->query('plan', 'No Plan Selected');
        $bookId = $request->query('book_id'); // Get the book ID from the query string
    
        $planAmounts = [
            '15_days' => 500,
            '1_month' => 900,
            '6_month' => 5000,
        ];
        $total = $planAmounts[$plan] ?? 0; // Default to 0 if no valid plan selected
    
        $userEmail = session('email'); // Fetch the email from session
        if (!$userEmail) {
            return redirect('/Login')->withErrors(['error' => 'Please log in to continue.']);
        }
    
        Session::put('plan_name', $plan);
        Session::put('email', $userEmail);
        Session::put('book_id', $bookId);

        if ($total > 0) {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $order = $api->order->create([
                'receipt' => 'order_rcptid_' . time(),
                'amount' => $total * 100,
                'currency' => 'INR',
            ]);
    
            $order_id = $order['id'];
    
            return view('payment', [
                'order_id' => $order_id,
                'total' => $total,
                'api_key' => env('RAZORPAY_KEY_ID'),
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid plan selected.']);
        }
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
            'plan' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User not authenticated.']);
        }
    
        $planDurations = [
            '1 month' => 30,
            '15 days' => 15,
            '6 months' => 180,
        ];
    
        $plan = $request->input('plan');
        $durationDays = $planDurations[$plan] ?? 0;
    
        if ($durationDays === 0) {
            return redirect()->back()->withErrors(['error' => 'Invalid plan selected.']);
        }
    
        $registrationDate = now();
        $expirationDate = now()->addDays($durationDays);
    
        DB::transaction(function () use ($user, $request, $plan, $registrationDate, $expirationDate) {
            $existingUser = DB::table('reg')->where('email', $user->email)->first();
    
            $data = [
                'plan_name' => $plan,
                'registration_date' => $registrationDate,
                'expiration_date' => $expirationDate,
            ];
    
            if ($existingUser) {
                DB::table('reg')->where('email', $user->email)->update($data);
            } else {
                $data['name'] = $request->input('name');
                $data['email'] = $user->email;
                $data['password'] = bcrypt('default_password');
                DB::table('reg')->insert($data);
            }
    
            // Send reminder email
            $this->sendReminderEmail($user->email, $expirationDate);
        });
    
        return redirect()->route('vedas')->with('message', 'Subscription successfully updated!');
    }
    protected function sendReminderEmail($email, $expirationDate)
    {
        try {
            $user = Reg::where('email', $email)->first();
            if ($user) {
                $user->reminder_sent = 0; // Reset reminder status for new subscription
                $user->save();
    
                // Schedule reminder email
                Mail::to($email)->later(
                    $expirationDate->subDays(3), // Send reminder 3 days before expiration
                    new ReminderEmail($user)
                );
            }
        } catch (\Exception $e) {
            Log::error('Failed to send reminder email: ' . $e->getMessage());
        }
    }
        

    public function handlePayment(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User is not authenticated.']);
        }

        // Process payment logic...
        // Assuming payment logic is already handled in the paymentCallback

        $user->is_subscribed = true; // Update subscription status
        $user->save();

        return redirect()->route('book.details', $request->book_id);
    }

    public function paymentCallback(Request $request)
{
    try {
        // Razorpay signature verification logic
        $payment = $request->input('razorpay_payment_id');
        $order = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        $attributes = [
            'razorpay_order_id' => $order,
            'razorpay_payment_id' => $payment,
            'razorpay_signature' => $signature,
        ];

        $razorpay = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        // Verifying the payment signature using Razorpay API
        $razorpay->utility->verifyPaymentSignature($attributes);

        $user_email = session('email');
        $plan_name = session('plan_name');

        if (!$user_email || !$plan_name) {
            throw new \Exception('Session data missing.');
        }

        DB::transaction(function () use ($user_email, $plan_name) {
            $registrationDate = now();
            $expirationDate = now()->addMonths(1);

            $existingUser = DB::table('reg')->where('email', $user_email)->first();
            if ($existingUser) {
                DB::table('reg')->where('email', $user_email)->update([
                    'plan_name' => $plan_name,
                    'registration_date' => $registrationDate,
                    'expiration_date' => $expirationDate,
                ]);
            } else {
                DB::table('reg')->insert([
                    'email' => $user_email,
                    'plan_name' => $plan_name,
                    'registration_date' => $registrationDate,
                    'expiration_date' => $expirationDate,
                ]);
            }

            // Send reminder email
            $this->sendReminderEmail($user_email, $expirationDate);
        });

        return redirect('/payment-success')->with('message', 'Payment successful!');
    } catch (\Exception $e) {
        Log::error('Payment processing error: ' . $e->getMessage());

        return redirect('/payment/failure')->with('error', 'Payment failed.');
    }
}

 

    
}
