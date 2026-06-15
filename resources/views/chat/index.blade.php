<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-page-badge">Customer Support</span>

                    <h1 class="fw-bold mt-3 mb-1">
                        Chat Admin
                    </h1>

                    <p class="text-muted mb-0">
                        Tanyakan produk, pesanan, pembayaran, atau bantuan belanja Recyclick.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="recy-chat-product-btn mt-3 mt-md-0">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M6 6h15l-2 8H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        <path d="M6 6 5 2H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                        <path d="M18 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                    <span>Lihat Produk</span>
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

            <div class="recy-chat-shell">
                <div class="recy-chat-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="recy-chat-avatar">
                            <span class="recy-chat-avatar-emoji">🧑‍💻</span>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Admin Recyclick
                            </h5>

                            <small class="text-muted">
                                Support sederhana untuk pertanyaan produk dan pesanan.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="recy-chat-box" id="chatBox">
                    @forelse ($chats as $chat)
                        @if ($chat->sender === 'user')
                            <div class="d-flex justify-content-end mb-3">
                                <div class="recy-chat-bubble-user">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 opacity-75">
                                        Kamu • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-3">
                                <div class="recy-chat-bubble-admin">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 text-muted">
                                        Admin Recyclick • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-100 d-flex align-items-center justify-content-center text-center">
                            <div>
                                <div class="recy-chat-empty-icon mx-auto">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5A8.48 8.48 0 0 1 21 11v.5Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <h5 class="fw-bold mb-2">
                                    Belum ada pesan
                                </h5>

                                <p class="text-muted mb-0">
                                    Mulai percakapan dengan admin Recyclick.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="recy-chat-footer">
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="message" class="form-control recy-form-control"
                                placeholder="Tulis pesan..." required>

                            <button type="submit" class="recy-send-btn">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M22 2L15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Kirim</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert alert-success rounded-4 mt-4 recy-chat-note">
                <div class="recy-chat-note-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 17v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M12 8h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                        <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>

                <div>
                    <strong>Catatan:</strong>
                    Fitur chat ini masih versi sederhana. Nanti bisa dikembangkan menjadi realtime chat dengan Laravel
                    Reverb/Pusher.
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chatBox');

            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</x-app-layout>