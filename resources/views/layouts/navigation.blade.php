<nav class="recy-shop-navbar">
    <div class="container">
        <div class="recy-main-nav recy-navbar-layout">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="recy-wordmark text-decoration-none">
                <span class="recy-wordmark-symbol">♻</span>
                <span class="recy-wordmark-text">Recyclick</span>
            </a>

            {{-- DESKTOP MENU --}}
            <div class="recy-desktop-menu d-none d-lg-flex align-items-center gap-4">
                <a href="{{ route('products.index') }}" class="recy-nav-link">Produk</a>
                <a href="{{ route('home') }}#categories" class="recy-nav-link">Kategori</a>
                <a href="{{ route('home') }}#eco-news" class="recy-nav-link">Berita & Acara</a>
                <a href="{{ route('home') }}#delivery" class="recy-nav-link">Delivery</a>
            </div>

            {{-- DESKTOP SEARCH --}}
            <form action="{{ route('products.index') }}" method="GET"
                class="recy-nav-search recy-navbar-search d-none d-lg-flex">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit">⌕</button>
            </form>

            {{-- DESKTOP ACTIONS --}}
            <div class="d-none d-lg-flex align-items-center gap-2 recy-navbar-actions recy-icon-actions">
                @guest
                    <a href="{{ route('login') }}" class="recy-mini-btn">Login</a>
                    <a href="{{ route('register') }}" class="recy-nav-link">Register</a>
                @endguest

                @auth
                    {{-- ECO POINTS --}}
                    <span class="recy-nav-icon-points" title="{{ Auth::user()->eco_points }} Eco Points">
                        <span>🍀</span>
                        <strong>{{ Auth::user()->eco_points }}</strong>
                    </span>

                    {{-- ACCOUNT --}}
                    <a href="{{ route('dashboard') }}" class="recy-nav-icon-btn recy-icon-user" title="Account"
                        aria-label="Account">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5Z" stroke="currentColor"
                                stroke-width="2" />
                            <path d="M20 22c0-4.418-3.582-8-8-8s-8 3.582-8 8" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </a>

                    {{-- WISHLIST --}}
                    <a href="{{ route('wishlist.index') }}" class="recy-nav-icon-btn recy-icon-heart" title="Wishlist"
                        aria-label="Wishlist">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                    {{-- CART --}}
                    <a href="{{ route('cart.index') }}" class="recy-nav-icon-btn recy-icon-cart-nav" title="Cart"
                        aria-label="Cart">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </a>

                    {{-- CHAT --}}
                    <a href="{{ route('chat.index') }}" class="recy-nav-icon-btn recy-icon-chat-nav" title="Chat Admin"
                        aria-label="Chat Admin">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5A8.48 8.48 0 0 1 21 11v.5Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                    {{-- ADMIN --}}
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="recy-nav-icon-btn recy-icon-admin" title="Admin Panel"
                            aria-label="Admin Panel">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 2 4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3Z" stroke="currentColor"
                                    stroke-width="2" stroke-linejoin="round" />
                                <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf

                        <button type="submit" class="recy-nav-icon-btn recy-icon-logout" title="Logout" aria-label="Logout">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                                <path d="M16 17l5-5-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </button>
                    </form>
                @endauth
            </div>

            {{-- MOBILE TOGGLE --}}
            <button class="recy-mobile-toggle d-lg-none ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#recyMobileMenu">
                ☰
            </button>
        </div>

        {{-- MOBILE MENU --}}
        <div class="collapse d-lg-none" id="recyMobileMenu">
            <div class="recy-mobile-menu">

                <form action="{{ route('products.index') }}" method="GET" class="recy-mobile-search mb-3">
                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                    <button type="submit">Cari</button>
                </form>

                <a href="{{ route('products.index') }}" class="recy-mobile-link">Produk</a>
                <a href="{{ route('home') }}#categories" class="recy-mobile-link">Kategori</a>
                <a href="{{ route('home') }}#eco-news" class="recy-mobile-link">Berita & Acara</a>
                <a href="{{ route('home') }}#delivery" class="recy-mobile-link">Delivery</a>

                @guest
                    <hr>
                    <a href="{{ route('login') }}" class="recy-mobile-link text-success fw-bold">Login</a>
                    <a href="{{ route('register') }}" class="recy-mobile-link">Register</a>
                @endguest

                @auth
                    <hr>
                    <a href="{{ route('dashboard') }}" class="recy-mobile-link">Dashboard</a>
                    <a href="{{ route('cart.index') }}" class="recy-mobile-link">Keranjang</a>
                    <a href="{{ route('wishlist.index') }}" class="recy-mobile-link">Wishlist</a>
                    <a href="{{ route('orders.history') }}" class="recy-mobile-link">Riwayat</a>
                    <a href="{{ route('chat.index') }}" class="recy-mobile-link">Chat Admin</a>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="recy-mobile-link text-success fw-bold">
                            Admin Panel
                        </a>
                    @endif

                    <div class="mt-3">
                        <span class="badge bg-success rounded-pill mb-2">
                            {{ Auth::user()->eco_points }} Eco Points
                        </span>

                        <p class="mb-2 fw-semibold">
                            {{ Auth::user()->name }}
                        </p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>