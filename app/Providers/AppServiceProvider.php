<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\InvalidTokenException;
use App\Repositories\TokenRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Route::bind('token', $this->getTokenBinder());
    }

    private function getTokenBinder(): callable
    {
        return function (string $token) {
            $tokenInstance = new TokenRepository()->retrieveActiveOrDelete($token);

            if (!$tokenInstance) {
               throw new InvalidTokenException();
            }

            return $tokenInstance;
        };
    }
}
