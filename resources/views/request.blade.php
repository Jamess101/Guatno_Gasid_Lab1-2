@extends('layouts.app')
@section('title', 'Requests')

@section('content')
<h1 class="text-2xl font-bold mb-1">Requests</h1>
<p class="text-slate-500 mb-6">Data from the <code class="bg-slate-200 px-1 rounded">requests</code> table created by our migration.</p>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow p-4"><p class="text-xs uppercase text-slate-500">Total requests</p><p class="text-3xl font-bold text-indigo-600">{{ $total }}</p></div>
    <div class="bg-white rounded-xl shadow p-4"><p class="text-xs uppercase text-slate-500">Pending</p><p class="text-3xl font-bold text-amber-500">{{ $pending }}</p></div>
    <div class="bg-white rounded-xl shadow p-4"><p class="text-xs uppercase text-slate-500">Units requested</p><p class="text-3xl font-bold text-emerald-600">{{ $units }}</p></div>
</div>

<form method="GET" class="flex flex-wrap gap-2 mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or item..."
           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-[200px]">
    <select name="status" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">All statuses</option>
        @foreach (['pending', 'approved', 'rejected'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-sm hover:bg-indigo-700">Filter</button>
    <a href="/requests" class="px-3 py-2 text-sm text-slate-500 hover:underline">Reset</a>
</form>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">#</th><th class="px-4 py-3">Requester</th><th class="px-4 py-3">Item</th>
                <th class="px-4 py-3">Qty</th><th class="px-4 py-3">Purpose</th><th class="px-4 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $r)
                @php
                    $badge = match ($r->status) {
                        'approved' => 'bg-green-100 text-green-700',
                        'rejected' => 'bg-red-100 text-red-700',
                        default    => 'bg-amber-100 text-amber-700',
                    };
                @endphp
                <tr class="border-t hover:bg-slate-50 align-top">
                    <td class="px-4 py-3">{{ $r->id }}</td>
                    <td class="px-4 py-3"><p class="font-medium">{{ $r->requester_name }}</p><p class="text-xs text-slate-500">{{ $r->requester_email }}</p></td>
                    <td class="px-4 py-3">{{ $r->item_name }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $r->quantity }}</td>
                    <td class="px-4 py-3 text-slate-600 max-w-xs">{{ $r->purpose }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badge }}">{{ ucfirst($r->status) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-slate-400">No requests found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection