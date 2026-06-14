@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Custom Tailoring Order</h2>
    <form class="card p-4" method="POST" enctype="multipart/form-data" action="{{ route('order.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><input class="form-control" name="first_name" placeholder="First Name" required></div>
            <div class="col-md-6"><input class="form-control" name="last_name" placeholder="Last Name" required></div>
            <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="Email Address" required></div>
            <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone Number" required></div>
            <div class="col-md-6"><input class="form-control" name="design_choice" placeholder="Choose Design" required></div>
            <div class="col-md-6">
                <select class="form-select" name="size" required>
                    <option value="">Choose Size</option><option>Small</option><option>Medium</option><option>Large</option><option>XL</option>
                </select>
            </div>
            <div class="col-md-6"><input class="form-control" name="fabric_details" placeholder="Fabric Details" required></div>
            <div class="col-md-6"><input class="form-control" name="delivery_address" placeholder="Delivery Address" required></div>
            <div class="col-12"><textarea class="form-control" name="special_instructions" rows="3" placeholder="Special Instructions"></textarea></div>
            <div class="col-12"><input class="form-control" type="file" name="design_image"></div>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-outline-dark" type="button">Send Message</button>
            <button class="btn btn-pink" type="submit">Place Order</button>
        </div>
    </form>
</div>
@endsection
