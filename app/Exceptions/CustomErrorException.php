<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class CustomErrorException  extends Exception
{
    public function render($request)
    {
        if(env('APP_DEBUG', false)){
            return response()->json([
                'error' => [
                    'code' => $this->getCode(),
                    'message' => $this->getMessage(),
                    'trace' => $this->getTrace(),
                ],
            ], 400);
        }else{
            return response()->json([
                'error' => [
                    'code' => $this->getCode(),
                    'message' => "Oops! Something Went Wrong.",
                    'trace' => "Please contact the authorized person to check this error",
                ],
            ], 400);
        }
    }
}
