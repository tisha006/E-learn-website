<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PaymentController;
Route::get('/payment', [PaymentController::class, 'show'])->name('payment');
Route::post('/payment-callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback'); // Ensure this route matches the correct controller function.
Route::get('/payment-success', function () {
    return view('payment-success'); // Create this view to display success message
})->name('payment.success');

// Route::get('/send-reminder', [SubscriptionController::class, 'sendReminder']);
Route::get('/send-reminders', [SubscriptionController::class, 'checkAndSendReminder']);
// Route::post('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');

// Route to check reminders (if you want to use it for testing purposes)
// Route::get('/subscription/reminders', [SubscriptionController::class, 'checkReminders'])->name('subscription.checkReminders');
// Route::get('/check-reminders', [SubscriptionController::class, 'checkReminders']);
// Route::get('/send-reminders', [SubscriptionController::class, 'sendReminders']);
// Route::get('/send-reminder', function () {
//     Artisan::call('subscription:reminder');
//     return response()->json(['message' => 'Reminders sent successfully']);
// });


Route::get('/book/{id}', [WebsiteController::class, 'description2'])->name('book.details');
Route::get('/books', [BookController::class, 'index'])->name('books');
Route::get('/books/{categoryName}', [BookController::class, 'books'])->name('books.show');
Route::get('/books/{id}', [BookController::class, 'showBook'])->name('books.show');
Route::post('/books/read/{id}', [BookController::class, 'read'])->name('books.read');


Route::get('/', [WebsiteController::class, 'loading']);

// User Routes
Route::get('/nav', [WebsiteController::class, 'Navbar']);

// Home Page
Route::get('/Home', [WebsiteController::class, 'Home'])->name('Home');
route::get('/homepage/update', [WebsiteController::class, 'HomeUpdateForm'])->name('homepage.edit');
Route::put('/homepage/update', [WebsiteController::class, 'updateHomepageContent'])->name('homepage.update');

// About Page
Route::get('/About', [WebsiteController::class, 'About'])->name('about');


// Contact Page
Route::get('/Contact', [WebsiteController::class, 'Contact']);
Route::post('/contact/submit', [WebsiteController::class, 'submit'])->name('contact.submit');

// Favorites Page


Route::get('/puranas', [WebsiteController::class, 'puranas'])->name('puranas');
Route::get('/mahakavyas', [WebsiteController::class, 'mahakavyas'])->name('mahakavyas');


Route::get('/Login', [WebsiteController::class, 'Login'])->name('Login');
Route::post('/Login', [WebsiteController::class, 'showlogin'])->name('login');
Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/Register', [WebsiteController::class, 'register']);
Route::post('/showregister', [WebsiteController::class, 'showregister'])->name('Register');

// Profile Routes
Route::middleware(['checkLogin'])->group(function () {

// web.php
Route::get('/profile_page', [WebsiteController::class, 'profile_page'])->name('profile_page');

Route::get('/update-profile', [WebsiteController::class, 'showUpdateProfileForm'])->name('profile.show'); // Update profile form route
Route::post('/update-profile', [WebsiteController::class, 'update'])->name('update_profile'); // Update profile action route

Route::post('/change_password', [WebsiteController::class, 'changePassword'])->name('change_password');
Route::get('/change_password', [WebsiteController::class, 'showChangePasswordForm'])->name('show_change_password_form');

// Additional Description Route (If needed)
Route::post('/add-to-wishlist', [WebsiteController::class, 'addToWishlist']);
Route::get('/wishlist', [WebsiteController::class, 'wishlist'])->name('wishlist');
Route::delete('/remove-wishlist/{id}', [WebsiteController::class, 'remove'])->name('remove.wishlist');


// Route::get('/description', [WebsiteController::class, 'description'])->name('description');



});
Route::get('/search', [WebsiteController::class, 'search'])->name('search');

Route::get('ForgotPassword', [ForgotPasswordController::class, 'forgot_password'])->name('password.request');
Route::post('SendOTP', [ForgotPasswordController::class, 'send_otp'])->name('password.email');
Route::get('OTPForm', [ForgotPasswordController::class, 'otp_form'])->name('otp.form');
route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify.otp');
Route::get('SetNewPassword', [ForgotPasswordController::class, 'new_password'])->name('password.reset');
Route::post('update-password', [ForgotPasswordController::class, 'update_new_password'])->name('password.update');



