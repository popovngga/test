<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Token;

class TokenRepository
{
    public function retrieveActiveOrDelete(string $tokenId): ?Token
    {
        $token = Token::query()->find($tokenId);

        if ($token && !$token->isActive()) {
            $token->delete();
            return null;
        }

        return $token;
    }
}
