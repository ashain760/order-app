<?php
namespace App\Facade\Login;

use App\Repositories\mysql\LoginRepository;
use Carbon\Carbon;

class Login{

    public function __construct(
        LoginRepository $loginRepository
    ) {
        $this->loginRepository = $loginRepository;
    }

    /**
     * @param $loginReq
     * @param $user
     * @return array|null
     */
    public function getToken($loginReq, $user){
        if(md5($loginReq['password']) == $user->password) {
            $token = $user->createToken('authToken');
            return [
                'access_token' => $token->accessToken,
            ];
        }
        return null;
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\CustomErrorException
     */
    public function getUser($loginReq){
       return $this->loginRepository->getUser($loginReq);
    }

}
