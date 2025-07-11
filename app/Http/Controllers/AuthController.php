<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request, UserRepository $userRepository): RedirectResponse
    {
        $token = $userRepository->createUserAndAssignToken(
            $request->getDto()
        );

        return redirect()
            ->route('token', ['token' => $token])
            ->with('status', 'This page will be available for 7 days.');
    }
}
