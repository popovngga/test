<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class InvalidTokenException extends Exception
{
    public function render(): RedirectResponse
    {
        return redirect()
            ->route('login')
            ->with('status', 'Your token is not valid anymore. Please log in again.');
    }
}
