<?php

declare(strict_types=1);

namespace App\Guards;

use Illuminate\Auth\SessionGuard as IlluminateSessionGuard;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

final readonly class SessionGuard
{
    public function __construct(
        private IlluminateSessionGuard $guard
    ) {
    }

    public function login(AuthenticatableContract $user, $remember = false): void
    {
        $this->guard->login($user, $remember);

        $this->guard->user()->regenerateToken();
    }

    public function logout(): void
    {
        $this->guard->user()?->invalidateToken();

        $this->guard->logout();
    }

    public function __call(string $name, array $arguments): mixed
    {
        return $this->guard->{$name}(...$arguments);
    }
}
