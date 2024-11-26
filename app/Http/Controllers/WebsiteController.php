<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reg; 
use Illuminate\Support\Facades\Validator;
use App\Models\Contact; 
use App\Models\Category;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\website;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\wishlist;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Rules\CurrentPassword;


class WebsiteController extends Controller
{
     
    public function loading()
    {
        return view('loading');

    }
    
    public function navbar()
    {
        $categories = Category::all(); 

        return view('Nav',compact('categories'));
    }

    public function Home()
    {
        $categories = Category::all();

    // Check if any categories exist
    if ($categories->isEmpty()) {
        // Handle case where no categories exist
        // Optionally, you can set a default category or return a message
        return redirect()->route('noCategories'); // example redirect
    }

        $content = DB::table('homepage_content')->orderBy('position')->get();
        $carouselImages = $content->where('type', 'carousel');
        $sliderImages = $content->where('type', 'slider');
        $centralImage = $content->where('type', 'central_image')->first();
        $threeImages = $content->where('type', 'three_images');

        return view('home', compact('carouselImages', 'sliderImages', 'centralImage', 'threeImages','categories'));
    }

    public function HomeUpdateForm()
    {
        $content = DB::table('homepage_content')->orderBy('position')->get();
        $carouselImages = $content->where('type', 'carousel');
        $sliderImages = $content->where('type', 'slider');
        $centralImage = $content->where('type', 'central_image')->first();
        $threeImages = $content->where('type', 'three_images');
    
        return view('update_homepage', compact('carouselImages', 'sliderImages', 'centralImage', 'threeImages'));
    }
    public function updateHomepageContent(Request $request)
    {
        $request->validate([
            'carousel_images.*.image_url' => 'required|url',
            'carousel_images.*.alt_text' => 'required|string',
            'slider_images.*.image_url' => 'required|url',
            'slider_images.*.alt_text' => 'required|string',
            'central_image.image_url' => 'required|url',
            'three_images.*.image_url' => 'required|url',
            'three_images.*.link' => 'required|url',
        ]);
    
        // Update Carousel Images
        foreach ($request->carousel_images as $index => $image) {
            DB::table('homepage_content')
                ->where('id', $carouselImages[$index]->id) // Ensure you have IDs
                ->update(['image_url' => $image['image_url'], 'alt_text' => $image['alt_text']]);
        }
    
        // Update Slider Images
        foreach ($request->slider_images as $index => $image) {
            DB::table('homepage_content')
                ->where('id', $sliderImages[$index]->id)
                ->update(['image_url' => $image['image_url'], 'alt_text' => $image['alt_text']]);
        }
    
        // Update Central Image
        if ($request->central_image) {
            DB::table('homepage_content')
                ->where('id', $centralImage->id)
                ->update(['image_url' => $request->central_image['image_url'], 'alt_text' => $request->central_image['alt_text']]);
        }
    
        // Update Three Images
        foreach ($request->three_images as $index => $image) {
            DB::table('homepage_content')
                ->where('id', $threeImages[$index]->id)
                ->update(['image_url' => $image['image_url'], 'link_url' => $image['link']]);
        }
    
        // Redirect to the home page after the update
        return redirect()->route('home')->with('success', 'Homepage content updated successfully.');
    }
    
    public function about()
{
    // Fetch all categories
    $categories = Category::all(); 

    // Fetch about details
    $aboutDetails = DB::table('about_details')->first();

    // Pass both categories and about details to the view
    return view('about', [
        'aboutDetails' => $aboutDetails,
        'categories' => $categories
    ]);
}


