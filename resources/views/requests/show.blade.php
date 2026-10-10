@extends('layouts.app')
@section('title', 'Request ' . $r->id)

@section('content')
<style>
    .detail { display: grid; grid-template-columns: 180px 1fr; margin: 0; }
    .detail dt, .detail dd { padding: 16px 0; border-bottom: 1px solid var(--line); margin: 0; }
    .detail dt { color: var(--muted); font-size: .92rem; }
    .detail dd { overflow-wrap: anywhere; white-space: pre-line; }
    @media (max-width: 560px) {
        .detail { grid-template-columns: 1fr; }
        .detail dt { border-bottom: 0; padding-bottom: 0; }
    }
</style>

<div class="page-head">
    <div>
        <h1>Request {{ $r->id }}</h1>
        <p>Submitted {{ $r->created_at?->format('F j, Y') }}</p>
    </div>
    <span class="status {{ $r->status }}">{{ ucfirst($r->status) }}</span>
</div>

<div class="panel" style="max-width: 760px;">
    <dl class="detail">
        <dt>Requester</dt>
        <dd>{{ $r->requester_name }}<div class="muted" style="font-size:.9rem;">{{ $r->requester_email }}</div></dd>
        <dt>Item or service</dt>
        <dd>{{ $r->item_name }}</dd>
        <dt>Quantity</dt>
        <dd>{{ $r->quantity }}</dd>
        <dt>Purpose</dt>
        <dd>{{ $r->purpose }}</dd>
    </dl>

    @can('updateStatus', $r)
        <form method="POST" action="{{ route('requests.status', $r) }}" style="margin-top: 32px; display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
            @csrf
            @method('PATCH')
            <div style="min-width: 200px;">
                <label for="status">Status</label>
                <select id="status" name="status">
                    @foreach (\App\Models\ServiceRequest::STATUSES as $s)
                        <option value="{{ $s }}" @selected($r->status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn">Save status</button>
        </form>
    @endcan
</div>

<p style="margin-top: 24px;"><a href="{{ route('requests.index') }}">Back to requests</a></p>
@endsection
