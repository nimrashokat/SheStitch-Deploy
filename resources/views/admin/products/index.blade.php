@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Product Management</h2>
    <form class="card p-3 mb-4" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input name="name" class="form-control" placeholder="Product Name" required></div>
            <div class="col-md-2"><input name="price" class="form-control" placeholder="Price" required></div>
            <div class="col-md-2"><input name="discount_percent" class="form-control" placeholder="Discount %"></div>
            <div class="col-md-2">
                <select name="category_id" class="form-select" required>
                    <option value="">Category</option>
                    @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-3"><input type="file" name="image" class="form-control"></div>
        </div>
        <button class="btn btn-pink mt-3">Add Product</button>
    </form>

    <div class="table-responsive bg-white p-3 rounded">
        <table class="table">
            <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Discount</th><th>Action</th></tr></thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>Rs {{ number_format($product->price) }}</td>
                    <td>{{ $product->discount_percent }}%</td>
                    <td>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
