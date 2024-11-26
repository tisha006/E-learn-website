<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\reg; // Adjust according to your model namespace
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function delete_token()
    {
        session()->remove('error');
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        reg::where('expiry_time', '<', $current_time)->delete();
    }

    public function check_token_expiry()
    {
        $result = reg::where('email', session()->get('forgot_em'))->first();
        if (empty($result)) {
            session()->flash('error', 'OTP Expired');
            return redirect('ForgotPassword');
        }
    }

    public function forgot_password(Request $req)
    {
        return view('Forgot_password');
    }

    public function send_otp(Request $req)
    {
        // Clear expired tokens
        $this->delete_token();
        
        $em = $req->email;
        $result = reg::where('email', $em)->first();

        if (!$result) {
            session()->flash('error', 'Email ID is not registered. Please enter a registered email address.');
            return redirect('ForgotPassword');
        }

        // Generate OTP
        $otp = mt_rand(100000, 999999);
        $data = ['name' => $result->name, 'email' => $em, 'otp' => $otp];

        // Send email
        try {
            Mail::send('mail_forget_pwd', ["data3" => $data], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('Password Reset');
                $message->from('your-email@example.com', 'Your Name');
            });
        } catch (Exception $ex) {
            session()->flash('error', 'We encountered an error while sending the email.');
            return redirect('ForgotPassword');
        }

        // Save OTP and its expiry time
        $expiry_time = Carbon::now()->addMinutes(2);
        
        // Save email in session for later use
        session()->put('forgot_em', $em);

        // Check if a token already exists for this email
        $token_ins = reg::updateOrCreate(
            ['email' => $em],
            [
                'otp' => $otp,
                'expiry_time' => $expiry_time,
                'name' => $result->name
            ]
        );

        if ($token_ins) {
            session()->flash('success', 'Password reset token sent to your registered email address.');
            return redirect('OTPForm');
        } else {
            session()->flash('error', 'Error saving OTP to the database.');
            return redirect('ForgotPassword');
        }
    }

    public function otp_form(Request $r)
    {
        $this->delete_token();
        $this->check_token_expiry();
        return view('otp_form');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);
    
        $email = session('forgot_em'); // Ensure this is correctly set
        $record = reg::where('email', $email)->first();
    
        if (!$record) {
            session()->flash('error', 'No record found. Please request a new OTP.');
        }
    
        if ($record->otp !== $request->otp) {
            session()->flash('error', 'Invalid OTP. Please try again.');
        }
    
        if (Carbon::now()->greaterThan($record->expiry_time)) {
            session()->flash('error', 'OTP has expired. Please request a new one.');
            return redirect('ForgotPassword'); // Redirect to resend OTP
        }
    
        session()->flash('success', 'OTP verified successfully. You can reset your password now.');
        return redirect('SetNewPassword'); // Redirect to password reset
    }
    
    public function new_password()
    {
        $this->delete_token();
        $this->check_token_expiry();
        return view('new_password');
    }

    public function update_new_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session()->get('forgot_em');
        $user = reg::where('email', $email)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->otp = null; // Clear OTP
            $user->expiry_time = null; // Clear expiry time
            $user->save();

            session()->flash('success', 'Password updated successfully');
            return redirect('Login'); // Redirect to login
        } else {
            session()->flash('error', 'Error in resetting password');
            return redirect('ForgotPassword'); // Redirect back to the form
        }
    }
}
