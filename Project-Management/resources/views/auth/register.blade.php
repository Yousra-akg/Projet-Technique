@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="bg-white rounded-2xl shadow-xl p-8">
    <!-- Logo/Brand -->
    <div class="flex items-center justify-center gap-3 mb-8">
        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">T</div>
        <span class="font-bold text-2xl text-slate-800 tracking-tight">Task<span class="text-blue-500">Manage</span></span>
    </div>

    <h2 class="text-2xl font-bold text-slate-800 mb-2 text-center">Create Account</h2>
    <p class="text-slate-500 text-sm text-center mb-8">Join us to start managing your tasks</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name"
                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                placeholder="John Doe"
            >
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email"
                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                placeholder="you@example.com"
            >
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password"
                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                placeholder="••••••••"
            >
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password-confirm" class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</label>
            <input 
                id="password-confirm" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="••••••••"
            >
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition shadow-sm hover:shadow-md"
        >
            Create Account
        </button>

        <!-- Login Link -->
        <p class="mt-6 text-center text-sm text-slate-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                Sign in
            </a>
        </p>
    </form>
</div>
@endsection
