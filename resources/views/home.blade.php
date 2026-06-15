<x-app-layout>
    <div class="recy-market-page">

        {{-- HERO MARKETPLACE CAROUSEL --}}
        <section class="recy-market-hero">
            <div class="container">

                <div id="recyHeroCarousel" class="carousel slide recy-hero-carousel" data-bs-ride="carousel"
                    data-bs-interval="4500">

                    <div class="carousel-indicators recy-carousel-indicators">
                        <button type="button" data-bs-target="#recyHeroCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#recyHeroCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#recyHeroCarousel" data-bs-slide-to="2"></button>
                    </div>

                    <div class="carousel-inner">

                        {{-- SLIDE 1 --}}
                        <div class="carousel-item active">
                            <div class="recy-hero-slide green">
                                <div class="recy-hero-deco-circle one"></div>
                                <div class="recy-hero-deco-circle two"></div>
                                <div class="recy-hero-deco-shape"></div>

                                <div class="recy-floating-icon recy-hero-floating-one">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-cart">🛒</span>
                                    </div>
                                </div>

                                <div class="recy-floating-icon recy-hero-floating-two">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-recycle">♻</span>
                                    </div>
                                </div>

                                <div class="recy-hero-content">
                                    <span class="recy-badge">Eco Sale Event</span>

                                    <h1 class="mt-4">
                                        Grab Up to 30% Off
                                        On Eco Products
                                    </h1>

                                    <p>
                                        Belanja reusable bag, stainless straw, bamboo toothbrush,
                                        dan recycled notebook dalam satu platform Recyclick.
                                    </p>

                                    <div class="recy-hero-actions">
                                        <a href="{{ route('products.index') }}"
                                            class="recy-btn-primary text-decoration-none">
                                            Shop Now
                                        </a>

                                        <a href="#eco-news" class="recy-hero-secondary">
                                            Lihat Promo Lainnya
                                        </a>
                                    </div>
                                </div>

                                <div class="recy-hero-visual">
                                    @if ($featuredProducts->count() > 0 && $featuredProducts->first()->image)
                                        <img src="{{ asset('storage/' . $featuredProducts->first()->image) }}"
                                            alt="Recyclick Product">
                                    @else
                                        <div class="recy-hero-visual-icon">♻</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- SLIDE 2 --}}
                        <div class="carousel-item">
                            <div class="recy-hero-slide soft">
                                <div class="recy-hero-deco-circle one"></div>
                                <div class="recy-hero-deco-circle two"></div>
                                <div class="recy-hero-deco-shape"></div>

                                <div class="recy-floating-icon recy-hero-floating-one">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-leaf">🌱</span>
                                    </div>
                                </div>

                                <div class="recy-floating-icon recy-hero-floating-two">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-recycle">♻</span>
                                    </div>
                                </div>

                                <div class="recy-hero-content">
                                    <span class="recy-badge">Eco News</span>

                                    <h1 class="mt-4">
                                        Kurangi Plastik Sekali Pakai
                                        Mulai Hari Ini
                                    </h1>

                                    <p>
                                        Mulai dari kebiasaan kecil: ganti kantong plastik, sedotan sekali pakai,
                                        dan botol plastik dengan produk reusable yang lebih tahan lama.
                                    </p>

                                    <div class="recy-hero-actions">
                                        <a href="#eco-news" class="recy-btn-primary text-decoration-none">
                                            Baca Berita
                                        </a>

                                        <a href="{{ route('products.index') }}" class="recy-hero-secondary">
                                            Belanja Produk
                                        </a>
                                    </div>
                                </div>

                                <div class="recy-hero-visual">
                                    <div class="recy-hero-visual-icon">🌱</div>
                                </div>
                            </div>
                        </div>

                        {{-- SLIDE 3 --}}
                        <div class="carousel-item">
                            <div class="recy-hero-slide dark-green">
                                <div class="recy-hero-deco-circle one"></div>
                                <div class="recy-hero-deco-circle two"></div>
                                <div class="recy-hero-deco-shape"></div>

                                <div class="recy-floating-icon recy-hero-floating-one">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-payment">💳</span>
                                    </div>
                                </div>

                                <div class="recy-floating-icon recy-hero-floating-two">
                                    <div class="recy-animated-icon">
                                        <span class="recy-icon-recycle">🏆</span>
                                    </div>
                                </div>

                                <div class="recy-hero-content">
                                    <span class="badge bg-light text-success rounded-pill px-3 py-2">
                                        Green Shopping Week
                                    </span>

                                    <h1 class="mt-4">
                                        Dapatkan Eco Points
                                        Lebih Banyak
                                    </h1>

                                    <p>
                                        Ikuti event belanja hijau Recyclick dan kumpulkan eco points
                                        dari setiap transaksi produk ramah lingkungan.
                                    </p>

                                    <div class="recy-hero-actions">
                                        <a href="{{ route('products.index') }}"
                                            class="btn btn-light rounded-pill px-4 py-2 fw-bold text-success">
                                            Ikut Event
                                        </a>

                                        <a href="{{ route('wishlist.index') }}" class="recy-hero-secondary">
                                            Cek Wishlist
                                        </a>
                                    </div>
                                </div>

                                <div class="recy-hero-visual">
                                    <div class="recy-hero-visual-icon text-white">🏆</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev recy-carousel-control" type="button"
                        data-bs-target="#recyHeroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next recy-carousel-control" type="button"
                        data-bs-target="#recyHeroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

            </div>
        </section>

        {{-- PRODUCT SECTION --}}
        <section class="pb-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="recy-section-title mb-0">
                        Eco Products For You!
                    </h2>

                    <a href="{{ route('products.index') }}" class="recy-market-pill">
                        More Products
                    </a>
                </div>

                <div class="row g-4">
                    @forelse ($featuredProducts as $product)
                        <div class="col-md-3">
                            <div class="recy-market-card h-100">
                                <div class="position-relative">
                                    <div class="recy-market-img-wrap">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </div>

                                    <div class="position-absolute top-0 end-0 m-3">
                                        @auth
                                            <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="recy-heart border-0 {{ in_array($product->id, $wishlistProductIds ?? []) ? 'recy-heart-active' : '' }}"
                                                    title="{{ in_array($product->id, $wishlistProductIds ?? []) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}">
                                                    {{ in_array($product->id, $wishlistProductIds ?? []) ? '♥' : '♡' }}
                                                </button>
                                            </form>
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="recy-heart text-decoration-none"
                                                title="Login untuk menambahkan wishlist">
                                                ♡
                                            </a>
                                        @endguest
                                    </div>
                                </div>

                                <div class="recy-market-card-body">
                                    <h6 class="fw-bold mb-1">
                                        {{ $product->name }}
                                    </h6>

                                    <small class="text-muted d-block mb-2">
                                        {{ $product->category->name ?? 'Eco Product' }}
                                    </small>

                                    <div class="mb-2">
                                        <span class="text-warning">★★★★★</span>
                                        <small class="text-muted">(Eco rating)</small>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-success">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </strong>

                                        <a href="{{ route('products.show', $product->slug) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="recy-news-card text-center">
                                <h4 class="fw-bold">Belum ada produk</h4>
                                <p class="text-muted mb-0">Tambahkan produk melalui Admin Panel.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- CATEGORIES --}}
        <section id="categories" class="py-5 bg-white">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="recy-section-title mb-1">Popular Categories</h2>
                        <p class="text-muted mb-0">Kategori produk ramah lingkungan paling dicari.</p>
                    </div>

                    <a href="{{ route('products.index') }}" class="recy-market-pill">View All</a>
                </div>

                @php
                    $categoryIcons = [
                        'Reusable Product' => '👜',
                        'Recycled Craft' => '♻',
                        'Eco Lifestyle' => '🌱',
                        'Zero Waste' => '🚯',
                    ];
                @endphp

                <div class="row g-4">
                    @forelse ($categories as $category)
                        <div class="col-md-3">
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="recy-category-mini recy-category-link">
                                <div class="recy-category-icon">
                                    <span>
                                        {{ $categoryIcons[$category->name] ?? '♻' }}
                                    </span>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-1">{{ $category->name }}</h6>
                                    <small class="text-muted">
                                        {{ $category->description ?? 'Produk ramah lingkungan pilihan Recyclick.' }}
                                    </small>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="recy-news-card text-center">
                                <h5 class="fw-bold">Kategori belum tersedia</h5>
                                <p class="text-muted mb-0">Tambahkan kategori dari Admin Panel.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- NEWS & EVENT --}}
        <section id="eco-news" class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="recy-badge">News & Event</span>
                    <h2 class="recy-section-title mt-3">Berita & Acara Recyclick</h2>
                    <p class="text-muted mb-0">
                        Edukasi singkat dan event belanja hijau untuk pengguna Recyclick.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="recy-news-card">
                            <div class="recy-news-top">
                                <div class="recy-animated-icon">
                                    <span class="recy-icon-leaf">🌱</span>
                                </div>

                                <span class="recy-badge">Eco Tips</span>
                            </div>

                            <h4 class="fw-bold mt-3">Cara Mengurangi Plastik Sekali Pakai</h4>

                            <p class="text-muted mb-0">
                                Mulai dari mengganti kantong plastik dengan tote bag dan memakai stainless straw.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="recy-news-card">
                            <div class="recy-news-top">
                                <div class="recy-animated-icon">
                                    <span class="recy-icon-cart">🛒</span>
                                </div>

                                <span class="recy-badge">Event</span>
                            </div>

                            <h4 class="fw-bold mt-3">Green Shopping Week</h4>

                            <p class="text-muted mb-0">
                                Promo produk ramah lingkungan pilihan dengan eco points tambahan.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="recy-news-card">
                            <div class="recy-news-top">
                                <div class="recy-animated-icon">
                                    <span class="recy-icon-recycle">♻</span>
                                </div>

                                <span class="recy-badge">Impact</span>
                            </div>

                            <h4 class="fw-bold mt-3">Eco Points Sebagai Simbol Kontribusi</h4>

                            <p class="text-muted mb-0">
                                Setiap pembelian memberi poin sebagai bentuk dukungan terhadap konsumsi berkelanjutan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- DELIVERY --}}
        <section id="delivery" class="py-5">
            <div class="container">
                <div class="recy-impact-banner">
                    <div class="row align-items-center recy-impact-content">
                        <div class="col-lg-8">
                            <span class="recy-impact-label">
                                Delivery Information
                            </span>

                            <h2 class="fw-bold mb-3 recy-impact-title">
                                Belanja hijau lebih mudah dengan checkout sederhana.
                            </h2>

                            <p class="recy-impact-text">
                                Recyclick mendukung metode pembayaran COD, Transfer Bank, E-Wallet,
                                Virtual Account Dummy, dan QRIS Dummy untuk simulasi payment gateway.
                            </p>
                        </div>

                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <a href="{{ route('products.index') }}" class="recy-impact-button">
                                Mulai Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>