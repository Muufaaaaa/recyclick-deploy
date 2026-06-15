<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Eco Products</span>

                    <h1 class="fw-bold mt-3 mb-1">
                        Katalog Produk
                    </h1>

                    <p class="text-muted mb-0">
                        Temukan produk reusable, recycled, dan zero waste dari Recyclick.
                    </p>
                </div>

                <a href="{{ route('home') }}" class="recy-home-btn mt-3 mt-md-0">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M3 11L12 3l9 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M5 10v10h5v-6h4v6h5V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Home</span>
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

            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-11">
                        <input type="text" name="search" class="form-control recy-search"
                            placeholder="Cari produk ramah lingkungan..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-1 d-grid">
                        <button class="recy-search-icon-btn" type="submit" title="Cari Produk" aria-label="Cari Produk">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            @if (request('search'))
                <div class="alert alert-success rounded-4">
                    Hasil pencarian untuk:
                    <strong>{{ request('search') }}</strong>

                    <a href="{{ route('products.index') }}" class="float-end text-success fw-bold">
                        Reset
                    </a>
                </div>
            @endif

            <div class="mb-4 d-flex flex-wrap gap-2">
                <a href="{{ route('products.index') }}" class="recy-filter-pill">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('products.category', $category->slug) }}" class="recy-filter-pill">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-md-3">
                        <div class="recy-card h-100 d-flex flex-column">

                            <div class="position-relative" style="height: 250px; overflow: hidden; background: #f8fafc;">
                                <a href="{{ route('products.show', $product->slug) }}" class="d-block h-100">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="recy-product-image"
                                            alt="{{ $product->name }}">
                                    @else
                                        <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                            No Image
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <div class="recy-product-body">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @if ($product->eco_badge)
                                        <span class="recy-badge">
                                            {{ $product->eco_badge }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="text-decoration-none text-dark">
                                    <h5 class="fw-bold mb-1">
                                        {{ $product->name }}
                                    </h5>
                                </a>

                                <small class="text-muted">
                                    {{ $product->category->name }}
                                </small>

                                <div class="mt-3">
                                    <h5 class="recy-price mb-1">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </h5>

                                    <small class="text-muted">
                                        +{{ $product->eco_points_reward }} Eco Points
                                    </small>
                                </div>

                                <div class="mt-auto pt-3">
                                    <div class="recy-card-action-row">

                                        {{-- WISHLIST --}}
                                        @auth
                                            <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST"
                                                class="recy-inline-form">
                                                @csrf

                                                <button type="submit"
                                                    class="recy-action-icon-btn recy-card-action-btn recy-action-wishlist {{ in_array($product->id, $wishlistProductIds ?? []) ? 'active' : '' }}"
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
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}"
                                                class="recy-action-icon-btn recy-card-action-btn recy-action-wishlist"
                                                title="Login untuk Wishlist" aria-label="Login untuk Wishlist">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        @endguest

                                        {{-- ADD TO CART --}}
                                        @auth
                                            @if ($product->stock > 0)
                                                <form action="{{ route('cart.store', $product->slug) }}" method="POST"
                                                    class="recy-inline-form">
                                                    @csrf

                                                    <button type="submit"
                                                        class="recy-action-icon-btn recy-card-action-btn recy-action-detail"
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
                                                <button type="button"
                                                    class="recy-action-icon-btn recy-card-action-btn recy-action-detail opacity-50"
                                                    disabled title="Stok Habis" aria-label="Stok Habis">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2"
                                                            stroke-linejoin="round" />
                                                        <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </button>
                                            @endif
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}"
                                                class="recy-action-icon-btn recy-card-action-btn recy-action-detail"
                                                title="Login untuk menambah keranjang"
                                                aria-label="Login untuk menambah keranjang">
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
                                            </a>
                                        @endguest

                                        {{-- BUY NOW --}}
                                        @auth
                                            @if ($product->stock > 0)
                                                <form action="{{ route('buy.now', $product->slug) }}" method="POST"
                                                    class="recy-inline-form">
                                                    @csrf

                                                    <button type="submit"
                                                        class="recy-action-icon-btn recy-card-action-btn recy-action-buy"
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
                                                <button type="button"
                                                    class="recy-action-icon-btn recy-card-action-btn recy-action-buy opacity-50"
                                                    disabled title="Stok Habis" aria-label="Stok Habis">
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
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}"
                                                class="recy-action-icon-btn recy-card-action-btn recy-action-buy"
                                                title="Login untuk Pesan Sekarang" aria-label="Login untuk Pesan Sekarang">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path d="M6 8h12l-1 12H7L6 8Z" stroke="currentColor" stroke-width="2"
                                                        stroke-linejoin="round" />
                                                    <path d="M9 8a3 3 0 0 1 6 0" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" />
                                                    <path d="M9.5 14l1.8 1.8 3.7-4" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        @endguest
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="recy-card">
                            <div class="p-5 text-center">
                                <h4 class="fw-bold">
                                    Produk belum tersedia
                                </h4>

                                <p class="text-muted mb-0">
                                    Produk eco-friendly akan segera hadir.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>