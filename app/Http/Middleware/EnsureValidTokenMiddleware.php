<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->hasValidToken()) {
            Auth::logout();

            return redirect()
                ->route('login')
                ->with('status', 'Your token is not valid anymore. Please log in again.');
        }

        return $next($request);
    }
}
