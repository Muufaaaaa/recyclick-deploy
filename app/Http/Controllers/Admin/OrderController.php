<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        if (
            $order->status === 'completed' &&
            $order->payment_status === 'paid' &&
            !$order->eco_points_awarded
        ) {
            $order->user->increment('eco_points', $order->total_eco_points);

            $order->update([
                'eco_points_awarded' => true,
            ]);
        }

        return back()->with('success', 'Status order berhasil diperbarui.');
    }
}