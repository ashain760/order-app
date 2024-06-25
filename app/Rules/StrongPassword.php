<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value)
    {
        // Password must be at least 6 characters and at most 16 characters
        // Must contain at least one lowercase letter, one uppercase letter,
        // one number, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/', $value);
    }

    public function message()
    {
        return 'The password must be between 6 and 16 characters, and contain at least one lowercase letter, one uppercase letter, one number, and one special character.';
    }
}
