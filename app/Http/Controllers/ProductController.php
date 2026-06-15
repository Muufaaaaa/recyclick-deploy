<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with('category')->latest()->take(4)->get();

        $categories = Category::withCount('products')->take(4)->get();

        $wishlistProductIds = auth()->check()
            ? auth()->user()->wishlists()->pluck('product_id')->toArray()
            : [];

        return view('home', compact('featuredProducts', 'categories', 'wishlistProductIds'));
    }

    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('eco_badge', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->get();
        $categories = Category::all();

        $wishlistProductIds = auth()->check()
            ? auth()->user()->wishlists()->pluck('product_id')->toArray()
            : [];

        return view('products.index', compact('products', 'categories', 'wishlistProductIds'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        $wishlistProductIds = auth()->check()
            ? auth()->user()->wishlists()->pluck('product_id')->toArray()
            : [];

        return view('products.show', compact('product', 'wishlistProductIds'));
    }

    public function category(Category $category)
    {
        $products = $category->products()->latest()->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }
}