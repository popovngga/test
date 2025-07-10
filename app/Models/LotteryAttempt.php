<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryAttempt extends Model
{
    protected $fillable = [
        'amount',
        'number',
        'result',
    ];
}
