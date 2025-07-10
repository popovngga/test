<?php

declare(strict_types=1);

namespace App\Providers;

use App\Guards\SessionGuard;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Auth::extend('decorated-session', $this->makeSessionGuardDecoratorCallback());
    }

    private function makeSessionGuardDecoratorCallback(): callable
    {
        return function (Application $app, string $name, array $config) {
            $authManager = new AuthManager($app);

            $driver = $authManager->createSessionDriver($name, $config);

            return new SessionGuard($driver);
        };
    }
}