// Login and Registration Routes for Admin
//--------------------------------
//forget password

// Routes for password reset
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('reset.send.otp');

// Routes for OTP verification
Route::get('/otp-form', [ForgotPasswordController::class, 'showOtpForm'])->name('otp.form');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify.otp');

// Route for password update
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

///Activation

Route::get('verifyAccount/{email}/{token}', [WebsiteController::class, 'verify_email']);

//update about page:
Route::get('/about/update', [WebsiteController::class, 'showUpdateForm'])->name('about.showUpdateForm');

// Route to handle the form submission
Route::put('/about/updateabout', [WebsiteController::class, 'updateabout'])->name('about.update');


// Route::get('/description/{id}', [WebsiteController::class, 'description'])->name('description');
Route::get('/description/{id}', [WebsiteController::class, 'description'])->name('description');
Route::post('/books/{id}/reviews', [BookController::class, 'storeReview'])->name('books.reviews.store');

Route::post('/books/{book}/mark-as-read', [BookController::class, 'markAsRead'])->name('books.markAsRead');
Route::post('/books/{id}/rate', [BookController::class, 'rateBook'])->name('rateBook');
Route::get('/books/{id}/reviews', [WebsiteController::class, 'showReviews'])->name('reviews.show');
// Route::post('/books/{book}/reviews', [BookController::class, 'storeReview'])->name('books.reviews.store');


Route::get('/adminlogin', [LoginController::class, 'showLoginForm'])->name('adminlogin');
Route::post('/adminlogin', [LoginController::class, 'adminlogin']);
Route::post('/a_logout', [LoginController::class, 'a_logout'])->name('a_logout');

// Admin Registration Routes
Route::get('/register_admin', [LoginController::class, 'showRegisterForm'])->name('register_admin');
Route::post('/register_admin', [LoginController::class, 'register_admin']);

Route::middleware(['admin.auth'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // User Management Routes
    Route::get('/user-management_admin', [AdminController::class, 'fetch_user'])->name('user-management_admin');
    Route::post('/user/store', [AdminController::class, 'store'])->name('user.store');
    Route::delete('/user/delete/{id}', [AdminController::class, 'destroy'])->name('user.delete');
    Route::post('/users/update/{id}', [AdminController::class, 'update'])->name('user.update');

    // Profile Routes
    Route::get('/profile_admin', [AdminController::class, 'profile_admin'])->name('profile_admin');
    Route::get('/update-profile_admin', function () {
        return view('update_profile_admin');
    })->name('update_profile_admin');
    Route::post('/update-profile_admin', [AdminController::class, 'show'])->name('update_profile_admin.submit');

    Route::get('/description1', [AdminController::class, 'description'])->name('description1');

    // Books Routes
//     Route::get('/books', [BookController::class, 'books'])->name('books');
//     Route::get('/add_books', [BookController::class, 'showAddBooksPage'])->name('books.showAddBooksPage');
//     Route::post('/add_books', [BookController::class, 'storeBook'])->name('store.book');
//     Route::post('/books/update/{id}', [BookController::class, 'update'])->name('books.update');
//     Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.delete');


// Route::get('/categories', [AdminController::class, 'listCategories'])->name('categories.list');

// Route::post('/categories', [AdminController::class, 'addCategory'])->name('categories.add');

// Route::get('/category/{name}', [AdminController::class, 'showCategory'])->name('category.show');
// Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');

// Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
// Route::get('/categories/{name}/books', [AdminController::class, 'showBooksByCategory'])->name('categories.books');


    Route::get('/add-books/{categoryName}', [BookController::class, 'showAddBooksPage'])->name('add.books');
    Route::post('/books/store', [BookController::class, 'store'])->name('book.store');
    
    Route::post('/books/update/{id}', [AdminController::class, 'updatebook'])->name('books.update');
    Route::delete('/books/{id}', [AdminController::class, 'destroybook'])->name('books.destroy');

    Route::get('/categories', [AdminController::class, 'listCategories'])->name('categories.list');

    Route::post('/categories', [AdminController::class, 'addCategory'])->name('categories.add');
    
    Route::get('/category/{name}', [AdminController::class, 'showCategory'])->name('category.show');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    
    Route::delete('/categories/{id}', [adminController::class, 'deleteCategory'])->name('categories.delete');
    Route::get('/books/category/{categoryName}', [AdminController::class, 'showBooksByCategory'])->name('books.category');
});