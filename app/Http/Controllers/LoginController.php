<?php

namespace App\Http\Controllers;

use App\Facade\Login\LoginFacade;
use App\Http\Requests\LoginRequestCheck;
use App\Repositories\mysql\LoginRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponseTrait;

    protected $loginRepository;

    public function __construct(
        LoginRepository $loginRepository
    ) {
        $this->loginRepository = $loginRepository;
    }

    /**
     * @param Request $request
     * @param LoginRequestCheck $loginRequestCheck
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\CustomErrorException
     */
    public function login(Request $request, LoginRequestCheck $loginRequestCheck){

        $loginReq = $loginRequestCheck->all();
        $user = LoginFacade::getUser($loginReq);

        // check user exist
        if(!$user){
            return $this->response('Invalid user credential', 400);
        }

        // get access token
        if($data = LoginFacade::getToken($loginReq, $user)){
            return $this->response('Login successfully', 200, $data);
        }

        return $this->response('Invalid user credential', 400);
    }
}
