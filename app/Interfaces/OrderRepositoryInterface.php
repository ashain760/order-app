<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use phpseclib3\Math\PrimeField\Integer;

interface OrderRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function createOrder($request);
}