    public function showUpdateForm()
{
    $aboutDetails = DB::table('about_details')->first();

    return view('update-about', ['aboutDetails' => $aboutDetails]);
}

public function updateabout(Request $request)
{
    $request->validate([
        'image_path' => 'required|string|max:255',
        'text_content' => 'required|string',
    ]);

    DB::table('about_details')->update([
        'image_path' => $request->input('image_path'),
        'text_content' => $request->input('text_content'),
    ]);

    return redirect()->route('about')->with('success', 'About details updated successfully.');
}


public function search(Request $request)
{
    $query = $request->input('query');
    $query = htmlspecialchars($query);
    $books = Book::where('name', 'like', '%' . $query . '%')->get();

    return view('search_results', ['books' => $books, 'query' => $query]);
}


public function vedas()
{
    $categories = Category::all();
    $books = Book::where('category', 'Vedas')->get(); // Example: fetching books under 'Vedas' category

    return view('vedas', compact('categories', 'books'));
}


public function puranas()
{
    $puranas_id = Book::where('category', 'Puranas')->get();
    
    $puranas = Book::where('category', 'Puranas')->get(); 
    return view('puranas', ['books' => $puranas,'get_id' => $puranas_id]);
}

public function mahakavyas()
{

    $mahakavyas = Book::where('category', 'Mahakavyas')->get(); 
    return view('mahakavyas', [
        'books' => $mahakavyas,
    ]);}



    public function description2($id)
    {
        $categories = Category::all(); // Assuming you have a Category model
    // Other logic...
        $book = Book::findOrFail($id);
        return view('description', compact('categories', 'book'));
    }
      
      
      
    public function addToWishlist(Request $request)
    {
        // Check if user is logged in
        if (!Session::has('email')) {
            return response()->json(['success' => false, 'message' => 'User not logged in'], 401);
        }
    
        // Validate the incoming data
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);
    
        // Add the book to the wishlist (adjust this part to match your database structure)
        $userId = Session::get('id'); // Get the logged-in user ID from the session
        $bookId = $request->book_id;
    
        // Assuming you have a Wishlist model with user_id and book_id
        $wishlistItem = Wishlist::firstOrCreate([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);
    
        return response()->json(['success' => true, 'message' => 'Book added to wishlist!']);
    }
    
    public function wishlist()
    {
        $vedasBooks = Book::where('category', 'Vedas')->get();
        $user_id = auth()->id();
        $wishlistBooks = Wishlist::where('user_id', $user_id)->with('book')->get()->pluck('book');
        return view('Fav', ['books' => $wishlistBooks, 'book' => $vedasBooks]);
    }

public function remove($id)
    {
        $user_id = auth()->id();
        $wishlist = Wishlist::where('user_id', $user_id)->where('book_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            session()->flash('success');
        } else {
            session()->flash('info');
        }
        return redirect()->route('wishlist');
    }


   
    public function profile_page()
    { 
            // Retrieve the user's email from the session, assuming it's stored there.
          $userEmail = session('email');  // Make sure 'email' is the correct session key
      
          if (!$userEmail) {
              return redirect()->route('login'); // Or handle the error appropriately
          }
      
          // Fetch user data from the Reg table using the email stored in the session
          $user = Reg::where('email', $userEmail)->first();
      
          if (!$user) {
              abort(404, 'User not found');  // Handle case where user is not found in 'reg'
          }
      
            return view('profile_page', ['user' => $user]);
        
    }
    
    
    
    
    
    
    
