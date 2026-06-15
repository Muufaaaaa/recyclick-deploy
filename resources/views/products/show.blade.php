<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="mb-5">
                <a href="{{ route('products.index') }}" class="recy-catalog-btn">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 7h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <span>Katalog</span>
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="row g-5 align-items-start">

                {{-- IMAGE SIDE --}}
                <div class="col-lg-6">
                    <div class="recy-detail-image-wrap">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="recy-detail-image">
                        @else
                            <div class="recy-detail-image d-flex align-items-center justify-content-center text-muted">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Kategori</small>
                                <strong>{{ $product->category->name }}</strong>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Eco Points</small>
                                <strong class="text-success">+{{ $product->eco_points_reward }}</strong>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Stok</small>
                                <strong>{{ $product->stock }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DETAIL SIDE --}}
                <div class="col-lg-6">
                    <div class="recy-detail-panel">

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if ($product->eco_badge)
                                <span class="recy-badge">
                                    {{ $product->eco_badge }}
                                </span>
                            @endif
                        </div>

                        <h1 class="fw-bold mb-2">
                            {{ $product->name }}
                        </h1>

                        <p class="text-muted mb-4">
                            {{ $product->category->name }} · Produk ramah lingkungan pilihan Recyclick
                        </p>

                        <h2 class="recy-price mb-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h2>

                        @if ($product->stock <= 5 && $product->stock > 0)
                            <div class="recy-stock-warning mb-4">
                                Hanya tersisa {{ $product->stock }} item
                            </div>
                        @elseif ($product->stock <= 0)
                            <div class="badge bg-secondary rounded-pill mb-4 p-2">
                                Stok Habis
                            </div>
                        @endif

                        <hr>

                        <h5 class="fw-bold mt-4">
                            Deskripsi Produk
                        </h5>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <div class="recy-eco-box my-4">
                            <h5 class="fw-bold text-success mb-2">
                                Green Impact
                            </h5>

                            <p class="text-muted mb-2">
                                Dengan membeli produk ini, kamu ikut mendukung gaya hidup berkelanjutan dan mengurangi
                                penggunaan barang sekali pakai.
                            </p>

                            <div class="d-flex justify-content-between">
                                <span>Eco Impact</span>
                                <strong class="text-success">{{ $product->eco_impact }}x kontribusi</strong>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="recy-mini-info">
                                    <small class="text-muted d-block">Pengiriman</small>
                                    <strong>Estimasi 2–4 hari</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="recy-mini-info">
                                    <small class="text-muted d-block">Pembayaran</small>
                                    <strong>COD / E-Wallet / QRIS Dummy</strong>
                                </div>
                            </div>
                        </div>

                        @auth
                            <div class="recy-action-row mt-4">
                                {{-- Wishlist --}}
                                <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST"
                                    class="recy-inline-form">
                                    @csrf

                                    <button type="submit"
                                        class="recy-action-icon-btn recy-action-wishlist {{ in_array($product->id, $wishlistProductIds ?? []) ? 'active' : '' }}"
                                        title="{{ in_array($product->id, $wishlistProductIds ?? []) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}"
                                        aria-label="Wishlist">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>

                                {{-- Add to cart --}}
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.store', $product->slug) }}" method="POST"
                                        class="recy-inline-form">
                                        @csrf

                                        <button type="submit" class="recy-action-icon-btn recy-action-detail"
                                            title="Tambah ke Keranjang" aria-label="Tambah ke Keranjang">
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
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="recy-action-icon-btn recy-action-detail opacity-50" disabled
                                        title="Stok Habis" aria-label="Stok Habis">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2"
                                                stroke-linejoin="round" />
                                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                @endif

                                {{-- Buy now --}}
                                @if ($product->stock > 0)
                                    <form action="{{ route('buy.now', $product->slug) }}" method="POST"
                                        class="recy-inline-form">
                                        @csrf

                                        <button type="submit" class="recy-action-icon-btn recy-action-buy"
                                            title="Pesan Sekarang" aria-label="Pesan Sekarang">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M6 8h12l-1 12H7L6 8Z" stroke="currentColor" stroke-width="2"
                                                    stroke-linejoin="round" />
                                                <path d="M9 8a3 3 0 0 1 6 0" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" />
                                                <path d="M9.5 14l1.8 1.8 3.7-4" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="recy-action-icon-btn recy-action-buy opacity-50" disabled
                                        title="Stok Habis" aria-label="Stok Habis">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M6 8h12l-1 12H7L6 8Z" stroke="currentColor" stroke-width="2"
                                                stroke-linejoin="round" />
                                            <path d="M9 8a3 3 0 0 1 6 0" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" />
                                            <path d="M9.5 14l1.8 1.8 3.7-4" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        @endauth

                        @guest
                            <div class="alert alert-success rounded-4 mt-4">
                                <div class="recy-chat-note-icon">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M12 17v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <path d="M12 8h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                        <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor"
                                            stroke-width="2" />
                                    </svg>
                                </div>

                                Login terlebih dahulu untuk menambahkan produk ke keranjang atau wishlist.
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('login') }}" class="recy-btn-primary text-decoration-none">
                                    Login
                                </a>

                                <a href="{{ route('register') }}" class="recy-btn-outline text-decoration-none">
                                    Register
                                </a>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>