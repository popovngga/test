<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;

final readonly class CreateUserDto implements Arrayable
{
    public function __construct(
        private string $username,
        private string $phone
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'phone' => $this->getPhone(),
        ];
    }
}
