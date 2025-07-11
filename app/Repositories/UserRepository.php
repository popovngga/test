<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CreateUserDto;
use App\Models\Token;
use App\Models\User;

class UserRepository
{
    public function firstOrCreate(CreateUserDto $createUserDto): User
    {
        return User::query()->firstOrCreate($createUserDto->toArray());
    }

    public function createToken(User $user): Token
    {
        return $user->tokens()->create();
    }

    public function createUserAndAssignToken(CreateUserDto $createUserDto): Token
    {
        return $this->createToken(
            $this->firstOrCreate($createUserDto)
        );
    }
}
