@extends('layouts.app')
@section('title', 'New request')

@section('content')
<div class="page-head">
    <div>
        <h1>New request</h1>
        <p>Your name and email are taken from your account. New requests start as pending.</p>
    </div>
</div>

<div class="panel" style="max-width: 620px;">
    <form method="POST" action="{{ route('requests.store') }}" novalidate>
        @csrf
        <div class="field">
            <label for="item_name">Item or service</label>
            <input id="item_name" type="text" name="item_name" value="{{ old('item_name') }}">
            <div class="hint">Up to 150 characters.</div>
        </div>
        <div class="field">
            <label for="quantity">Quantity</label>
            <input id="quantity" type="text" name="quantity" value="{{ old('quantity') }}" inputmode="numeric" style="max-width: 160px;">
            <div class="hint">A whole number, 1 or more.</div>
        </div>
        <div class="field">
            <label for="purpose">Purpose</label>
            <textarea id="purpose" name="purpose" rows="5">{{ old('purpose') }}</textarea>
            <div class="hint">Up to 2,000 characters.</div>
        </div>
        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn">Submit request</button>
            <a href="{{ route('requests.index') }}" class="btn quiet">Cancel</a>
        </div>
    </form>
</div>
@endsection
