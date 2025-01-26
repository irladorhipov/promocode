<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookies->get('jwt');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            JwtHelper::decode($token);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
