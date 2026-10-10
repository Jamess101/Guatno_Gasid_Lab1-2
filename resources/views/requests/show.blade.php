@extends('layouts.app')
@section('title', 'Request #' . $r->id)

@section('content')
<div class="max-w-lg bg-white rounded-xl shadow p-6 space-y-2">
    <h1 class="text-xl font-bold">Request #{{ $r->id }}</h1>
    <p><b>Requester:</b> {{ $r->requester_name }} ({{ $r->requester_email }})</p>
    <p><b>Item:</b> {{ $r->item_name }}</p>
    <p><b>Quantity:</b> {{ $r->quantity }}</p>
    <p><b>Purpose:</b> {{ $r->purpose }}</p>
    <p><b>Status:</b> {{ ucfirst($r->status) }}</p>

    @can('updateStatus', $r)
        <form method="POST" action="{{ route('requests.status', $r) }}" class="flex gap-2 pt-3">
            @csrf
            @method('PATCH')
            <select name="status" class="border rounded-lg px-3 py-2 text-sm">
                @foreach (\App\Models\ServiceRequest::STATUSES as $s)
                    <option value="{{ $s }}" @selected($r->status === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-sm">Update status</button>
        </form>
    @endcan

    <a href="{{ route('requests.index') }}" class="text-indigo-600 underline text-sm">Back</a>
</div>
@endsection