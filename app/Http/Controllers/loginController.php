<?php
namespace App\Http\Controllers;
use App\Models\Register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }
    public function register_admin(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|max:50|min:2|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|string|email|max:50|unique:registers',
            'password' => [
                'required',
                'string',
                'min:5',
                'max:20',
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&#]/', // At least one special character
                'confirmed',
            ],
        ],[
            'name.max' => 'Name should be containing maximum 20 characters only.',
            'name.min' =>'Name should be containing atleast 2 letters',
            'name.required' => 'Name is required',
            'name.regex' => 'Name should be containing letters only.',
            'email.required' => 'Email is required.',
            'password.min' => 'Password should be at least 5 characters long.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Password and confirm password do not match.',
        ]);
    
        // Additional custom validation
        if (stripos($request->password, $request->name) !== false || stripos($request->password, $request->email) !== false) {
            return back()->withErrors(['password' => 'Password should not contain your name or email.'])->withInput();
        }
    
        // Store user data
        Register::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('adminlogin')->with('success', 'Registration successful. Please log in.');
    }


    public function showLoginForm()
    {
        return view('adminlogin');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:5|max:20',
        ]);

         $user = Register::where('email', $request->email)->first();

        if (!$user) {
             return back()->withErrors([
                 'email' => 'The email address does not match our records.',
             ])->withInput(); 
        }

        if (!Hash::check($request->password, $user->password)) {
             return back()->withErrors([
                 'password' => 'The password is incorrect.',
             ])->withInput(); 
        }

        Session::put('user', $user->id);
        return redirect()->route('dashboard');
    }

    public function a_logout(Request $request)
    {
        // Clear the session
        Session::forget('user');
        return redirect()->route('adminlogin');
    }
}

