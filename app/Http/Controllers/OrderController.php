<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'quantity'  => 'required|integer|min:1',
            'price'     => 'required|numeric|min:0',
            'status'    => 'required|in:pending,completed,cancelled',
        ]);

        Order::create([
            'user_id'   => Auth::id(),
            'food_name' => $request->food_name,
            'quantity'  => $request->quantity,
            'price'     => $request->price,
            'status'    => $request->status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order added successfully!');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'quantity'  => 'required|integer|min:1',
            'price'     => 'required|numeric|min:0',
            'status'    => 'required|in:pending,completed,cancelled',
        ]);

        $order->update($request->only('food_name', 'quantity', 'price', 'status'));

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