    public function Login()
    {
        $categories = Category::all(); // Adjust this as necessary based on your model and table structure

        // Pass the categories to the view
        return view('Login', compact('categories'));
    }
    public function showlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ], [
            'role.required' => 'Role selection is required.',
            'role.in' => 'Invalid role selected.',
        ]);
    
        $user = reg::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'The email address does not exist.'])->withInput();
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
        }
    
        // Check if the user is inactive
        if ($user->status !== 'Active') { // Assuming 'status' is the field that indicates active/inactive
            return redirect()->back()->withErrors(['status' => 'Your account is inactive. Please contact support.'])->withInput();
        }
    
        // Log in the user and set session variables
        Auth::login($user);
        session([
            'id' => $user->id, // Set user ID in session
            'name' => $user->name,
            'email' => $user->email,
        ]);
    
        // Redirect based on role
        if ($request->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Admin login successful!');
        } else {
            return redirect()->route('Home')->with('success', 'User login successful!');
        }
    }
    
    
    public function logout(Request $request)
    {
        $request->session()->flush();

        // Optionally invalidate the user session and logout
        Auth::logout();
    
        // Flash a message to the session
        $request->session()->flash('message', 'You have been logged out successfully.');

       return redirect("Login");
    }

  

    public function showLoginForm(Request $request)
    {
        $role = $request->input('role');
        
        if ($role === 'admin') {
            return view('adminlogin'); 
        } else {
            return view('Login'); 
        }
    }
    

    public function register()
    {
        return view('Register');
    }
    public function showregister(Request $request)
    {
        // Validate the registration form
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[A-Za-z][A-Za-z0-9]*$/', 'max:255'],
            'email' => 'required|email|max:255|unique:reg,email',
            'password' => [
                'required',
                'string',
                'min:5',
                'max:20',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
                'confirmed',
            ],
            'password_confirmation'=>'required'
        ]);
    
        $reg = new Reg();
        $reg->name = $request->name;
        $reg->email = $request->email;
        $reg->password = Hash::make($request->password);
    
        // Generate a token and assign it
        $token = Str::random(60);
        $reg->token = $token;
        $reg->save(); // Save the record to the database
    
        // Generate the activation link
        $activationLink = url('/verifyAccount/' . $reg->email . '/' . $token);
        Log::info('Activation link: ' . $activationLink);
    
        $data = [
            'name' => $request->name,
            'activationLink' => $activationLink,
            'email' => $request->email,
            'token' => $token,
        ];
    
        // Send the activation email
        Mail::send('emails.activation', ['data1' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['name']);
            $message->from('dhubipatel256@gmail.com', 'dhruvibhalani');
            $message->subject('Account Activation');
        });
    
        // Flash message to the session
        $request->session()->flash('success', 'Registration successful! A verification link has been sent to your email address.');
    
        return redirect('Home'); // Redirect to the home page
    }
    

  
    public function verify_email($email, $token)
    {
        $result = Reg::where('email', $email)->where('token', $token)->first();
        if (empty($result)) {
            session()->flash('error', 'Your account is not registered. Kindly register here.');
            return redirect('register');
        } else {
            if ($result->status == 'Active') {
                session()->flash('success', 'Your account is already activated kindly login');
            } else {
                $update = Reg::where('email', $email)->update(array('status' => 'Active'));
                if ($update) {
                    session()->flash('success', 'Your account is activated successfully.');
                } else {
                    session()->flash('error', 'Account activation failed please try after sometime.');
                }
            }   
            return redirect('Login');
        }
    }
 
  public function contact()
  {
    $categories = Category::all(); // Adjust this as necessary based on your model and table structure

        // Pass the categories to the view
        return view('Contact', compact('categories'));

  }
  public function submit(Request $request)
  {
      $request->validate([
          'first_name' => ['required', 'string', 'max:255', 'regex:/^(?=.*[a-zA-Z])[a-zA-Z]+$/'],
          'last_name' => ['required', 'string', 'max:255', 'regex:/^(?=.*[a-zA-Z])[a-zA-Z]+$/'],
          'email' => 'required|email|max:255',
          'phone' => 'required|digits:10',
          'message' => 'required|string|min:10',
      ], [
          'first_name.required' => 'First name is required.',
          'first_name.regex' => 'First name must contain only letters.',
          'last_name.required' => 'Last name is required.',
          'last_name.regex' => 'Last name must only contain letters.',
          'email.required' => 'Email is required.',
          'email.email' => 'Email must be a valid email address.',
          'phone.required' => 'Phone number is required.',
          'phone.digits' => 'Phone number must be exactly 10 digits.',
          'message.required' => 'Message is required.',
          'message.min' => 'Message must be at least 10 characters long.',
      ]);
  
    
      $Con = new Contact();
      $Con->first_name = $request->first_name;
      $Con->last_name = $request->last_name;
      $Con->email = $request->email;
      $Con->phone = $request->phone;
      $Con->message = $request->message;

      $Con->save(); // Save the record to the database
  
    
      $data = [
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'email' => $request->email,
          'message' => $request->message,
              ];
  
      // Send the activation email
      Mail::send('contact_message', ['data1' => $data], function ($message) use ($data) {
          $message->to($data['email'], $data['first_name']);
          $message->from('dhruvi.bhalani4@gmail.com', 'dhruvibhalani');
          $message->subject('Message Send');
      });
  
      session()->flash('success', 'Message successfully send.');
      return redirect('Contact');  }
  
      public function showUpdateProfileForm()
      {
          // Retrieve the user's email from the session, assuming it's stored there.
          $userEmail = session('email');  // Make sure 'email' is the correct session key
      
          if (!$userEmail) {
              return redirect()->route('login'); // Or handle the error appropriately
          }
      
          // Fetch user data from the Reg table using the email stored in the session
          $regData = Reg::where('email', $userEmail)->first();
      
          if (!$regData) {
              abort(404, 'User not found');  // Handle case where user is not found in 'reg'
          }
      
          return view('update_profile', ['user' => $regData]);
      }
      
      
      
      public function update(Request $request)
      {
          // Validate the input data
          $validator = Validator::make($request->all(), [
              'name' => 'nullable|string|max:255',
              'email' => 'nullable|email|max:255',
              'Profile_Pic' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
          ]);
      
          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput();
          }
      
          // Fetch the user from the database using a method other than auth()
          $userEmail = session('email'); // Replace with how you store the user's email
          if (!$userEmail) {
              return redirect()->back()->with('error', 'User not authenticated')->withInput();
          }
      
          // Fetch the user from your database
          $user = Reg::where('email', $userEmail)->first();
      
          if (!$user) {
              return redirect()->back()->with('error', 'User not found')->withInput();
          }
      
          // Check if a profile picture is uploaded
          if ($request->hasFile('Profile_Pic')) {
              $file = $request->file('Profile_Pic');
              $originalFileName = $file->getClientOriginalName();
              $file->move(public_path('images/'), $originalFileName);
      
              // Delete old profile picture if it exists
              if ($user->Profile_Pic && file_exists(public_path('images/' . $user->Profile_Pic))) {
                  unlink(public_path('images/' . $user->Profile_Pic));
              }
      
              // Update profile picture in the database
              $user->Profile_Pic = $originalFileName;
          }
      
          // Update user information
          if ($request->filled('name')) {
              $user->name = $request->input('name');
          }
      
          if ($request->filled('email')) {
              $user->email = $request->input('email');
          }
      
          // Save updated user information
          $user->save();
      
          return redirect()->back()->with('success', 'Profile updated successfully!');
      }
      
      
      
      

