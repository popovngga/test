<?php

declare(strict_types=1);

namespace App\Services;

use App\LotteryResultEnum;

class LotteryService
{
    private function generateNumber(): int
    {
        return rand(1, 1000);
    }

    private function getWinPercent(int $number): float
    {
        return match (true) {
            $number > 900 => 0.7,
            $number > 600 => 0.5,
            $number > 300 => 0.3,
            default => 0.1,
        };
    }

    public function makeAttempt(): array
    {
        $number = $this->generateNumber();
        $result = $number % 2 === 0 ? LotteryResultEnum::WIN : LotteryResultEnum::LOSE;

        $amount = 0;
        if ($result === LotteryResultEnum::WIN) {
            $amount = (int) round($number * $this->getWinPercent($number));
        }

        return [
            'number' => $number,
            'result' => $result,
            'amount' => $amount,
        ];
    }
}
