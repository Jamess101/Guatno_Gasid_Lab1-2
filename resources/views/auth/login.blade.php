@extends('layouts.app')
@section('title', 'Sign in')

@section('content')
<div style="max-width: 420px; margin: 24px auto 0;">
    <div class="panel">
        <h1 style="font-size: 2.1rem; margin-bottom: 6px;">Sign in</h1>
        <p class="muted" style="margin: 0 0 28px;">Use your account to view or submit requests.</p>

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Sign in</button>
        </form>
    </div>
</div>
@endsection
