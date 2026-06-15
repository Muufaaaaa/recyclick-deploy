<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 recy-no-print">
                <div>
                    <span class="recy-page-badge">Invoice Detail</span>
                    <h1 class="fw-bold mt-3 mb-1">Detail Pesanan</h1>
                    <p class="text-muted mb-0">
                        Informasi lengkap pesanan dan pembayaran Recyclick.
                    </p>
                </div>

                <div class="d-flex flex-wrap gap-2 justify-content-end">
                    <a href="{{ route('orders.history') }}" class="recy-cta-btn recy-cta-btn-outline">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M12 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>Kembali ke Riwayat</span>
                    </a>

                    <a href="{{ route('products.index') }}" class="recy-cta-btn recy-cta-btn-outline">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />
                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <span>Belanja Lagi</span>
                    </a>

                    <button onclick="window.print()" class="recy-cta-btn recy-cta-btn-primary">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 9V3h12v6" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M6 17H4a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-2"
                                stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M6 14h12v7H6v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        </svg>
                        <span>Print Invoice</span>
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4 recy-no-print">
                    {{ session('success') }}
                </div>
            @endif

            <div class="recy-invoice-box mx-auto" style="max-width: 960px;">
                <div class="recy-invoice-header">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h2 class="fw-bold text-success mb-1">
                                Recyclick
                            </h2>

                            <p class="text-muted mb-0">
                                EcoCommerce produk ramah lingkungan.
                            </p>
                        </div>

                        <div class="text-md-end">
                            <h4 class="fw-bold mb-1">
                                INVOICE
                            </h4>

                            <p class="text-muted mb-0">
                                {{ $order->order_code }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="recy-eco-box h-100">
                            <h5 class="fw-bold mb-3">Data Pelanggan</h5>

                            <div class="recy-invoice-row">
                                <span>Nama</span>
                                <strong>{{ $order->user->name }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Email</span>
                                <strong>{{ $order->user->email }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>No HP</span>
                                <strong>{{ $order->phone }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Alamat</span>
                                <strong>{{ $order->address }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="recy-eco-box h-100">
                            <h5 class="fw-bold mb-3">Data Pembayaran</h5>

                            <div class="recy-invoice-row">
                                <span>Tanggal</span>
                                <strong>{{ $order->created_at->format('d M Y H:i') }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Metode</span>
                                <strong>{{ $order->payment_method }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Kode Bayar</span>
                                <strong>{{ $order->payment_code ?? '-' }}</strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Status Bayar</span>
                                <strong>
                                    @if ($order->payment_status === 'paid')
                                        <span class="recy-status-badge recy-status-paid">Paid</span>
                                    @elseif ($order->payment_status === 'failed')
                                        <span class="recy-status-badge recy-status-cancelled">Failed</span>
                                    @else
                                        <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                                    @endif
                                </strong>
                            </div>

                            <div class="recy-invoice-row">
                                <span>Status Order</span>
                                <strong>
                                    @if ($order->status === 'pending')
                                        <span class="recy-status-badge recy-status-unpaid">Pending</span>
                                    @elseif ($order->status === 'processing')
                                        <span class="recy-status-badge recy-status-processing">Processing</span>
                                    @elseif ($order->status === 'completed')
                                        <span class="recy-status-badge recy-status-paid">Completed</span>
                                    @else
                                        <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Produk Dipesan</h5>

                    @foreach ($order->items as $item)
                        <div class="recy-invoice-product d-flex justify-content-between align-items-center gap-3">
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

                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="recy-eco-box">
                            <div class="d-flex justify-content-between mb-3">
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

                            <div class="d-flex justify-content-between">
                                <span>Green Impact</span>
                                <strong class="text-success">{{ $order->total_eco_points * 2 }}x</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 recy-no-print">
                    @if ($order->payment_status !== 'paid')
                        <form action="{{ route('orders.pay', $order->order_code) }}" method="POST" class="mb-3">
                            @csrf

                            <button class="recy-cta-btn recy-cta-btn-primary">
                                <svg viewBox="0 0 24 24" fill="none" class="recy-payment-icon">
                                    <path
                                        d="M3 6.5A2.5 2.5 0 0 1 5.5 4h13A2.5 2.5 0 0 1 21 6.5v11A2.5 2.5 0 0 1 18.5 20h-13A2.5 2.5 0 0 1 3 17.5v-11Z"
                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                    <path d="M3 9h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <path d="M7 15l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                                <span>Simulasikan Pembayaran</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>