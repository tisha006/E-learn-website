<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class reg extends Authenticatable
{
    use Notifiable;

    use HasFactory;
    protected $table = 'reg'; // Ensure this matches your database table
    protected $primaryKey = 'id'; // Ensure this matches your primary key column
    public $timestamps = false; // Set to true if your table has created_at and updated_at columns

    protected $fillable=[
        'name','email','password'
    ];
}
