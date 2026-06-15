<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Order Detail
                        </span>

                        <h1 class="fw-bold mb-2">
                            {{ $order->order_code }}
                        </h1>

                        <p class="mb-0">
                            Detail transaksi dan status pesanan pelanggan.
                        </p>
                    </div>

                    <a href="{{ route('admin.orders.index') }}" class="recy-admin-back-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M12 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="recy-admin-detail-card mb-4">
                        <h4 class="fw-bold mb-3">Informasi Pesanan</h4>

                        <div class="recy-admin-info-row">
                            <span>Kode Pesanan</span>
                            <strong>{{ $order->order_code }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Pelanggan</span>
                            <strong>{{ $order->user->name }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Email</span>
                            <strong>{{ $order->user->email }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>No HP</span>
                            <strong>{{ $order->phone }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Alamat</span>
                            <strong>{{ $order->address }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Metode Pembayaran</span>
                            <strong>{{ $order->payment_method }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Kode Pembayaran</span>
                            <strong>{{ $order->payment_code ?? '-' }}</strong>
                        </div>
                    </div>

                    <div class="recy-admin-detail-card">
                        <h4 class="fw-bold mb-3">Produk Dipesan</h4>

                        @foreach ($order->items as $item)
                            <div class="recy-order-item d-flex justify-content-between align-items-center gap-3">
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

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold">Total</h5>
                            <h5 class="fw-bold text-success">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </h5>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Eco Points</span>
                            <strong class="text-success">+{{ $order->total_eco_points }}</strong>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="recy-admin-detail-card mb-4">
                        <h4 class="fw-bold mb-3">Status Pesanan</h4>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Status Order Saat Ini</small>

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

                        <div class="mb-4">
                            <small class="text-muted d-block mb-1">Status Pembayaran</small>

                            @if ($order->payment_status === 'paid')
                                <span class="recy-status-badge recy-status-paid">Paid</span>
                            @elseif ($order->payment_status === 'failed')
                                <span class="recy-status-badge recy-status-cancelled">Failed</span>
                            @else
                                <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                            @endif
                        </div>

                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <label class="recy-admin-form-label">Ubah Status Order</label>

                            <select name="status" class="form-select recy-form-control mb-3">
                                <option value="pending" @selected($order->status === 'pending')>Pending</option>
                                <option value="processing" @selected($order->status === 'processing')>Processing</option>
                                <option value="completed" @selected($order->status === 'completed')>Completed</option>
                                <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                            </select>

                            <button class="recy-btn-primary w-100">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <div class="recy-eco-box">
                        <h5 class="fw-bold text-success mb-2">Green Impact</h5>
                        <p class="text-muted mb-2">
                            Pesanan ini memberikan:
                        </p>

                        <h2 class="fw-bold text-success mb-0">
                            +{{ $order->total_eco_points }} Eco Points
                        </h2>

                        <small class="text-muted">
                            Estimasi {{ $order->total_eco_points * 2 }}x kontribusi hijau.
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>