<x-guest-layout>
    <div class="recy-auth-page">
        <div class="recy-forgot-card">

            <div class="recy-forgot-left">
                <div class="recy-forgot-logo">
                    <span class="recy-forgot-logo-icon">♻</span>
                    <span>Recyclick</span>
                </div>

                <div style="position: relative; z-index: 2;">
                    <h2 class="fw-bold mb-3">
                        Lupa Password?
                    </h2>

                    <p class="mb-0 opacity-75">
                        Tenang, masukkan email akun kamu dan sistem akan mengirimkan link untuk membuat password baru.
                    </p>

                    <div class="recy-forgot-info-box">
                        <h6 class="fw-bold mb-2">Keamanan Akun</h6>
                        <small class="opacity-75">
                            Link reset password hanya dikirim ke email yang terdaftar di Recyclick.
                        </small>
                    </div>
                </div>
            </div>

            <div class="recy-forgot-right">
                <span class="recy-forgot-badge">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 17v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M12 8h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                        <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                    Reset Password
                </span>

                <h3 class="fw-bold mb-2">
                    Pulihkan Akun
                </h3>

                <p class="text-muted mb-4">
                    Masukkan email kamu. Kami akan mengirimkan link reset password agar kamu bisa masuk kembali ke akun
                    Recyclick.
                </p>

                @if (session('status'))
                    <div class="alert alert-success rounded-4 mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger rounded-4 mb-4">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            Email
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control recy-forgot-input" placeholder="nama@email.com" required autofocus>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="recy-forgot-back">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M12 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>Kembali ke Login</span>
                        </a>

                        <button type="submit" class="recy-forgot-submit">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M22 2L15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Kirim Link Reset</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>