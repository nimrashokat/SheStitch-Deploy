<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('shop.order-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'design_choice' => ['required', 'string', 'max:120'],
            'size' => ['required', 'string', 'max:20'],
            'fabric_details' => ['required', 'string', 'max:255'],
            'delivery_address' => ['required', 'string', 'max:255'],
            'special_instructions' => ['nullable', 'string'],
            'design_image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('design_image')) {
            $validated['design_image'] = $request->file('design_image')->store('designs', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';
        $validated['total_amount'] = 0;

        Order::create($validated);

        return back()->with('success', 'Order placed successfully');
    }
}
