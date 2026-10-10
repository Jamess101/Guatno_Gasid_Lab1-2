@extends('layouts.app')
@section('title', 'New request')

@section('content')
<div class="max-w-lg bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-bold mb-4">New request</h1>
    <form method="POST" action="{{ route('requests.store') }}" class="space-y-3" novalidate>
        @csrf
        <input type="text" name="item_name" value="{{ old('item_name') }}" placeholder="Item name"
               class="w-full border rounded-lg px-3 py-2 text-sm">
        <input type="text" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity"
               class="w-full border rounded-lg px-3 py-2 text-sm">
        <textarea name="purpose" rows="4" placeholder="Purpose"
                  class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('purpose') }}</textarea>
        <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-sm">Submit</button>
    </form>
</div>
@endsection