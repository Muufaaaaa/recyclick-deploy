<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function buyNow(Product $product)
    {
        if ($product->stock <= 0) {
            return back()->withErrors([
                'stock' => 'Stok produk habis.'
            ]);
        }

        session([
            'buy_now' => [
                'product_id' => $product->id,
                'quantity' => 1,
            ]
        ]);

        return redirect()->route('checkout')->with('success', 'Produk siap dipesan.');
    }

    public function checkout()
    {
        if (session()->has('buy_now')) {
            $buyNow = session('buy_now');

            $product = Product::findOrFail($buyNow['product_id']);

            $cart = (object) [
                'items' => collect([
                    (object) [
                        'product' => $product,
                        'quantity' => $buyNow['quantity'],
                    ]
                ])
            ];

            $isBuyNow = true;

            return view('orders.checkout', compact('cart', 'isBuyNow'));
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load('items.product');

        if ($cart->items->count() <= 0) {
            return redirect()->route('cart.index')->withErrors([
                'cart' => 'Keranjang masih kosong.'
            ]);
        }

        $isBuyNow = false;

        return view('orders.checkout', compact('cart', 'isBuyNow'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'payment_method' => 'required',
        ]);

        if (session()->has('buy_now')) {
            $buyNow = session('buy_now');

            $product = Product::findOrFail($buyNow['product_id']);

            $checkoutItems = collect([
                (object) [
                    'product' => $product,
                    'quantity' => $buyNow['quantity'],
                ]
            ]);

            $isBuyNow = true;
            $cart = null;
        } else {
            $cart = Cart::where('user_id', Auth::id())
                ->with('items.product')
                ->first();

            if (!$cart || $cart->items->count() == 0) {
                return redirect()->route('cart.index')->withErrors([
                    'cart' => 'Keranjang masih kosong.'
                ]);
            }

            $checkoutItems = $cart->items;
            $isBuyNow = false;
        }

        $totalPrice = 0;
        $totalEcoPoints = 0;

        foreach ($checkoutItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->withErrors([
                    'stock' => 'Stok produk ' . $item->product->name . ' tidak cukup.'
                ]);
            }

            $totalPrice += $item->product->price * $item->quantity;
            $totalEcoPoints += $item->product->eco_points_reward * $item->quantity;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => 'RCY-' . strtoupper(Str::random(8)),
            'total_price' => $totalPrice,
            'total_eco_points' => $totalEcoPoints,
            'eco_points_awarded' => false,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
            'payment_code' => 'PAY-' . strtoupper(Str::random(10)),
            'status' => 'pending',
        ]);

        foreach ($checkoutItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        if ($isBuyNow) {
            session()->forget('buy_now');
        } else {
            $cart->items()->delete();
        }

        return redirect()->route('orders.success', $order->order_code);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.payment', compact('order'));
    }

    public function pay(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return back()->with('success', 'Pesanan ini sudah dibayar.');
        }

        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);

        return redirect()
            ->route('orders.success', $order->order_code)
            ->with('success', 'Pembayaran berhasil disimulasikan.');
    }

    public function detail(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'user');

        return view('orders.detail', compact('order'));
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }
}