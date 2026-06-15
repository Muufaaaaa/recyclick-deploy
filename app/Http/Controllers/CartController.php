<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->withErrors([
                'stock' => 'Stok produk sedang habis.'
            ]);
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            if ($item->quantity + 1 > $product->stock) {
                return back()->withErrors([
                    'stock' => 'Jumlah produk di keranjang sudah mencapai batas stok.'
                ]);
            }

            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('checkout')->with('success', 'Produk siap dipesan.');
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $item->product->stock) {
            return back()->withErrors([
                'quantity' => 'Jumlah melebihi stok produk.'
            ]);
        }

        $item->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy(CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}