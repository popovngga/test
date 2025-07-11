<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\TokenObserver;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $token
 * @property CarbonImmutable $created_at
 * @property User $user
 */
#[ObservedBy(TokenObserver::class)]
class Token extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
    ];

    public function lotteryAttempts(): HasMany
    {
        return $this->hasMany(LotteryAttempt::class);
    }

    public function lastLotteryAttempts(int $count = 3): HasMany
    {
        return $this->lotteryAttempts()->latest()->take($count);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        $validityDays = config('lifetime.token.days');

        return $this->created_at >= now()->subDays($validityDays);
    }
}
