<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordGenerateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('/health', function (Request $request) {
        echo "Order API | Laravel Version 11 <br /> ";
        if(DB::connection()->getDatabaseName())
        {
            echo "Database Connection: Success";
        }else{
            echo "Database Connection: Failed";
        }
    });

    Route::prefix('authenticate')->group(function () {
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::middleware('auth')->group(function () {
        Route::post('orders', [OrderController::class, 'store']);
    });

    Route::prefix('password')->group(function () {
        Route::get('generate', [PasswordGenerateController::class, 'generate']);
    });

})->middleware(["cors"]);
