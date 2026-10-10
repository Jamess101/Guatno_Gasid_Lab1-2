@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="bg-indigo-600 text-white rounded-2xl p-8 mb-8 shadow">
    <h1 class="text-3xl font-bold mb-2">Laravel Request System</h1>
    <p class="opacity-90">A DevOps project: Laravel + MySQL + Git + GitHub.</p>
</div>
<h2 class="text-xl font-bold mb-4">DevOps workflow</h2>
<div class="grid md:grid-cols-4 gap-4">
    @foreach ($workflow as $i => $step)
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-indigo-500">
            <p class="text-xs text-slate-400">Step {{ $i + 1 }}</p>
            <p class="font-semibold">{{ $step['name'] }}</p>
            <p class="text-sm text-slate-600">{{ $step['tool'] }}</p>
            <p class="text-xs text-slate-500 mt-2">{{ $step['security'] }}</p>
        </div>
    @endforeach
</div>
@endsection