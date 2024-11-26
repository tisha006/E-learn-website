<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class homepage_content extends Model
{
    protected $table = 'homepage_content';  // Use 'Homepage_Content' if that’s the actual table name

    use HasFactory;
    protected $fillable = ['type', 'image_url', 'alt_text', 'link_url', 'text', 'position', 'sort_order'];
}
