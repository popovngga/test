@extends('layout')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6 space-y-6 mx-auto mt-12">
        <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-4">Home</h1>

        <x-status-message :status="session('status')" :color="session('color')" />

        <button
            @disabled($lotteryAttemptsCount === 0)
            type="button"
            class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            onclick="window.location.href='{{ route('link.history', $token) }}'"
        >
            View History
        </button>

        <form method="POST" action="{{ route('link.renew', $token) }}">
            @csrf
            @method('PATCH')
            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            >
                Renew Link
            </button>
        </form>

        <form method="POST" action="{{ route('link.invalidate', $token) }}">
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
            >
                Invalidate Current Link
            </button>
        </form>

        <form method="POST" action="{{ route('link.lucky', $token) }}">
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
