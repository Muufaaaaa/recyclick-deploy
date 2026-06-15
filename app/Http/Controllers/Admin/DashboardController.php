<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $totalEcoPoints = Order::sum('total_eco_points');

        $latestOrders = Order::with('user')->latest()->take(5)->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $orderStatusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $paymentStatusCounts = [
            'unpaid' => Order::where('payment_status', 'unpaid')->count(),
            'paid' => Order::where('payment_status', 'paid')->count(),
            'failed' => Order::where('payment_status', 'failed')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'totalEcoPoints',
            'latestOrders',
            'lowStockProducts',
            'orderStatusCounts',
            'paymentStatusCounts'
        ));
    }
}