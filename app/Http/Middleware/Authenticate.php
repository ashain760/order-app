<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    use ApiResponseTrait;

    protected $parser;

    /**
     * Authenticate constructor.
     * @param Parser $parser
     */
    public function __construct(
        Parser $parser
    ) {
        $this->parser = $parser;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the token from the request header
        $token = $request->bearerToken();

        if (!$token) {
            return $this->response('Token not provided', 401);
        }

        try {
            // Parse the token
            $jwt = $this->parser->parse($token);

            // Retrieve the token from the database
            $tokenId = $jwt->claims()->get('jti');
            $tokenRecord = Token::find($tokenId);

            if (!$tokenRecord || $tokenRecord->revoked) {
                return $this->response('Token is invalid', 401);
            }

            // Optionally check the expiration date
            if ($tokenRecord->expires_at->isPast()) {
                return $this->response('Token has expired', 401);
            }

        } catch (\Exception $e) {
            return $this->response('Unauthenticated Access', 401);
        }

        return $next($request);

    }
}
