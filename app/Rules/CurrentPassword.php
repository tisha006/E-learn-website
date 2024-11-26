<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Reg; // Ensure the correct model is used

class CurrentPassword implements Rule
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        // Check if the provided password matches the user's password
        return Hash::check($value, $this->user->password);
    }

    public function message()
    {
        return 'The provided password is incorrect.';
    }
}
