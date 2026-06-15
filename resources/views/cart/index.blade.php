<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            @php
                $cartCount = $cart->items->sum('quantity');
                $totalPrice = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);
                $totalEcoPoints = $cart->items->sum(fn($item) => $item->quantity * $item->product->eco_points_reward);
            @endphp

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Shopping Cart</span>

                    <h1 class="fw-bold mt-3 mb-1">Keranjang Belanja</h1>

                    <p class="text-muted mb-0">
                        Review produk ramah lingkungan sebelum checkout.
                    </p>
                </div>

                @if ($cart->items->count() > 0)
                    <a href="{{ route('products.index') }}" class="recy-shop-cta recy-shop-cta-outline mt-3 mt-md-0">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6 6h15l-2 8H8L6 6Z"
                                  stroke="currentColor"
                                  stroke-width="2"
                                  stroke-linejoin="round"/>
                            <path d="M6 6 5 2H2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                  stroke-linecap="round"/>
                            <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                  stroke="currentColor"
                                  stroke-width="2"/>
                            <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                  stroke="currentColor"
                                  stroke-width="2"/>
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

            @if ($cart->items->count() > 0)
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="d-flex flex-column gap-3">
                            @foreach ($cart->items as $item)
                                <div class="recy-card p-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-5">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width: 74px; height: 74px; border-radius: 18px; overflow: hidden; background: #f8fafc; flex-shrink: 0;">
                                                    @if ($item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             style="width: 100%; height: 100%; object-fit: cover;">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                            No Image
                                                        </div>
                                                    @endif
                                                </div>

                                                <div>
                                                    <a href="{{ route('products.show', $item->product->slug) }}"
                                                       class="text-decoration-none text-dark">
                                                        <h5 class="fw-bold mb-1">
                                                            {{ $item->product->name }}
                                                        </h5>
                                                    </a>

                                                    <small class="text-muted d-block">
                                                        {{ $item->product->category->name }}
                                                    </small>

                                                    @if ($item->product->eco_badge)
                                                        <span class="recy-badge mt-2 d-inline-block">
                                                            {{ $item->product->eco_badge }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="recy-cart-qty-wrap">
                                            <small class="text-muted d-block mb-2">Quantity</small>

                                            @php
                                                $canDecrease = $item->quantity > 1;
                                                $canIncrease = $item->quantity < $item->product->stock;
                                            @endphp

                                            <div class="recy-qty-stepper">
                                                {{-- MINUS --}}
                                                <form action="{{ route('cart.update', $item->id) }}"
                                                      method="POST"
                                                      class="recy-qty-form">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden"
                                                           name="quantity"
                                                           value="{{ max(1, $item->quantity - 1) }}">

                                                    <button type="submit"
                                                            class="recy-qty-btn"
                                                            title="Kurangi Quantity"
                                                            aria-label="Kurangi Quantity"
                                                            @disabled(!$canDecrease)>
                                                        −
                                                    </button>
                                                </form>

                                                {{-- CURRENT QTY --}}
                                                <span class="recy-qty-number">
                                                    {{ $item->quantity }}
                                                </span>

                                                {{-- PLUS --}}
                                                <form action="{{ route('cart.update', $item->id) }}"
                                                      method="POST"
                                                      class="recy-qty-form">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden"
                                                           name="quantity"
                                                           value="{{ min($item->product->stock, $item->quantity + 1) }}">

                                                    <button type="submit"
                                                            class="recy-qty-btn"
                                                            title="Tambah Quantity"
                                                            aria-label="Tambah Quantity"
                                                            @disabled(!$canIncrease)>
                                                        +
                                                    </button>
                                                </form>
                                            </div>

                                            <small class="text-muted d-block mt-2">
                                                Stok: {{ $item->product->stock }}
                                            </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <small class="text-muted d-block mb-1">Subtotal</small>

                                            <h5 class="recy-price mb-1">
                                                Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                            </h5>

                                            <small class="text-muted">
                                                +{{ $item->quantity * $item->product->eco_points_reward }} Eco Points
                                            </small>
                                        </div>

                                        <div class="col-md-1 text-md-end">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-outline-danger rounded-circle"
                                                        style="width: 42px; height: 42px;"
                                                        title="Hapus dari Keranjang"
                                                        aria-label="Hapus dari Keranjang">
                                                    ×
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="recy-card p-4">
                            <span class="recy-page-badge mb-3 d-inline-block">Order Summary</span>

                            <h4 class="fw-bold mb-4">Ringkasan Belanja</h4>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Produk</span>
                                <strong>{{ $cartCount }} item</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Harga</span>
                                <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Eco Points</span>
                                <strong class="text-success">+{{ $totalEcoPoints }}</strong>
                            </div>

                            <hr>

                            <div class="recy-eco-box my-4">
                                <h5 class="fw-bold text-success mb-2">Green Impact</h5>

                                <p class="text-muted mb-0">
                                    Pembelian ini memberi kontribusi sekitar {{ $totalEcoPoints * 2 }}x dampak hijau.
                                </p>
                            </div>

                            <a href="{{ route('checkout') }}"
                               class="recy-shop-cta recy-cart-checkout-btn">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M6 8h12l-1 12H7L6 8Z"
                                          stroke="currentColor"
                                          stroke-width="2"
                                          stroke-linejoin="round"/>
                                    <path d="M9 8a3 3 0 0 1 6 0"
                                          stroke="currentColor"
                                          stroke-width="2"
                                          stroke-linecap="round"/>
                                    <path d="M9.5 14l1.8 1.8 3.7-4"
                                          stroke="currentColor"
                                          stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <span>Checkout Sekarang</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="recy-empty-state recy-cart-empty">
                    <div class="recy-cart-empty-content">
                        <div class="recy-animated-icon mx-auto mb-3">
                            <span class="recy-icon-cart">🛒</span>
                        </div>

                        <h4 class="fw-bold mb-2">Keranjang masih kosong</h4>

                        <p class="text-muted">
                            Tambahkan produk reusable, recycled, atau zero waste ke keranjang kamu.
                        </p>

                        <a href="{{ route('products.index') }}" class="recy-shop-cta">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M6 6h15l-2 8H8L6 6Z"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linejoin="round"/>
                                <path d="M6 6 5 2H2"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"/>
                                <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                      stroke="currentColor"
                                      stroke-width="2"/>
                                <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                      stroke="currentColor"
                                      stroke-width="2"/>
                            </svg>
                            <span>Lihat Produk</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>