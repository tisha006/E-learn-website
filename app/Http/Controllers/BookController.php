<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Reg;
use App\Models\Review;
use App\Models\Category;

class BookController extends Controller
{
    // public function showAddBooksPage()
    // {
    //     $categories = Category::all();

    // // Fetch books by categories
    // $vedasBooks = Book::where('category', 'vedas')->get();
    // $puranasBooks = Book::where('category', 'puranas')->get();
    // $mahakavyasBooks = Book::where('category', 'mahakavyas')->get();
    
    // // Pass categories and books to the view
    // return view('add_books', [
    //     'categories' => $categories,
    //     'vedas' => $vedasBooks,
    //     'puranas' => $puranasBooks,
    //     'mahakavyas' => $mahakavyasBooks
    // ]);
    // }

    // public function storeBook(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:1000',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',       
    //         'category' => 'required|string',
    //         'detail' => 'nullable|string|max:1000',
    //         'pdf' => 'nullable|file|mimes:pdf|max:2048'
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $imageName = time() . '-' . $file->getClientOriginalName(); 
    //         $imagePath = $file->storeAs('images', $imageName, 'public');
    //     }
    
    //     $pdfPath = null;
    //     if ($request->hasFile('pdf')) {
    //         $file = $request->file('pdf');
    //         $pdfName = time() . '-' . $file->getClientOriginalName(); 
    //         $pdfPath = $file->storeAs('pdfs', $pdfName, 'public');
    //     }
    
    //     Book::create([
    //         'name' => $request->input('name'),
    //         'description' => $request->input('description'),
    //         'image' => $imagePath,    
    //         'category' => $request->input('category'),
    //         'detail' => $request->input('detail'),
    //         'pdf' => $pdfPath
    //     ]);
    
    //     return redirect()->back()->with('success', 'Book added successfully!');
    // }
    

    // public function books()
    // {
    //     // Get all categories
    //     $categories = Category::all();
    
    //     // Prepare an associative array to store books for each category
    //     $data = [];
    
    //     // Loop through the categories and fetch books for each category using category_id
    //     foreach ($categories as $category) {
    //         $data[$category->name] = Book::where('category_id', $category->id)->get(); // Use category_id here
    //     }
    
    //     // Pass both categories and data to the view
    //     return view('books', compact('data', 'categories'));
    // }
    


    // public function edit($id)
    // {
    //     $book = Book::findOrFail($id);
    //     return view('books', compact('book'));
    // }

//     public function update(Request $request, $id)
// {
//     \Log::info($request->all());
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'description' => 'required|string',
//         'image' => 'nullable|image|max:2048',
//         'category' => 'required|string',
//         'detail' => 'nullable|string|max:1000',
//         'pdf' => 'nullable|file|mimes:pdf|max:2048'
//     ]);

//     // Fetch the book by ID
//     $book = Book::findOrFail($id);

//     // Update the book's details
//     $book->name = $request->input('name');
//     $book->description = $request->input('description');
//     $book->category = $request->input('category');

//     // Update detail only if provided; otherwise, set to null
//     $book->detail = $request->input('detail') ?? null;

//     // Handle the image update if a new image is uploaded
//     if ($request->hasFile('image')) {
//         $imagePath = $request->file('image')->store('images', 'public');
//         $book->image = $imagePath;
//     }

//     // Handle the PDF update if a new PDF is uploaded
//     // Handle the PDF update if a new PDF is uploaded
// if ($request->hasFile('pdf')) {
//     $file = $request->file('pdf');
//     $pdfName = time() . '-' . $file->getClientOriginalName();
//     $pdfPath = $file->storeAs('pdfs', $pdfName, 'public');
//     $book->pdf = $pdfPath; // Assign the new PDF path to the book
// } else {
//     $book->pdf = null; // Optionally set to null if not provided
// }

    // Save the updated book
    // $book->save();

    // // Redirect back with a success message
    // return redirect()->route('books')->with('success', 'Book updated successfully');
// }

    

    
//     public function destroy($id)
//     {
//         $book = Book::findOrFail($id);
//         $book->delete();

//         return redirect()->route('books')->with('success', 'Book deleted successfully');
//     }


public function showAddBooksPage($categoryName)
    {
        // Fetch books for the selected category
        $selectedCategoryBooks = Book::where('category', $categoryName)->get();
        
        // Fetch books for the Vedas category
        $vedas = Book::where('category', 'vedas')->get();
        
        // Fetch books for the Puranas category
        $puranas = Book::where('category', 'puranas')->get();
        
        // Fetch books for the Mahakavyas category
        $mahakavyas = Book::where('category', 'mahakavyas')->get();
        
        // Fetch other categories as needed
        $categories = Category::all();
    
        return view('add_books', compact('selectedCategoryBooks', 'vedas', 'puranas', 'mahakavyas', 'categories', 'categoryName'));
    }
     
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'detail' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:5000',
        'category_id' => 'required|exists:categories,id',
        'category' => 'required|string', // Add this line
    ]);

    $book = new Book();
    $book->name = $request->name;
    $book->description = $request->description;
    $book->detail = $request->detail;
    $book->category_id = $request->category_id;
    $book->category = $request->category; // Save the category

    // Handle Image Upload
    if ($request->hasFile('image')) {
        $book->image = $request->file('image')->store('books/images', 'public');
    }

    // Handle PDF Upload
    if ($request->hasFile('pdf')) {
        $book->pdf = $request->file('pdf')->store('books/pdfs', 'public');
    }

    $book->save();

    return redirect()->back()->with('success', 'Book added successfully!');
}




