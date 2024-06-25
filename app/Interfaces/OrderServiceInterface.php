<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function sendOrder($data);
}
