<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = env('BASIC_AUTH_USER');
        $password = env('BASIC_AUTH_PASSWORD');

        if ($request->getUser() != $user || $request->getPassword() != $password) {
            return response('Unauthorized.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
