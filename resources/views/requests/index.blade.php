@extends('layouts.app')
@section('title', 'Requests')

@section('content')
@php $isAdmin = auth()->user()->isAdmin(); @endphp

<div class="page-head">
    <div>
        <h1>{{ $isAdmin ? 'All requests' : 'My requests' }}</h1>
        <p>{{ $requests->total() }} {{ \Illuminate\Support\Str::plural('record', $requests->total()) }}</p>
    </div>
    @can('create', App\Models\ServiceRequest::class)
        <a href="{{ route('requests.create') }}" class="btn">New request</a>
    @endcan
</div>

<form method="GET" action="{{ route('requests.index') }}" class="filters">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by item or purpose" aria-label="Search">
    <select name="status" aria-label="Status">
        <option value="">All statuses</option>
        @foreach (\App\Models\ServiceRequest::STATUSES as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn quiet">Apply</button>
    @if (request()->filled('q') || request()->filled('status'))
        <a href="{{ route('requests.index') }}" class="btn quiet">Clear</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                @if ($isAdmin)<th>Requester</th>@endif
                <th>Item</th>
                <th class="num">Quantity</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($requests as $r)
            <tr>
                <td class="muted">{{ $r->id }}</td>
                @if ($isAdmin)
                    <td>{{ $r->requester_name }}<div class="muted" style="font-size:.85rem;">{{ $r->requester_email }}</div></td>
                @endif
                <td>{{ $r->item_name }}</td>
                <td class="num">{{ $r->quantity }}</td>
                <td><span class="status {{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                <td class="num"><a href="{{ route('requests.show', $r) }}">View</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ $isAdmin ? 6 : 5 }}" class="muted" style="text-align:center; padding: 48px 18px;">
                    No requests found. Adjust the filters or submit a new request.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if ($requests->hasPages())
    <div class="pager">
        <span>Page {{ $requests->currentPage() }} of {{ $requests->lastPage() }}</span>
        <span style="display:flex; gap:24px;">
            @if ($requests->onFirstPage())
                <span class="off">Previous</span>
            @else
                <a href="{{ $requests->previousPageUrl() }}">Previous</a>
            @endif
            @if ($requests->hasMorePages())
                <a href="{{ $requests->nextPageUrl() }}">Next</a>
            @else
                <span class="off">Next</span>
            @endif
        </span>
    </div>
@endif
@endsection
