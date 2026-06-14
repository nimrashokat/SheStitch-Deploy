@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Order Management</h2>
    <div class="table-responsive bg-white p-3 rounded">
        <table class="table">
            <thead><tr><th>Customer</th><th>Design</th><th>Size</th><th>Status</th><th>Update</th></tr></thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->design_choice }}</td>
                    <td>{{ $order->size }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" class="d-flex gap-2">
                            @csrf @method('PUT')
                            <select name="status" class="form-select form-select-sm">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="delivered">Delivered</option>
                            </select>
                            <button class="btn btn-sm btn-pink">Save</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
