<?php

namespace App\Interfaces;

interface LoginRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function getUser($request);
}
