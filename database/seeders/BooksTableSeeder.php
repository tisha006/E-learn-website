<?php

namespace Database\Seeders;
use App\Models\Book;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'name' => 'Rigveda',
            'description' => 'Ancient collection of Vedic Sanskrit hymns.',
            'image' => 'images/krishna-book.jpg',
            'category' => 'vedas',
        ]);

        Book::create([
            'name' => 'Mahabharata',
            'description' => 'An epic narrative of the Kurukshetra War.',
            'image' => 'path/to/mahabharata.jpg',
            'category' => 'mahakavyas',
        ]);

        // Add more books as needed
   
    }
}
