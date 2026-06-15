<x-guest-layout>
    <div class="recy-auth-page">
        <div class="recy-auth-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="recy-auth-side">
                        <div style="position: relative; z-index: 2;">
                            <a href="{{ route('home') }}" class="recy-auth-logo">
                                <span class="recy-auth-logo-icon">♻</span>
                                <span>Recyclick</span>
                            </a>

                            <h1 class="fw-bold mt-5 mb-3">
                                Welcome Back!
                            </h1>

                            <p class="opacity-75 mb-4">
                                Masuk ke akun Recyclick untuk melanjutkan belanja produk ramah lingkungan,
                                cek pesanan, wishlist, dan eco points kamu.
                            </p>

                            <div class="recy-auth-feature mb-3">
                                <strong>Eco Points</strong>
                                <p class="mb-0 opacity-75 small">
                                    Kumpulkan poin dari setiap transaksi eco-friendly.
                                </p>
                            </div>

                            <div class="recy-auth-feature">
                                <strong>Green Shopping</strong>
                                <p class="mb-0 opacity-75 small">
                                    Belanja reusable, recycled, dan zero waste products.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="recy-auth-form">
                        <a href="{{ route('home') }}" class="recy-home-btn recy-auth-home-top">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M3 11L12 3l9 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M5 10v10h5v-6h4v6h5V10" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Home</span>
                        </a>
                        <span class="recy-auth-badge">Login</span>

                        <h2 class="fw-bold mt-3 mb-2">
                            Masuk ke Akun
                        </h2>

                        <p class="text-muted mb-4">
                            Gunakan email dan password untuk masuk ke Recyclick.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success rounded-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger rounded-4">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control recy-auth-input" placeholder="nama@email.com" required
                                    autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control recy-auth-input"
                                    placeholder="Masukkan password" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <label class="d-flex align-items-center gap-2">
                                    <input type="checkbox" name="remember" class="form-check-input">
                                    <span class="text-muted small">Remember me</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="recy-auth-link small">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="recy-btn-primary w-100 mb-3">
                                Login
                            </button>

                            <p class="text-center text-muted mb-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="recy-auth-link">
                                    Daftar sekarang
                                </a>
                            </p>
                        </form>

                        <div class="alert alert-success rounded-4 mt-4">
                            <strong>Demo Admin:</strong> admin@recyclick.test / password
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>