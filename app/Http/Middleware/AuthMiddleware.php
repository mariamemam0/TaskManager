<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return apiResponse(401, 'Unauthorized - No Token');
        }

        $tokenRecord = Token::where('token', $token)
            ->with('user')
            ->first();

        if (!$tokenRecord) {
            return apiResponse(401, 'Unauthorized - Invalid Token');
        }

        $request->attributes->set('user', $tokenRecord->user);
        return $next($request);
    }
}
