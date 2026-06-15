<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Checkout</span>
                    <h1 class="fw-bold mt-3 mb-1">Checkout Pesanan</h1>
                    <p class="text-muted mb-0">
                        Lengkapi data pengiriman dan pilih metode pembayaran.
                    </p>
                </div>

                <a href="{{ route('cart.index') }}" class="recy-checkout-action recy-checkout-outline mt-3 mt-md-0">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                    <span>Keranjang</span>
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @php
                $total = 0;
                $totalEcoPoints = 0;
            @endphp

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="recy-checkout-section">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-payment">💳</span>
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">Data Pengiriman</h4>
                                <p class="text-muted mb-0">
                                    Pastikan alamat dan nomor HP sudah benar.
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea name="address" class="form-control recy-form-control" rows="4"
                                    placeholder="Masukkan alamat lengkap..." required>{{ old('address') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nomor HP</label>
                                <input type="text" name="phone" class="form-control recy-form-control"
                                    value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Metode Pembayaran</label>

                                <select name="payment_method" class="form-select recy-form-control" required>
                                    <option value="COD" @selected(old('payment_method') === 'COD')>COD</option>
                                    <option value="Transfer Bank" @selected(old('payment_method') === 'Transfer Bank')>
                                        Transfer Bank</option>
                                    <option value="E-Wallet" @selected(old('payment_method') === 'E-Wallet')>E-Wallet
                                    </option>
                                    <option value="Virtual Account Dummy" @selected(old('payment_method') === 'Virtual Account Dummy')>Virtual Account Dummy</option>
                                    <option value="QRIS Dummy" @selected(old('payment_method') === 'QRIS Dummy')>QRIS
                                        Dummy</option>
                                </select>

                                <small class="text-muted">
                                    Payment gateway masih simulasi dan bisa dikembangkan ke Midtrans/QRIS sandbox.
                                </small>
                            </div>

                            <button type="submit" class="recy-checkout-action recy-checkout-primary w-100">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M7 4h10l2 4v12H5V8l2-4Z" stroke="currentColor" stroke-width="2"
                                        stroke-linejoin="round" />
                                    <path d="M9 8a3 3 0 0 0 6 0" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                    <path d="M9.5 15l1.8 1.8 3.7-4" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Buat Pesanan</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="recy-summary-card">
                        <span class="recy-page-badge">Order Review</span>

                        <h4 class="fw-bold mt-3 mb-4">
                            Ringkasan Pesanan
                        </h4>

                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach ($cart->items as $item)
                                @php
                                    $subtotal = $item->product->price * $item->quantity;
                                    $ecoSubtotal = $item->product->eco_points_reward * $item->quantity;
                                    $total += $subtotal;
                                    $totalEcoPoints += $ecoSubtotal;
                                @endphp

                                <div class="d-flex justify-content-between gap-3 border-bottom pb-3">
                                    <div>
                                        <strong class="d-block">
                                            {{ $item->product->name }}
                                        </strong>

                                        <small class="text-muted">
                                            Qty: {{ $item->quantity }} × Rp
                                            {{ number_format($item->product->price, 0, ',', '.') }}
                                        </small>
                                    </div>

                                    <div class="text-end">
                                        <strong class="text-success d-block">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </strong>

                                        <small class="text-muted">
                                            +{{ $ecoSubtotal }} pts
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Harga</span>
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Eco Points</span>
                            <strong class="text-success">+{{ $totalEcoPoints }}</strong>
                        </div>

                        <hr>

                        <div class="recy-eco-box">
                            <h6 class="fw-bold text-success mb-1">
                                Dampak Pembelian
                            </h6>

                            <small class="text-muted">
                                Pesanan ini mendukung gaya hidup berkelanjutan dan memberi
                                <strong>{{ $totalEcoPoints }}</strong> eco points.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>