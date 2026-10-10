<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Request System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F6F6F3;
            --paper: #FFFFFF;
            --ink: #1C2333;
            --muted: #6A707C;
            --line: #DEDCD5;
            --navy: #1B2A41;
            --brass: #8C6D2F;
            --sage: #4F6F52;
            --ochre: #9A6B1A;
            --claret: #8B3A3A;
            --serif: 'Cormorant Garamond', Georgia, 'Times New Roman', serif;
            --sans: 'Source Sans 3', 'Helvetica Neue', Arial, sans-serif;
        }
        * { box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; }
        body {
            margin: 0; min-height: 100vh; display: flex; flex-direction: column;
            background: var(--bg); color: var(--ink);
            font-family: var(--sans); font-size: 16px; line-height: 1.6;
        }
        h1, h2, h3 { font-family: var(--serif); font-weight: 600; letter-spacing: .01em; line-height: 1.15; margin: 0; }
        h1 { font-size: 2.4rem; }
        h2 { font-size: 1.7rem; }
        a { color: var(--navy); }
        a:hover { color: var(--brass); }
        :focus-visible { outline: 2px solid var(--brass); outline-offset: 2px; }

        .wrap { width: 100%; max-width: 1040px; margin: 0 auto; padding: 0 24px; }

        .site-header { background: var(--navy); color: #F1EFE8; border-bottom: 1px solid var(--brass); }
        .site-header .wrap { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding-top: 18px; padding-bottom: 18px; }
        .brand { font-family: var(--serif); font-size: 1.65rem; font-weight: 600; letter-spacing: .02em; color: #fff; text-decoration: none; }
        .brand:hover { color: #fff; }
        .nav { display: flex; align-items: center; gap: 26px; flex-wrap: wrap; font-size: .95rem; }
        .nav a, .nav button.linklike { color: #CFCBBE; text-decoration: none; background: none; border: 0; padding: 4px 0; font: inherit; cursor: pointer; border-bottom: 1px solid transparent; }
        .nav a:hover, .nav button.linklike:hover { color: #fff; border-bottom-color: var(--brass); }
        .nav a.active { color: #fff; border-bottom-color: var(--brass); }
        .nav .who { color: #A9A596; font-size: .9rem; }
        .nav form { margin: 0; }

        main { flex: 1; padding: 56px 0 72px; }

        .flash { border-left: 3px solid var(--sage); background: var(--paper); padding: 12px 16px; margin-bottom: 28px; font-size: .95rem; }
        .flash.error { border-left-color: var(--claret); }
        .flash ul { margin: 0; padding-left: 18px; }

        .btn { display: inline-block; background: var(--navy); color: #fff; border: 1px solid var(--navy); border-radius: 2px; padding: 10px 22px; font: 500 .95rem var(--sans); letter-spacing: .02em; text-decoration: none; cursor: pointer; }
        .btn:hover { background: var(--brass); border-color: var(--brass); color: #fff; }
        .btn.quiet { background: transparent; color: var(--navy); border-color: #BDB9AC; }
        .btn.quiet:hover { background: transparent; color: var(--brass); border-color: var(--brass); }

        label { display: block; font-size: .9rem; font-weight: 500; margin-bottom: 6px; color: var(--ink); }
        .hint { font-size: .85rem; color: var(--muted); margin-top: 4px; }
        input[type=text], input[type=email], input[type=password], select, textarea {
            width: 100%; background: var(--paper); border: 1px solid #CFCCC2; border-radius: 2px;
            padding: 10px 12px; font: 400 1rem var(--sans); color: var(--ink);
        }
        textarea { resize: vertical; }
        input:focus, select:focus, textarea:focus { outline: 2px solid var(--brass); outline-offset: 0; border-color: var(--brass); }
        .field { margin-bottom: 22px; }

        .page-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 1px solid var(--navy); margin-bottom: 28px; }
        .page-head p { margin: 6px 0 0; color: var(--muted); }

        .filters { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px; }
        .filters input[type=text] { flex: 1; min-width: 200px; width: auto; }
        .filters select { width: auto; min-width: 160px; }

        .table-wrap { overflow-x: auto; background: var(--paper); border: 1px solid var(--line); }
        table { width: 100%; border-collapse: collapse; font-size: .95rem; }
        th { text-align: left; font-weight: 600; font-size: .85rem; color: var(--muted); padding: 14px 18px; border-bottom: 1px solid var(--line); white-space: nowrap; }
        td { padding: 16px 18px; border-bottom: 1px solid var(--line); vertical-align: top; }
        tr:last-child td { border-bottom: 0; }
        td.num, th.num { text-align: right; }
        .muted { color: var(--muted); }

        .status { display: inline-flex; align-items: center; gap: 8px; font-weight: 500; }
        .status::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: var(--ochre); }
        .status.approved::before { background: var(--sage); }
        .status.rejected::before { background: var(--claret); }
        .status.pending::before { background: var(--ochre); }

        .pager { display: flex; align-items: center; justify-content: space-between; margin-top: 22px; font-size: .9rem; color: var(--muted); }
        .pager a { text-decoration: none; border-bottom: 1px solid var(--brass); }
        .pager .off { opacity: .35; }

        .panel { background: var(--paper); border: 1px solid var(--line); padding: 40px; }

        .site-footer { border-top: 1px solid var(--line); padding: 22px 0; text-align: center; color: var(--muted); font-size: .85rem; }

        @media (max-width: 640px) {
            h1 { font-size: 2rem; }
            main { padding: 36px 0 56px; }
            .panel { padding: 24px; }
            .nav { gap: 18px; }
        }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <a href="{{ url('/') }}" class="brand">Request System</a>
        <nav class="nav" aria-label="Main">
            @auth
                <a href="{{ route('requests.index') }}" class="{{ request()->routeIs('requests.index', 'requests.show') ? 'active' : '' }}">Requests</a>
                @can('create', App\Models\ServiceRequest::class)
                    <a href="{{ route('requests.create') }}" class="{{ request()->routeIs('requests.create') ? 'active' : '' }}">New request</a>
                @endcan
                <span class="who">{{ auth()->user()->name }}, {{ auth()->user()->role }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="linklike">Sign out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Sign in</a>
            @endauth
        </nav>
    </div>
</header>

<main>
    <div class="wrap">
        @if (session('status'))
            <div class="flash" role="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="flash error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</main>

<footer class="site-footer">
    <div class="wrap">Laravel Request System &middot; DevOps Laboratory</div>
</footer>
</body>
</html>
