@extends('layouts.app')
@section('title', 'Requests')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ auth()->user()->isAdmin() ? 'All requests' : 'My requests' }}</h1>

<form method="GET" action="{{ route('requests.index') }}" class="flex flex-wrap gap-2 mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..."
           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-[200px]">
    <select name="status" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">All statuses</option>
        @foreach (\App\Models\ServiceRequest::STATUSES as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-sm">Filter</button>
</form>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">#</th>
                @if (auth()->user()->isAdmin())
                    <th class="px-4 py-3">Requester</th>
                @endif
                <th class="px-4 py-3">Item</th>
                <th class="px-4 py-3">Qty</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($requests as $r)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $r->id }}</td>
                @if (auth()->user()->isAdmin())
                    <td class="px-4 py-3">{{ $r->requester_name }}</td>
                @endif
                <td class="px-4 py-3">{{ $r->item_name }}</td>
                <td class="px-4 py-3">{{ $r->quantity }}</td>
                <td class="px-4 py-3">{{ ucfirst($r->status) }}</td>
                <td class="px-4 py-3">
                    <a class="text-indigo-600 underline" href="{{ route('requests.show', $r) }}">View</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-slate-400">No requests found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $requests->links() }}</div>
@endsection