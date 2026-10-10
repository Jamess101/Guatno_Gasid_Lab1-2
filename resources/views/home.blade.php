@extends('layouts.app')
@section('title', 'Home')

@section('content')
<style>
    .hero { max-width: 640px; padding-bottom: 56px; }
    .hero h1 { font-size: clamp(2.6rem, 6vw, 4rem); margin-bottom: 18px; }
    .hero p { font-size: 1.15rem; color: var(--muted); margin: 0 0 32px; }
    .steps { list-style: none; margin: 0; padding: 0; counter-reset: step; border-top: 1px solid var(--navy); }
    .steps li { counter-increment: step; display: grid; grid-template-columns: 56px 160px 1fr 1fr; gap: 16px; align-items: baseline; padding: 16px 0; border-bottom: 1px solid var(--line); }
    .steps li::before { content: counter(step, decimal-leading-zero); font-family: var(--serif); font-size: 1.2rem; color: var(--brass); }
    .steps .name { font-family: var(--serif); font-size: 1.35rem; font-weight: 600; }
    .steps .tool { color: var(--ink); }
    .steps .sec { color: var(--muted); font-size: .92rem; }
    @media (max-width: 720px) {
        .steps li { grid-template-columns: 40px 1fr; row-gap: 2px; }
        .steps .tool, .steps .sec { grid-column: 2; }
    }
</style>

<section class="hero">
    <h1>Service requests, handled with care.</h1>
    <p>Submit a request, follow its status, and let staff review it. Every record is visible only to its owner and the administrator.</p>
    @auth
        <a href="{{ route('requests.index') }}" class="btn">Open requests</a>
    @else
        <a href="{{ route('login') }}" class="btn">Sign in</a>
    @endauth
</section>

<section>
    <h2 style="margin-bottom: 20px;">How this project is delivered</h2>
    <ol class="steps">
        @foreach ($workflow as $step)
            <li>
                <span class="name">{{ $step['name'] }}</span>
                <span class="tool">{{ $step['tool'] }}</span>
                <span class="sec">{{ $step['security'] }}</span>
            </li>
        @endforeach
    </ol>
</section>
@endsection
