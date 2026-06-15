<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Order History</span>
                    <h1 class="fw-bold mt-3 mb-1">Riwayat Pesanan</h1>
                    <p class="text-muted mb-0">
                        Pantau status pesanan dan pembayaran Recyclick kamu.
                    </p>
                </div>

                @if ($orders->count() > 0)
                    <a href="{{ route('products.index') }}" class="recy-shop-cta recy-shop-cta-outline mt-3 mt-md-0">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <span>Belanja Lagi</span>
                    </a>
                @endif
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($orders as $order)
                <div class="recy-order-card mb-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $order->order_code }}
                            </h5>

                            <small class="text-muted">
                                Dibuat pada {{ $order->created_at->format('d M Y H:i') }}
                            </small>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            @if ($order->status === 'pending')
                                <span class="recy-status-badge recy-status-unpaid">Pending</span>
                            @elseif ($order->status === 'processing')
                                <span class="recy-status-badge recy-status-processing">Processing</span>
                            @elseif ($order->status === 'completed')
                                <span class="recy-status-badge recy-status-paid">Completed</span>
                            @else
                                <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                            @endif

                            @if ($order->payment_status === 'paid')
                                <span class="recy-status-badge recy-status-paid">Paid</span>
                            @elseif ($order->payment_status === 'failed')
                                <span class="recy-status-badge recy-status-cancelled">Failed</span>
                            @else
                                <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row g-4">
                        <div class="col-lg-7">
                            <h6 class="fw-bold mb-3">Produk Dipesan</h6>

                            @foreach ($order->items as $item)
                                <div class="recy-order-item d-flex justify-content-between gap-3">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong>
                                        <small class="text-muted d-block">
                                            Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </small>
                                    </div>

                                    <strong class="text-success">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </strong>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-5">
                            <div class="recy-eco-box">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Harga</span>
                                    <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>
                                        @if ($order->eco_points_awarded)
                                            Eco Points Didapat
                                        @else
                                            Eco Points Pending
                                        @endif
                                    </span>

                                    <strong class="{{ $order->eco_points_awarded ? 'text-success' : 'text-warning' }}">
                                        +{{ $order->total_eco_points }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Metode Bayar</span>
                                    <strong>{{ $order->payment_method }}</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Kode Bayar</span>
                                    <strong>{{ $order->payment_code ?? '-' }}</strong>
                                </div>
                            </div>

                            <a href="{{ route('orders.detail', $order->order_code) }}"
                                class="recy-invoice-action d-flex w-100 mt-3">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M7 3h10l3 3v15H7V3Z" stroke="currentColor" stroke-width="2"
                                        stroke-linejoin="round" />
                                    <path d="M17 3v4h4" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                    <path d="M10 11h7M10 15h7M10 19h4" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                                <span>Lihat Detail Invoice</span>
                            </a>

                            @if ($order->payment_status !== 'paid')
                                <form action="{{ route('orders.pay', $order->order_code) }}" method="POST" class="mt-3">
                                    @csrf

                                    <button class="recy-cta-btn recy-cta-btn-primary w-100">
                                        <svg viewBox="0 0 24 24" fill="none" class="recy-payment-icon">
                                            <path
                                                d="M3 6.5A2.5 2.5 0 0 1 5.5 4h13A2.5 2.5 0 0 1 21 6.5v11A2.5 2.5 0 0 1 18.5 20h-13A2.5 2.5 0 0 1 3 17.5v-11Z"
                                                stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                            <path d="M3 9h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                            <path d="M7 15l2 2 4-4" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <span>Bayar Sekarang</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="recy-empty-state">
                    <div class="recy-empty-content">
                        <div class="recy-animated-icon mx-auto mb-3">
                            <span class="recy-icon-cart">🛒</span>
                        </div>

                        <h4 class="fw-bold mb-2">Belum ada pesanan</h4>

                        <p class="text-muted">
                            Mulai belanja produk eco-friendly pertamamu.
                        </p>

                        <a href="{{ route('products.index') }}" class="recy-shop-cta">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                                <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <span>Belanja Sekarang</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>