public function books($categoryName)
{
    $selectedCategoryBooks = Book::where('category', $categoryName)->get();
    $selectedMahakavyaBooks = Book::where('category', 'mahakavya')->get();
    $user = auth()->user();
    $hasPlan = $user && $user->plan_name ? true : false; // Adjust this logic if needed
    $categories = Category::all();

    // Prices for plans
    $price15days = 15.00;
    $price1month = 30.00;
    $price6months = 150.00;

    return view('vedas', compact('hasPlan', 'user', 'price15days', 'price1month', 'price6months', 'selectedCategoryBooks', 'selectedMahakavyaBooks', 'categories', 'categoryName'));
}


    // public function edit($id)
    // {
    //     $book = Book::findOrFail($id);
    //     return view('books', compact('book'));
    // }

    public function update(Request $request, $id)
{
    \Log::info($request->all());
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'category' => 'required|string',
        'detail' => 'nullable|string|max:1000',
        'pdf' => 'nullable|file|mimes:pdf|max:2048'
    ]);

    // Fetch the book by ID
    $book = Book::findOrFail($id);

    // Update the book's details
    $book->name = $request->input('name');
    $book->description = $request->input('description');
    $book->category = $request->input('category');

    // Update detail only if provided; otherwise, set to null
    $book->detail = $request->input('detail') ?? null;

    // Handle the image update if a new image is uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $book->image = $imagePath;
    }

    // Handle the PDF update if a new PDF is uploaded
    // Handle the PDF update if a new PDF is uploaded
if ($request->hasFile('pdf')) {
    $file = $request->file('pdf');
    $pdfName = time() . '-' . $file->getClientOriginalName();
    $pdfPath = $file->storeAs('pdfs', $pdfName, 'public');
    $book->pdf = $pdfPath; // Assign the new PDF path to the book
} else {
    $book->pdf = null; // Optionally set to null if not provided
}

    // Save the updated book
    $book->save();

    // Redirect back with a success message
    return redirect()->route('books')->with('success', 'Book updated successfully');
}

      
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books')->with('success', 'Book deleted successfully');
    }


    public function storeReview(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        // Create or update the review
        Review::updateOrCreate(
            ['book_id' => $id, 'user_id' => session('id')],
            [
                'rating' => $request->input('rating'),
                'review' => $request->input('review'),
            ]
        );

        // Redirect back with a success message
        return redirect()->route('description', ['id' => $id])->with('success', 'Thank you for your review!');
    }

    // Submit a rating for a book
    public function rateBook(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        // Create or update the review
        Review::updateOrCreate(
            ['book_id' => $id, 'user_id' => session('id')],
            [
                'rating' => $request->input('rating'),
                'review' => $request->input('review'),
            ]
        );

        // Redirect back with a success message
        return redirect()->route('description', ['id' => $id])->with('success', 'Thank you for your review!');
    }

    // Mark a book as read (e.g., by opening its PDF)
    public function markAsRead($id) {
        $book = Book::find($id);
        if ($book) {
            // Handle marking the book as read
            $book->read = true;
            $book->save();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 400);
    }
    
    

   

    // public function showBook($id) {
    //     $book = Book::find($id);
    //     $reviews = $book ? $book->reviews : null;
    //     $averageRating = Review::where('book_id', $bookId)->avg('rating') ?? 0;

    // // Calculate how many times each rating (1 to 5 stars) has been given
    //     $ratingCount = Review::where('book_id', $bookId)
    //     ->select('rating', DB::raw('count(*) as count'))
    //     ->groupBy('rating')
    //     ->pluck('count', 'rating');
    //      // Assuming a Book hasMany Reviews relationship
    //     return view('book.show', compact('book', 'reviews', 'averageRating', 'ratingCount'));
    // }


    public function showBook($id)
    {
        // Find the book by ID
        $book = Book::find($id);
        
        // If book doesn't exist, return an error
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }
    
        // Calculate the average rating (if no reviews exist, it will be 0)
        $averageRating = Review::where('book_id', $id)->avg('rating') ?? 0;
        
        // Fetch the rating count (how many times each rating has been given)
        $ratingCount = Review::where('book_id', $id)
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating');
    
        // Return the view with the data (no reviews passed)
        return view('book.show', compact('book', 'averageRating', 'ratingCount'));
    }
    

}
