<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\reg;
use App\Models\Register;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect()->route('adminlogin');
        }

        // Return the dashboard view
        return view('dashboard');
    }
    public function profile_admin(Request $request) {    
        $userId = session('user'); // Retrieve the user ID from the session
        $user = Register::findOrFail($userId); // Fetch the user
    
        return view('profile_admin', compact('user'));
    }
    public function show(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9]+$/',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[\w\.-]+@[\w\.-]+\.\w+$/', // Basic email format validation
            ],
                'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{6,}$/',
            ],
                'profile_pic' => [
                'required',
                'mimes:jpeg,png,jpg',
                'max:2000', // Maximum file size in kilobytes
            ],
        ], [
            'username.required' => 'Username is required.',
            'username.regex' => 'Username format is invalid.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'Email format is invalid.',
            'password.required' => 'Password is required.',
            'password.min' => 'The password must be at least 6 characters long.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            'profile_pic.required' => 'Profile picture is required.',
            'profile_pic.mimes' => 'Profile picture must be a file of type: jpeg, png, jpg.',
            'profile_pic.max' => 'Profile picture size must not exceed 2MB.',
        ]);
    
        return redirect()->back()->with('success', 'Updated successful!');
    }
    
    public function description()
    {
        return view('description1');
    }
    public function fetch_user()
    {
        $users = Reg::all(); 
        return view('user-management_admin', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registers,email',
            'status' => 'required|string|in:active,inactive,suspended',
            'password' => 'required|string|min:5', // Validate password
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        Reg::create($validatedData);


        return redirect()->route('user-management_admin')->with('success', 'User added successfully!');
    }
    public function destroy($id)
    {
        $user = Reg::findOrFail($id);
        $user->delete();

        return redirect()->route('user-management_admin')->with('success', 'User deleted successfully!');
    }
    public function update(Request $request, $id)
    {
        $user = Reg::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:reg,email,' . $user->id,
            'status' => 'required|string|in:active,suspended,inactive',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');

        $user->save();

        return redirect()->route('user-management_admin')->with('success', 'User updated successfully');
    }


    public function listCategories()
    {
        // Get all categories
        $categories = Category::all();
    
        // Initialize an empty array for books
        $data = [];
    
        // Fetch books for each category
        foreach ($categories as $category) {
            // Get books where category_id matches the current category's id
            $data[$category->name] = Book::where('category_id', $category->id)->get();
        }
    
        // Return the view with categories and books data
        return view('categories', compact('categories', 'data'));
    }
    

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.list')->with('success', 'Category added successfully.');
    }
    public function showCategory($name)
    {
        // Get all categories for the tabs
        $categories = Category::all();
    
        // Get books for the selected category
        $category = Category::where('name', $name)->firstOrFail();
        $books = Book::where('category_id', $category->id)->get(); // Assuming books have a category_id
    
        // Return the view with categories and books
        return view('categories', compact('categories', 'books', 'category'));
        
    }
    
 public function showBooksByCategory()
    {
        $categories = Category::all();
        $data = [];

        foreach ($categories as $category) {
            // Fetch books that belong to the current category by category ID
            $data[$category->id] = Book::where('category_id', $category->id)->get();
        }

        return view('categories', compact('categories', 'data'));
    }

  
public function updateCategory(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Find the category by ID and update it
    $category = Category::findOrFail($id);
    $category->update([
        'name' => $request->name,
    ]);

    return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
}

