@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $category->name }}</h2>
    <div class="row g-3">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=700&q=80" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h6>{{ $product->name }}</h6>
                        <p class="mb-1">Rs {{ number_format($product->price) }}</p>
                        <p class="text-warning">★ {{ $product->rating }}</p>
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('cart.store', $product->id) }}">@csrf<button class="btn btn-sm btn-pink">Add to Cart</button></form>
                            <form method="POST" action="{{ route('favorites.store', $product->id) }}">@csrf<button class="btn btn-sm btn-outline-dark">❤</button></form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>
</div>
@endsection
