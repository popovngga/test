<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Token;
use App\Repositories\UserRepository;
use App\Services\LotteryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TokenController extends Controller
{
    public function show(Token $token): View
    {
        $lotteryAttemptsCount = $token->lotteryAttempts()->count();
        $userLotteryAttemptsCount = $token->user->lotteryAttempts()->count();

        return view('token', [
            'token' => $token,
            'lotteryAttemptsCount' => $lotteryAttemptsCount,
            'userLotteryAttemptsCount' => $userLotteryAttemptsCount,
        ]);
    }

    public function store(Token $token, UserRepository $userRepository): RedirectResponse
    {
        $newToken = $userRepository->createToken($token->user);
        $newLink = route('token', ['token' => $newToken]);

        return redirect()
            ->back()
            ->with('status', 'Link has been created.')
            ->with('newLink', $newLink);
    }

    public function delete(Token $token): RedirectResponse
    {
        $token->delete();

        return redirect()
            ->route('login')
            ->with('status', 'Token has been invalidated.')
            ->with('color', 'orange');
    }

    public function showHistoryPage(Token $token): View
    {
        $attempts = $token->lastLotteryAttempts()->get();

        return view('history', [
            'lotteryAttempts' => $attempts,
        ]);
    }

    public function showUserHistoryPage(Token $token): View
    {
        $attempts = $token->user->lastLotteryAttempts()->get();

        return view('history', [
            'lotteryAttempts' => $attempts,
        ]);
    }

    public function lucky(Token $token, LotteryService $lotteryService): RedirectResponse
    {
        $pureAttempt = $lotteryService->makeAttempt();

        $attempt = $token->lotteryAttempts()->create($pureAttempt);

        [$status, $color] = $attempt->amount > 0
            ? ["Congratulations! You won $attempt->amount points.", 'green']
            : ['Sorry, you lost. Better luck next time!', 'red'];

        return redirect()
            ->back()
            ->with('status', $status)
            ->with('color', $color);
    }
}
