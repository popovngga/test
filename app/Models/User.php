<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property string $username
 * @property string $phone
 */
class User extends Model
{
    protected $fillable = [
        'username',
        'phone',
    ];

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    public function lotteryAttempts(): HasManyThrough
    {
        return $this->hasManyThrough(LotteryAttempt::class, Token::class);
    }

    public function lastLotteryAttempts(int $count = 3): HasMany
    {
        return $this->lotteryAttempts()->latest()->take($count);
    }
}
