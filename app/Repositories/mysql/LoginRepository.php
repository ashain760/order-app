<?php


namespace App\Repositories\mysql;

use App\Exceptions\CustomErrorException;
use App\Interfaces\LoginRepositoryInterface;
use App\Models\User;

class LoginRepository implements LoginRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     * @throws CustomErrorException
     */
    public function getUser($request)
    {
        try {
            return User::where('email', $request['email'])->first();
        } catch (\Exception $e) {
            throw new CustomErrorException($e);
        }
    }
}
