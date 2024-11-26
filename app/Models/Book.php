<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'image', 'pdf', 'category', 'detail','subscription_image', 
        'price_15days',       
        'price_1month',        
        'price_6months',
        'category_id', 
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}

}
