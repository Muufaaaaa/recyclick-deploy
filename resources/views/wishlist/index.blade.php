<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Saved Products</span>

                    <h1 class="fw-bold mt-3 mb-1">Wishlist</h1>

                    <p class="text-muted mb-0">
                        Produk ramah lingkungan yang kamu simpan untuk dibeli nanti.
                    </p>
                </div>

                @if ($wishlists->count() > 0)
                    <a href="{{ route('products.index') }}" class="recy-shop-cta recy-shop-cta-outline mt-3 mt-md-0">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <span>Lanjut Belanja</span>
                    </a>
                @endif
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

            <div class="row g-4">
                @forelse ($wishlists as $wishlist)
                    @php
                        $product = $wishlist->product;
                    @endphp

                    <div class="col-md-3">
                        <div class="recy-card recy-wishlist-card-fixed h-100 d-flex flex-column">

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

                                        {{-- REMOVE WISHLIST --}}
                                        <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST"
                                            class="recy-inline-form">
                                            @csrf

                                            <button type="submit"
                                                class="recy-action-icon-btn recy-card-action-btn recy-action-wishlist active"
                                                title="Hapus dari Wishlist" aria-label="Hapus dari Wishlist">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>

                                        {{-- ADD TO CART --}}
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

                                        {{-- BUY NOW --}}
                                        @if ($product->stock > 0)
                                            <form action="{{ route('cart.store', $product->slug) }}" method="POST"
                                                class="recy-inline-form">
                                                @csrf

                                                <input type="hidden" name="buy_now" value="1">

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
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="recy-empty-state recy-wishlist-empty">
                            <div class="recy-wishlist-empty-content">
                                <div class="recy-animated-icon mx-auto mb-3">
                                    <span class="recy-icon-leaf">♡</span>
                                </div>

                                <h4 class="fw-bold mb-2">
                                    Wishlist masih kosong
                                </h4>

                                <p class="text-muted">
                                    Simpan produk favorit kamu agar mudah ditemukan lagi.
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
                                    <span>Lihat Produk</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>