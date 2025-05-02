<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated via Sanctum
        if (! Auth::guard('sanctum')->check()) {
            // If not authenticated, return an Unauthorized response
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Allow the request to proceed to the next middleware or controller
        return $next($request);
    }
}
