<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id', 'rating', 'review'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(Reg::class, 'user_id');
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
