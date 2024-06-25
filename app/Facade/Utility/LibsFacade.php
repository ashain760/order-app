<?php

namespace App\Facade\Utility;
use Illuminate\Support\Facades\Facade;

class LibsFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'libs';
    }
}
