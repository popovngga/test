@extends('layout')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6 space-y-6 mx-auto mt-12">
        <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-4">Home</h1>

        <x-status-message :status="session('status')" :color="session('color')">
            @if(session('newLink'))
                <button
                    type="button"
                    onclick="copyLink(this, '{{ session('newLink') }}')"
                    class="inline-flex items-center gap-1 px-2 py-1 border border-indigo-400 rounded text-indigo-600 hover:bg-indigo-200 transition-colors text-xs"
                >
                    Copy Link
                </button>
            @endif
        </x-status-message>

        <button
            @disabled($lotteryAttemptsCount === 0)
            type="button"
            class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            onclick="window.location.href='{{ route('token.history', $token) }}'"
        >
            View Token History
        </button>

        <button
            @disabled($userLotteryAttemptsCount === 0)
            type="button"
            class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            onclick="window.location.href='{{ route('token.user.history', $token) }}'"
        >
            View User History
        </button>

        <form method="POST" action="{{ route('token.store', $token) }}">
            @csrf
            @method('POST')
            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            >
                Generate Link
            </button>
        </form>

        <form method="POST" action="{{ route('token.delete', $token) }}">
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            >
                Invalidate Current Link
            </button>
        </form>

        <form method="POST" action="{{ route('token.lucky', $token) }}">
            @csrf
            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            >
                I Am Feeling Lucky
            </button>
        </form>
        @if(session('attempt'))

        @endif
    </div>
@endsection
