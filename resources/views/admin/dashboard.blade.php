<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Admin Dashboard</h1>
                    <p class="text-muted mb-0">
                        Ringkasan aktivitas Recyclick.
                    </p>
                </div>

                <div class="d-flex gap-2 mt-3 mt-md-0 flex-wrap">
                    <a href="{{ route('admin.products.index') }}" class="recy-admin-icon-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 8h12l-1 12H7L6 8Z" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />
                            <path d="M9 8a3 3 0 0 1 6 0" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                        <span>Kelola Produk</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}" class="recy-admin-icon-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 6h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M4 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M8 4v4M16 10v4M10 16v4" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                        <span>Kelola Kategori</span>
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="recy-admin-icon-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M7 3h10l3 3v15H7V3Z" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />
                            <path d="M17 3v4h4" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M10 12h7M10 16h7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <span>Kelola Order</span>
                    </a>

                    <a href="{{ route('admin.chats.index') }}" class="recy-admin-icon-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5A8.48 8.48 0 0 1 21 11v.5Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Chat Pelanggan</span>
                    </a>
                </div>
            </div>

            {{-- STATISTIC CARDS --}}
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total Produk</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalProducts }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total Order</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalOrders }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total User</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalUsers }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Eco Points</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalEcoPoints }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- REVENUE + GREEN IMPACT --}}
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Revenue Completed</small>
                            <h3 class="fw-bold text-success mb-0">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </h3>
                            <p class="text-muted small mb-0 mt-2">
                                Total pendapatan dari pesanan yang sudah completed.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Green Impact</small>
                            <h3 class="fw-bold text-success mb-0">
                                {{ $totalEcoPoints * 2 }}x kontribusi
                            </h3>
                            <p class="text-muted small mb-0 mt-2">
                                Estimasi kontribusi dari total eco points pengguna.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CHART SECTION --}}
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Status Order</h4>
                            <canvas id="orderStatusChart" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Status Pembayaran</h4>
                            <canvas id="paymentStatusChart" height="180"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LOW STOCK PRODUCTS --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Produk Stok Rendah</h4>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($lowStockProducts as $product)
                                    <tr>
                                        <td class="fw-semibold">{{ $product->name }}</td>
                                        <td>
                                            @if ($product->stock == 0)
                                                <span class="badge bg-danger">Habis</span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    {{ $product->stock }} tersisa
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="recy-admin-icon-btn recy-admin-icon-btn-sm">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 20h9" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" />
                                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                                </svg>
                                                <span>Edit Stok</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Tidak ada produk stok rendah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- LATEST ORDERS --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Order Terbaru</h4>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status Order</th>
                                    <th>Status Bayar</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($latestOrders as $order)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $order->order_code }}
                                        </td>

                                        <td>
                                            {{ $order->user->name }}
                                        </td>

                                        <td>
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            @if ($order->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif ($order->status === 'processing')
                                                <span class="badge bg-info text-dark">Processing</span>
                                            @elseif ($order->status === 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($order->payment_status === 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif ($order->payment_status === 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Unpaid</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Belum ada order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const orderStatusData = @json($orderStatusCounts);
        const paymentStatusData = @json($paymentStatusCounts);

        const orderStatusCtx = document.getElementById('orderStatusChart');
        const paymentStatusCtx = document.getElementById('paymentStatusChart');

        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [
                        orderStatusData.pending,
                        orderStatusData.processing,
                        orderStatusData.completed,
                        orderStatusData.cancelled
                    ],
                    backgroundColor: [
                        '#f59e0b',
                        '#0ea5e9',
                        '#16a34a',
                        '#dc2626'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(paymentStatusCtx, {
            type: 'bar',
            data: {
                labels: ['Unpaid', 'Paid', 'Failed'],
                datasets: [{
                    label: 'Jumlah Order',
                    data: [
                        paymentStatusData.unpaid,
                        paymentStatusData.paid,
                        paymentStatusData.failed
                    ],
                    backgroundColor: [
                        '#f59e0b',
                        '#16a34a',
                        '#dc2626'
                    ],
                    borderRadius: 10
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>