public function showChangePasswordForm()
    {
        return view('change_password');
    }
    public function changePassword(Request $request)
    {
        // Retrieve the email from the session
        $userEmail = session('email');
    
        // Check if the email exists in the session
        if (!$userEmail) {
            return back()->withErrors(['user' => 'No user session found.']);
        }
    
        // Fetch the user based on the email stored in the session
        $user = Reg::where('email', $userEmail)->first();
    
        // Check if the user exists
        if (!$user) {
            return back()->withErrors(['user' => 'User not found.']);
        }
    
        // Validate the form inputs
        $request->validate([
            'password' => ['required', new CurrentPassword($user)], // Use the custom rule
            'n_password' => 'required|min:6',
            'c_password' => 'required|same:n_password',
        ]);
    
        // Update the user's password
        $user->password = Hash::make($request->n_password);
        $user->save();
    
        // Redirect back with a success message
        return redirect()->route('login')->with('success', 'Password changed successfully. Please log in with your new password.');
    }
    

      public function show(Request $request)
    {
        $plan = $request->query('plan', 'Unknown Plan');
        $plan = str_replace('_', ' ', $plan); // Format the plan name
        return view('payment', compact('plan'));
    }

    
    public function process(Request $request)
    {
        // Validate the incoming request
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
    
        // Get the email from the authenticated user
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User not authenticated.']);
        }
    
        // Define registration and expiration dates
        $registrationDate = now();
        $expirationDate = now()->addDays(30);
    
        try {
            // Check for existing user record
            $existingUser = DB::table('reg')->where('email', $user->email)->first();
    
            if ($existingUser) {
                // Update existing user's subscription details
                DB::table('reg')->where('email', $user->email)->update([
                    'plan_name' => $request->input('plan'),
                    'registration_date' => $registrationDate,
                    'expiration_date' => $expirationDate,
                ]);
            } else {
                // Insert new user into reg table
                DB::table('reg')->insert([
                    'name' => $request->input('name'),
                    'email' => $user->email,
                    'password' => bcrypt('your_default_password'), // Handle as needed
                    'registration_date' => $registrationDate,
                    'expiration_date' => $expirationDate,
                    'plan_name' => $request->input('plan'),
                ]);
            }
    
            // Redirect to the Vedas page after successful payment
            return redirect()->route('vedas'); // Change 'vedas.page' to your specific route
    
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->withErrors(['error' => 'Duplicate entry for email.']);
            }
    
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }
    

    public function handlePayment(Request $request)
{
    // Process payment logic...

    // Assuming the payment is successful:
    $user = auth()->user();
    $user->is_subscribed = true; // Or however you determine subscription status
    $user->save();

    // Redirect or show a success message
    return redirect()->route('book.details', $request->book_id);
}


    public function processPaymentLogic(array $data)
{
    // Implement your actual payment processing logic here.
    // For example, you could integrate with a payment gateway like Stripe or PayPal.

    // Placeholder logic: Simulate payment processing success.
    return true; // Change this to actual logic as needed.
}

