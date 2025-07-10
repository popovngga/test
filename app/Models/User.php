<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property string $token
 * @property CarbonImmutable|null $token_expires_at
 */
class User extends Authenticatable
{
    use HasFactory;

    private const TOKEN_VALIDITY_DAYS = 7;

    protected $casts = [
        'token_expires_at' => 'immutable_datetime',
    ];

    protected $fillable = [
        'username',
        'phone',
        'token_expires_at',
        'token',
    ];

    public function lotteryAttempts(): HasMany
    {
        return $this->hasMany(LotteryAttempt::class);
    }

    public function lastLotteryAttempts(int $count = 3): HasMany
    {
        return $this->lotteryAttempts()->latest()->take($count);
    }

    public function hasValidToken(): bool
    {
        return !!$this->token_expires_at?->isFuture();
    }

    public function regenerateToken(): self
    {
        $this->token = Str::uuid();
        $this->token_expires_at = CarbonImmutable::now()->addSeconds(self::TOKEN_VALIDITY_DAYS);
        $this->save();

        return $this;
    }

    public function invalidateToken(): self
    {
        $this->token_expires_at = null;
        $this->save();

        return $this;
    }
}
