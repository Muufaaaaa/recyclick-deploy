<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Chat Detail
                        </span>

                        <h1 class="fw-bold mb-2">
                            Chat dengan {{ $user->name }}
                        </h1>

                        <p class="mb-0">
                            Email pelanggan: {{ $user->email }}
                        </p>
                    </div>

                    <a href="{{ route('admin.chats.index') }}" class="recy-admin-back-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M12 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
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
                        <div class="recy-animated-icon">
                            <span class="recy-icon-chat">💬</span>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $user->name }}
                            </h5>

                            <small class="text-muted">
                                Percakapan customer support Recyclick.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="recy-chat-box" id="adminChatBox">
                    @forelse ($chats as $chat)
                        @if ($chat->sender === 'admin')
                            <div class="d-flex justify-content-end mb-3">
                                <div class="recy-chat-bubble-user">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 opacity-75">
                                        Admin Recyclick • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-3">
                                <div class="recy-chat-bubble-admin">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 text-muted">
                                        {{ $user->name }} • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-100 d-flex align-items-center justify-content-center text-center">
                            <div>
                                <div class="recy-animated-icon mx-auto mb-3">
                                    <span class="recy-icon-chat">💬</span>
                                </div>

                                <h5 class="fw-bold">Belum ada pesan</h5>

                                <p class="text-muted mb-0">
                                    Percakapan dengan user ini masih kosong.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="recy-chat-footer">
                    <form action="{{ route('admin.chats.reply', $user->id) }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="message" class="form-control recy-form-control"
                                placeholder="Tulis balasan admin..." required>

                            <button type="submit" class="recy-admin-reply-btn">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M22 2L15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Balas</span>
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
                    Chat admin ini masih versi non-realtime. Untuk pengembangan lanjutan, fitur ini bisa memakai Laravel
                    Reverb/Pusher agar pesan masuk otomatis tanpa refresh.
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('adminChatBox');

            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</x-app-layout>