public function description($id)
{
    $categories = Category::all();
    $book = Book::with('reviews.user')->findOrFail($id); // Eager load reviews and associated user

    // Collect reviews associated with the book
    $reviews = $book->reviews; // Fetch the reviews directly

    // Calculate the average rating
    $averageRating = Review::where('book_id', $id)->avg('rating') ?? 0;

    // Count the ratings
    $ratingCount = Review::where('book_id', $id)
        ->select('rating', DB::raw('count(*) as count'))
        ->groupBy('rating')
        ->pluck('count', 'rating');

    // Check if the book has been marked as read by the user
    $hasRead = session('pdfOpened_' . $id, false);

    return view('description', compact('book', 'categories', 'reviews', 'averageRating', 'ratingCount', 'hasRead'));
}


// Show all reviews for a book
public function showReviews($bookId)
{
    $reviews = Review::with('user')->where('book_id', $bookId)->get();

    return view('book.reviews', compact('reviews'));
}

// public function description($id)
// { 
//     $categories = Category::all();
//     $book = Book::findOrFail($id);
//     $reviews = $book ? $book->reviews : null;
//     $reviews = $book ? $book->reviews : null;
//     $averageRating = Review::where('book_id', $id)->avg('rating') ?? 0;

//     $ratingCount = Review::where('book_id', $id)
//     ->select('rating', DB::raw('count(*) as count'))
//     ->groupBy('rating')
//     ->pluck('count', 'rating');

//         if (!$book) {
//             return redirect()->back()->with('error', 'Book not found.'); // Handle case where book is not found
//         }
    
//         return view('description', compact('book','categories','reviews','averageRating', 'ratingCount')); // Pass the specific book to the view
//     }
//     public function rateBook(Request $request, $bookId)
//     {
//     $request->validate([
//         'rating' => 'required|integer|min:1|max:5',
//         'review' => 'required|string',
//     ]);

//     // Store the rating and review
//     Review::create([
//         'book_id' => $bookId,
//         'user_id' => auth()->id(),  // Get the authenticated user's ID
//         'user_name' => auth()->check() ? auth()->user()->name : 'Guest',       
//          'rating' => $request->input('rating'),
//         'comment' => $request->input('review'),
//     ]);
    
//     // Redirect back with a success message
//     return redirect()->back()->with('success', 'Review submitted successfully!');
// }

// public function showBook($bookId)
// {
//     $book = Book::findOrFail($bookId);
//     $reviews = Review::where('book_id', $bookId)->get();

//     $averageRating = Review::where('book_id', $bookId)->avg('rating') ?? 0;

//     $ratingCount = Review::where('book_id', $bookId)
//         ->select('rating', DB::raw('count(*) as count'))
//         ->groupBy('rating')
//         ->pluck('count', 'rating');

//     return view('book.show', compact('book', 'reviews', 'averageRating', 'ratingCount'));
// }

}