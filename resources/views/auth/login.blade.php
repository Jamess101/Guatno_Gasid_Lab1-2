@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="max-w-sm mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-bold mb-4">Sign in</h1>
    <form method="POST" action="{{ url('/login') }}" class="space-y-3">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
               class="w-full border rounded-lg px-3 py-2 text-sm">
        <input type="password" name="password" placeholder="Password"
               class="w-full border rounded-lg px-3 py-2 text-sm">
        <button class="w-full bg-indigo-600 text-white rounded-lg py-2 text-sm">Login</button>
    </form>
</div>
@endsection