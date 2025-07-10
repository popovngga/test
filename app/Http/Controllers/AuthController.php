<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $user = User::query()->firstOrCreate(
            ['username' => $validatedData['username']],
            $validatedData
        );

        Auth::login($user);

        return redirect()
            ->route('link', ['user' => $user->token])
            ->with('status', 'This page will be available for 7 days.');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login')
            ->with('status', 'You have been logged out.')
            ->with('color', 'orange');
    }
}
