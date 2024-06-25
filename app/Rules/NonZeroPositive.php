<?php


namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NonZeroPositive implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is numeric and greater than zero
        return is_numeric($value) && floatval($value) > 0;
    }

    public function message()
    {
        return 'The :attribute must be a positive number greater than zero.';
    }
}
