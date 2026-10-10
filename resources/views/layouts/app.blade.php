<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Laravel Request System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
<nav class="bg-indigo-700 text-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-2">
        <a href="/" class="font-bold text-lg">Request System</a>
        <div class="flex flex-wrap items-center gap-4 text-sm">
            @auth
                <a href="{{ route('requests.index') }}" class="hover:underline">Requests</a>
                @can('create', App\Models\ServiceRequest::class)
                    <a href="{{ route('requests.create') }}" class="hover:underline">New request</a>
                @endcan
                <span class="opacity-80">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
            @endauth
        </div>
    </div>
</nav>
<main class="max-w-6xl mx-auto w-full px-4 py-8 flex-1">
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-2 text-sm">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <ul class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-2 text-sm list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @yield('content')
</main>
<footer class="text-center text-xs text-slate-500 py-4">Laravel Request System · DevOps Laboratory 3</footer>
</body>
</html>