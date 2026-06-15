<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            @php
                $user = Auth::user();
                $totalOrders = $user->orders()->count();
                $latestOrders = $user->orders()->latest()->take(3)->get();
                $wishlistCount = $user->wishlists()->count();
                $cartItemsCount = $user->cart ? $user->cart->items()->sum('quantity') : 0;
                $paidOrders = $user->orders()->where('payment_status', 'paid')->count();
            @endphp

            <div class="recy-dashboard-hero mb-4">
                <div class="recy-dashboard-hero-content">
                    <div class="recy-dashboard-hero-text">
                        <span class="recy-impact-label">
                            User Dashboard
                        </span>

                        <h1 class="fw-bold mb-2">
                            Halo, {{ $user->name }}
                        </h1>

                        <p class="mb-0 opacity-75">
                            Pantau eco points, pesanan, wishlist, dan aktivitas belanja ramah lingkungan kamu.
                        </p>
                    </div>

                    @if ($user->role === 'admin')
                        <div class="recy-hero-admin-panel">
                            <div class="recy-hero-admin-top">
                                <div class="recy-hero-admin-icon">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M12 2L4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3Z"
                                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                        <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        Mode Admin Aktif
                                    </h5>

                                    <p class="mb-0">
                                        Kelola produk, kategori, pesanan, dan chat pelanggan dari panel admin.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('admin.dashboard') }}" class="recy-hero-admin-btn">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M4 13h6V4H4v9Z" stroke="currentColor" stroke-width="2"
                                        stroke-linejoin="round" />
                                    <path d="M14 20h6V4h-6v16Z" stroke="currentColor" stroke-width="2"
                                        stroke-linejoin="round" />
                                    <path d="M4 20h6v-3H4v3Z" stroke="currentColor" stroke-width="2"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Buka Admin Panel</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-recycle">🍀</span>
                        </div>

                        <small class="text-muted">Eco Points</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $user->eco_points }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Poin dari transaksi eco-friendly.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-cart">🛒</span>
                        </div>

                        <small class="text-muted">Total Pesanan</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $totalOrders }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Jumlah order yang pernah dibuat.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-leaf">♡</span>
                        </div>

                        <small class="text-muted">Wishlist</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $wishlistCount }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Produk yang kamu simpan.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-payment">💳</span>
                        </div>

                        <small class="text-muted">Order Paid</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $paidOrders }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Pesanan yang sudah dibayar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <a href="{{ route('products.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-cart">🛒</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Belanja Produk</h5>
                                <small class="text-muted">
                                    Lihat katalog Recyclick.
                                </small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('cart.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-cart">🛍</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Keranjang</h5>

                                <small class="text-muted">
                                    @if ($cartItemsCount > 0)
                                        {{ $cartItemsCount }} item siap untuk checkout.
                                    @else
                                        Tambahkan produk eco-friendly dulu.
                                    @endif
                                </small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('chat.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-chat">💬</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Chat Admin</h5>
                                <small class="text-muted">
                                    Tanya produk atau pesanan.
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="recy-order-card recy-order-card-wide">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                            <div>
                                <h4 class="fw-bold mb-1">Pesanan Terbaru</h4>
                                <p class="text-muted mb-0">
                                    Order terakhir yang kamu buat.
                                </p>
                            </div>

                            @if ($latestOrders->count() > 0)
                                <a href="{{ route('orders.history') }}" class="recy-dashboard-order-action">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M3 12a9 9 0 1 0 3-6.7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 4v5h5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>Lihat Semua</span>
                                </a>
                            @endif
                        </div>

                        @forelse ($latestOrders as $order)
                            <div class="recy-dashboard-order-row">
                                <div>
                                    <div class="recy-dashboard-order-code">
                                        {{ $order->order_code }}
                                    </div>

                                    <div class="recy-dashboard-order-meta">
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>

                                <div>
                                    <small class="text-muted d-block mb-1">Total Pembayaran</small>
                                    <div class="recy-dashboard-order-price">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div>
                                    <small class="text-muted d-block mb-1">Status</small>

                                    @if ($order->payment_status === 'paid')
                                        <span class="recy-status-badge recy-status-paid">Paid</span>
                                    @else
                                        <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                                    @endif
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('orders.detail', $order->order_code) }}"
                                        class="recy-dashboard-order-action">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M7 3h10l3 3v15H7V3Z" stroke="currentColor" stroke-width="2"
                                                stroke-linejoin="round" />
                                            <path d="M17 3v4h4" stroke="currentColor" stroke-width="2"
                                                stroke-linejoin="round" />
                                            <path d="M10 11h7M10 15h7M10 19h4" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span>Detail</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <div class="recy-empty-content">
                                    <div class="recy-animated-icon mx-auto mb-3">
                                        <span class="recy-icon-cart">🛒</span>
                                    </div>

                                    <h5 class="fw-bold mb-2">Belum ada pesanan</h5>

                                    <p class="text-muted">
                                        Mulai checkout produk eco-friendly pertamamu.
                                    </p>

                                    <a href="{{ route('products.index') }}" class="recy-shop-cta">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2"
                                                stroke-linejoin="round" />
                                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" />
                                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor"
                                                stroke-width="2" />
                                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor"
                                                stroke-width="2" />
                                        </svg>
                                        <span>Belanja Sekarang</span>
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>