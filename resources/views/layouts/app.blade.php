<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Laravel Request System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    <nav class="bg-indigo-700 text-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="font-bold text-lg">📋 Request System</a>
            <div class="flex gap-4 text-sm">
                <a href="/" class="hover:underline {{ request()->is('/') ? 'font-bold underline' : '' }}">Home</a>
                <a href="/users" class="hover:underline {{ request()->is('users') ? 'font-bold underline' : '' }}">Users</a>
                <a href="/requests" class="hover:underline {{ request()->is('requests') ? 'font-bold underline' : '' }}">Requests</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto w-full px-4 py-8 flex-1">
        @yield('content')
    </main>

    <footer class="text-center text-xs text-slate-500 py-4">
        Laravel Request System · DevOps Laboratory · Built with Laravel {{ app()->version() }}
    </footer>
</body>
</html>