<?php

namespace App\Http\Requests;

use App\Rules\NonZeroPositive;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequestCreate extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string',
            'order_value' => 'required|numeric',
        ];
    }

}
