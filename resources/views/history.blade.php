@extends('layout')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6 space-y-6">
        <a
            href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-200 font-medium shadow-sm"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 no-fill" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>

        <h1 class="text-2xl font-semibold text-center">History</h1>

        <ul class="space-y-4">
            @foreach($lotteryAttempts as $attempt)
                <li class="border border-gray-200 rounded p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <div><strong>Number:</strong> {{ $attempt->number }}</div>
                        <div><strong>Result:</strong> {{ $attempt->result }}</div>
                    </div>
                    <div class="{{ $attempt->result === 'Win' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                        {{ $attempt->result === 'Win' ? '+' . $attempt->amount : '-' . $attempt->amount }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@stop
