<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Token;
use Illuminate\Support\Str;

class TokenObserver
{
    public function creating(Token $token): void
    {
        $token->id = Str::uuid();
    }
}
