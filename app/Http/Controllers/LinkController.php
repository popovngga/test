<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LotteryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function showLinkPage(User $user): View
    {
        $lotteryAttemptsCount = $user->lotteryAttempts()->count();

        return view('link', [
            'token' => $user->token,
            'lotteryAttemptsCount' => $lotteryAttemptsCount,
        ]);
    }

    public function showHistoryPage(User $user): View
    {
        return view('history', [
            'lotteryAttempts' => $user->lastLotteryAttempts()->get(),
        ]);
    }

    public function lucky(User $user, LotteryService $lotteryService): RedirectResponse
    {
        $pureAttempt = $lotteryService->makeAttempt();

        $attempt = $user->lotteryAttempts()->create($pureAttempt);

        [$status, $color] = $attempt->amount > 0
            ? ["Congratulations! You won $attempt->amount points.", 'green']
            : ['Sorry, you lost. Better luck next time!', 'red'];

        return redirect()->back()->with('status', $status)->with('color', $color);
    }

    public function invalidate(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login')
            ->with('status', 'Token has been invalidated.')
            ->with('color', 'orange');
    }

    public function renew(User $user): RedirectResponse
    {
        Auth::login($user);

        return redirect()->route('link', ['user' => $user->token])
            ->with('status', 'Token has been renewed for 7 days.')
            ->with('color', 'orange');
    }
}
