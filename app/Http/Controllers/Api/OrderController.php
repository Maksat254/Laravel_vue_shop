<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|string',
            'card_number' => 'required|digits:16',
            'card_expiry' => 'required|date_format:m/y',
            'card_cvc' => 'required|digits:3',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $validated['address'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'completed',
        ]);

        return response()->json(['message' => 'Order placed successfully!'], 201);
    }

}
