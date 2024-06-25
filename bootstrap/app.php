<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Cors;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'cors' => Cors::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if(!env('APP_DEBUG', false)) {
            $exceptions->renderable(function (InternalErrorException $e) {
                return response()->json([
                    'error' => [
                        'code' => 500,
                        'message' => "Oops! Something Went Wrong.",
                        'trace' => "Please contact the authorized person to check this error",
                    ],
                ], 500);
            });
            $exceptions->renderable(function (RuntimeException $e) {
                return response()->json([
                    'error' => [
                        'code' => 500,
                        'message' => "Oops! Something Went Wrong.",
                        'trace' => "Please contact the authorized person to check this error",
                    ],
                ], 500);
            });
        }

        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'API URL Not Exist'
            ], 404);
        });

        $exceptions->renderable(function (ValidationException $e) {
            $errorsArr = [];
            foreach ($e->errors() as $errors) {
                $errorsArr[] = $errors[0];
            }
            return response()->json([
                'code' => 422,
                'message' => 'Validation Errors',
                'errors' => $errorsArr,
            ], 422);
        });
    })->create();
