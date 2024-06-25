<?php

namespace App\Http\Controllers;

use App\Facade\Utility\LibsFacade;
use App\Traits\ApiResponseTrait;

class PasswordGenerateController extends Controller
{
    use ApiResponseTrait;

    /**
     * @return string
     */
    public function generate(){
        return LibsFacade::generatePassword();
    }
}
