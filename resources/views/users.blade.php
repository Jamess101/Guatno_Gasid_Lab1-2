@extends('layouts.app')
@section('title', 'Users')

@section('content')
<h1 class="text-2xl font-bold mb-1">Users</h1>
<p class="text-slate-500 mb-6">Mock data stored in the MySQL database.</p>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
            <tr><th class="px-4 py-3">ID</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Created</th></tr>
        </thead>
        <tbody>
            @forelse ($users as $u)
                <tr class="border-t hover:bg-slate-50">
                    <td class="px-4 py-3">{{ $u->id }}</td>
                    <td class="px-4 py-3 font-medium">{{ $u->name }}</td>
                    <td class="px-4 py-3">{{ $u->email }}</td>
                    <td class="px-4 py-3">{{ $u->created_at?->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">No users yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection