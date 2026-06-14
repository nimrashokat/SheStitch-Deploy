@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Your Cart</h2>
    @forelse($items as $item)
        <div class="card p-3 mb-2 d-flex flex-row justify-content-between align-items-center">
            <div>{{ $item->product->name }} x {{ $item->quantity }}</div>
            <div class="d-flex align-items-center gap-3">
                <span>Rs {{ number_format($item->product->price) }}</span>
                <form method="POST" action="{{ route('cart.destroy', $item->id) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Remove</button></form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Your cart is empty. Start adding your favorite designs.</div>
    @endforelse
</div>
@endsection
