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
                                Join Green Shopping.
                            </h1>

                            <p class="opacity-75 mb-4">
                                Buat akun Recyclick untuk mulai menyimpan wishlist,
                                checkout produk ramah lingkungan, dan mengumpulkan eco points.
                            </p>

                            <div class="recy-auth-feature mb-3">
                                <strong>Wishlist Produk</strong>
                                <p class="mb-0 opacity-75 small">
                                    Simpan produk eco-friendly favorit kamu.
                                </p>
                            </div>

                            <div class="recy-auth-feature">
                                <strong>Payment Simulation</strong>
                                <p class="mb-0 opacity-75 small">
                                    Coba alur checkout dengan simulasi pembayaran.
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
                        <span class="recy-auth-badge">Register</span>

                        <h2 class="fw-bold mt-3 mb-2">
                            Buat Akun Baru
                        </h2>

                        <p class="text-muted mb-4">
                            Daftar untuk mulai menggunakan fitur Recyclick.
                        </p>

                        @if ($errors->any())
                            <div class="alert alert-danger rounded-4">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control recy-auth-input" placeholder="Nama lengkap" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control recy-auth-input" placeholder="nama@email.com" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control recy-auth-input"
                                    placeholder="Minimal 8 karakter" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control recy-auth-input"
                                    placeholder="Ulangi password" required>
                            </div>

                            <button type="submit" class="recy-btn-primary w-100 mb-3">
                                Register
                            </button>

                            <p class="text-center text-muted mb-0">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="recy-auth-link">
                                    Login
                                </a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>