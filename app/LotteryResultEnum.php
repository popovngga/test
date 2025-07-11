<?php

declare(strict_types=1);

namespace App;

enum LotteryResultEnum: string
{
    case WIN = 'Win';

    case LOSE = 'Lose';
}