public function deleteCategory($id)
{
    // Find the category by ID and delete it
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.list')->with('success', 'Category deleted successfully.');
}




    // public function books()
    // {
    //     $data = [
    //         'vedas' => [
    //             [
    //                 'id' => 1,
    //                 'name' => 'Rig veda',
    //                 'image' => 'images/vedas/rig-veda.jpg',
    //                 'description' => 'The Rig Veda contains hymns about their mythology',
    //                 'buy_link' => 'https://example.com/buy-rigveda',
    //                 'read_link' => 'https://example.com/read-rigveda',
    //                 'class' => '' // No custom class for this book
    //             ],
    //             [
    //                 'id' => 2,
    //                 'name' => 'Sam veda',
    //                 'image' => 'images/vedas/sam-veda.jpg',
    //                 'description' => ' The Sama Veda consists mainly of hymns about religious rituals.',
    //                 'buy_link' => 'https://example.com/buy-rigveda',
    //                 'read_link' => 'https://example.com/read-rigveda',
    //                 'class' => '' // No custom class for this book
    //             ],[
    //                 'id' => 3,
    //                 'name' => 'Yajur veda',
    //                 'image' => 'images/vedas/yajur-veda.jpg',
    //                 'description' => 'The Yajur Veda contains instructions for religious rituals.',
    //                 'buy_link' => 'https://example.com/buy-rigveda',
    //                 'read_link' => 'https://example.com/read-rigveda',
    //                 'class' => '' // No custom class for this book
    //             ],[
    //                 'id' => 4,
    //                 'name' => 'Athrv veda',
    //                 'image' => 'images/vedas/Athrv-veda.jpg',
    //                 'description' => 'The Atharva Veda consists of spells against enemies, sorcerers, and diseases',
    //                 'buy_link' => 'https://example.com/buy-rigveda',
    //                 'read_link' => 'https://example.com/read-rigveda',
    //                 'class' => '' // No custom class for this book
    //             ],
    //             // Add other Vedas here
    //         ],
    //         'mahakavyas' => [
    //             [
    //                 'id' => 1,
    //                 'name' => 'Bhagavad Gita',
    //                 'image' => 'images/mahakavyas/bhagwatgita.jpg',
    //                 'description' => ' Bhagavad Gita is a dialogue between Prince Arjuna and Krishna',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'bhagwat-gita' // No custom class for this book
    //             ],
    //             [
    //                 'id' => 2,
    //                 'name' => 'Ramayan',
    //                 'image' => 'images/mahakavyas/ramayan-mahakavya.webp',
    //                 'description' => 'Ramayana the epic tells the lifes journey of Rama how they survieved in jungle for 14 years',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'ramayan' // No custom class for this book
    //             ], [
    //                 'id' => 3,
    //                 'name' => 'Mahabharat',
    //                 'image' => 'images/mahakavyas/mahabharata-mahakavya.jpg',
    //                 'description' => 'Mahabharat is the struggles between two groups of cousins to gain supreme power',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'mahabharat' // No custom class for this book
    //             ], [
    //                 'id' => 4,
    //                 'name' => 'Naishadha',
    //                 'image' => 'images/mahakavyas/naishadha.jpg',
    //                 'description' => 'On the Life of King Nala and Queen Damayanti, 22 cantos',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'naishadha' // No custom class for this book
    //             ], [
    //                 'id' => 5,
    //                 'name' => 'Kumarasambhava',
    //                 'image' => 'images/mahakavyas/kumarasambhava-mahakavya.jpg',
    //                 'description' => 'The wedding of Shiva and Parvati, and the birth of Kumara.',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'kumarasambhava' // No custom class for this book
    //             ], [
    //                 'id' => 6,
    //                 'name' => 'Bhavanamrita',
    //                 'image' => 'images/mahakavyas/bhavanamrita-mahakavya.jpg',
    //                 'description' => 'Bhavanamrita is a Eternal Nectarean Medition on Sri Krsna.',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'bhagavata' // No custom class for this book
    //             ], [
    //                 'id' => 7,
    //                 'name' => 'Raghuvansh',
    //                 'image' => 'images/mahakavyas/Raghuvansh-mahakavya.webp',
    //                 'description' => 'The line of kings of the Raghu dynasty that includes Raghu.',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'raghuvansh' // No custom class for this book
    //             ], [
    //                 'id' => 8,
    //                 'name' => 'Shishupala',
    //                 'image' => 'images/mahakavyas/Shishupala-mahakavya.webp',
    //                 'description' => 'The slaying of Shishupala by Krishna, 22 cantos (about 1800 verses)',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'shishupala' // No custom class for this book
    //             ], [
    //                 'id' => 9,
    //                 'name' => 'kiratarjuniya',
    //                 'image' => 'images/mahakavyas/kiratarjuniya-mahakavaya.jpg',
    //                 'description' => 'Arjuna s encounter with a Kirata (Shiva) 18 cantos',
    //                 'buy_link' => 'https://example.com/buy-bhagavata-purana',
    //                 'read_link' => 'https://example.com/read-bhagavata-purana',
    //                 'class' => 'Bhagavata' // No custom class for this book
    //             ],
    //             // Add other Puranas here
    //         ],
            
    //         'puranas' => [
    //             [
    //                 'id' => 1,
    //                 'name' => 'Vishnu Puran',
    //                 'image' => 'images/Vishnu-purana.jpg',
    //                 'description' => 'The Vishnu Purana describes the mythology and genealogy of the gods.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'Vishnu-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 2,
    //                 'name' => 'Agni Purana',
    //                 'image' => 'images/Agni-purana.jpg',
    //                 'description' => 'The Agni Purana focuses on rituals and ceremonies.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'Agni-book' // Custom class for wider books
    //             ],
                
    //             [
    //                 'id' => 3,
    //                 'name' => 'Shiv Puran',
    //                 'image' => 'images/shiv-puran.jpg',
    //                 'description' => 'The Shiv Purana discusses the worship of Shiva.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'Shiv-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 4,
    //                 'name' => 'Kurma Purana',
    //                 'image' => 'images/kurma-purana.jpg',
    //                 'description' => 'The Kurma Purana includes stories and teachings of Kurma, the tortoise avatar of Vishnu.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'kurma-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 5,
    //                 'name' => 'Garuda Purana',
    //                 'image' => 'images/garuda-purana.jpg',
    //                 'description' => 'The Garuda Purana is one of the major Puranas in Hinduism',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'garuda-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 6,
    //                 'name' => 'Brahmanda Purana',
    //                 'image' => 'images/Brahmanda-purana.jpg',
    //                 'description' => 'The Brahmanda Purana is one of the eighteen Mahāpurāṇas',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'Brahmanda-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 7,
    //                 'name' => 'Brahma Purana',
    //                 'image' => 'images/brahma-purana.jpg',
    //                 'description' => 'The Brahma Purana is known for its extensive coverage of cosmology.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'Brahma-book' // Custom class for wider books
    //             ],
    //             [
    //                 'id' => 8,
    //                 'name' => 'Bhagavat Purana',
    //                 'image' => 'images/bhagavat-purana.jpg',
    //                 'description' => 'The Bhagavat Purana is renowned for its extensive coverage of the life.',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'garuda-book' // Custom class for wider books
    //             ],
               
    //             [
    //                 'id' => 9,
    //                 'name' => 'Vamana Purana',
    //                 'image' => 'images/Vamana-purana.jpg',
    //                 'description' => 'The Purana focuses on the Vamana avatar of Vishnu.It covers aspects of the creation of the universe',
    //                 'buy_link' => 'https://example.com/buy-ramayana',
    //                 'read_link' => 'https://example.com/read-ramayana',
    //                 'class' => 'vamana-book' // Custom class for wider books
    //             ],
    //             // Add other Mahakavyas here
    //         ],
    //     ];

    //     return view('books', compact('data'));
    // }
   

}
