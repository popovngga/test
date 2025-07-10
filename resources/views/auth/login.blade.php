@extends('layout')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6 space-y-6">
        <h1 class="text-2xl font-semibold text-center">Register</h1>

        <x-status-message :status="session('status')" :color="session('color')" />

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4" id="register-form">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700" for="username">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    required
                    value="{{ old('username') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="phone">Phone Number</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    required
                    value="{{ old('phone') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                >
            </div>

            <button
                id="register-button"
                type="submit"
                class="w-full bg-gray-600 text-white py-3 rounded-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 ease-in-out font-semibold"
                onclick="handleSubmitButtonOnClick(this)"
            >
                Register
            </button>
        </form>
    </div>
@stop
