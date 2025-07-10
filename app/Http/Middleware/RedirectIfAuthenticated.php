<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as IlluminateRedirectIfAuthenticated;

class RedirectIfAuthenticated extends IlluminateRedirectIfAuthenticated
{
    protected function defaultRedirectUri(): string
    {
        $user = Auth::user();
        if ($user) {
            return route('link', ['user' => $user->token]);
        }

        return parent::defaultRedirectUri();
    }
}
