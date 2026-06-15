<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 mx-auto" style="max-width: 720px;">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-2">Pembayaran</h1>
                    <p class="text-muted">
                        Selesaikan pembayaran untuk pesanan kamu.
                    </p>

                    <div class="border rounded-4 p-4 my-4">
                        <p class="mb-2">
                            <strong>Kode Pesanan:</strong> {{ $order->order_code }}
                        </p>

                        <p class="mb-2">
                            <strong>Total Pembayaran:</strong>
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>

                        <p class="mb-2">
                            <strong>Metode:</strong> {{ $order->payment_method }}
                        </p>

                        <p class="mb-0">
                            <strong>Status Pembayaran:</strong>
                            @if ($order->payment_status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">Unpaid</span>
                            @endif
                        </p>
                    </div>

                    @if ($order->payment_method === 'Transfer Bank')
                        <div class="alert alert-success rounded-4">
                            <strong>Instruksi Transfer Bank:</strong><br>
                            Transfer ke rekening dummy:
                            <br>
                            <strong>Bank GreenPay - 1234567890 a.n Recyclick</strong>
                        </div>
                    @elseif ($order->payment_method === 'E-Wallet')
                        <div class="alert alert-success rounded-4">
                            <strong>Instruksi E-Wallet:</strong><br>
                            Kirim pembayaran dummy ke:
                            <br>
                            <strong>GreenWallet 0812-0000-9999</strong>
                        </div>
                    @else
                        <div class="alert alert-secondary rounded-4">
                            <strong>COD:</strong><br>
                            Pembayaran dilakukan saat barang diterima.
                        </div>
                    @endif

                    @if ($order->payment_status !== 'paid' && $order->payment_method !== 'COD')
                        <form action="{{ route('orders.pay', $order->order_code) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success rounded-pill px-4">
                                Simulasikan Pembayaran Berhasil
                            </button>
                        </form>
                    @elseif ($order->payment_status === 'paid')
                        <a href="{{ route('orders.success', $order->order_code) }}"
                            class="btn btn-success rounded-pill px-4">
                            Lihat Pesanan
                        </a>
                    @else
                        <a href="{{ route('orders.history') }}" class="btn btn-success rounded-pill px-4">
                            Lihat Riwayat Pesanan
                        </a>
                    @endif

                    <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill px-4">
                        Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>