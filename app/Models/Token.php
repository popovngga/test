<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
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
class Token extends Model
{
    use SoftDeletes;
    use HasUuids;

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
