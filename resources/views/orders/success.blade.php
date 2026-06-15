<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="recy-success-box mx-auto" style="max-width: 760px;">
                <div class="text-center">
                    <div class="recy-success-hero">
                        <div class="recy-success-visual">
                            <div class="recy-success-icon-wrap">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                        <h1 class="recy-success-title">
                            <div class="recy-success-status">
                                <span class="dot"></span>
                                Pesanan Berhasil Dibuat!
                            </div>
                        </h1>

                        <p class="recy-success-subtitle">
                            Terima kasih sudah berbelanja produk ramah lingkungan di Recyclick.
                            Pesanan kamu sudah tercatat dan siap dilanjutkan ke proses pembayaran.
                        </p>
                    </div>
                </div>

                <div class="recy-eco-box my-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Kode Pesanan</small>
                            <strong>{{ $order->order_code }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Total Pembayaran</small>
                            <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Metode Pembayaran</small>
                            <strong>{{ $order->payment_method }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Kode Pembayaran</small>
                            <strong>{{ $order->payment_code }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Status Pesanan</small>

                            @if ($order->status === 'pending')
                                <span class="recy-status-badge recy-status-unpaid">Pending</span>
                            @elseif ($order->status === 'processing')
                                <span class="recy-status-badge recy-status-processing">Processing</span>
                            @elseif ($order->status === 'completed')
                                <span class="recy-status-badge recy-status-paid">Completed</span>
                            @else
                                <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Status Pembayaran</small>

                            @if ($order->payment_status === 'paid')
                                <span class="recy-status-badge recy-status-paid">Paid</span>
                            @else
                                <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <small class="text-muted d-block">
                                Eco Points Pending
                            </small>

                            <strong class="text-success">
                                +{{ $order->total_eco_points }} Eco Points
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="text-center">
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

                    <div class="recy-cta-group mt-3">
                        <a href="{{ route('orders.detail', $order->order_code) }}"
                            class="recy-cta-btn recy-cta-btn-outline">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M7 3h10l3 3v15H7V3Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M17 3v4h4" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M10 11h7M10 15h7M10 19h4" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                            <span>Detail Invoice</span>
                        </a>

                        <a href="{{ route('orders.history') }}" class="recy-cta-btn recy-cta-btn-outline">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M3 12a9 9 0 1 0 3-6.7" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 4v5h5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>Lihat Riwayat</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>