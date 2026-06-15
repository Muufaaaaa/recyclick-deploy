<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Customer Chat
                        </span>

                        <h1 class="fw-bold mb-2">
                            Chat Pelanggan
                        </h1>

                        <p class="mb-0">
                            Kelola pertanyaan, bantuan produk, dan pesan pelanggan Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}" class="recy-admin-chat-btn recy-admin-chat-btn-outline">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 13h6V4H4v9Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M14 20h6V4h-6v16Z" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />
                            <path d="M4 20h6v-3H4v3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        </svg>
                        <span>Admin Panel</span>
                    </a>
                </div>
            </div>

            <div class="recy-admin-card">
                @forelse ($conversations as $conversation)
                    @php
                        $unreadCount = \App\Models\Chat::where('user_id', $conversation->user_id)
                            ->where('sender', 'user')
                            ->where('is_read', false)
                            ->count();

                        $totalMessages = \App\Models\Chat::where('user_id', $conversation->user_id)->count();
                    @endphp

                    <div class="p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="recy-animated-icon">
                                    <span class="recy-icon-chat">💬</span>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        {{ $conversation->user->name }}
                                    </h5>

                                    <small class="text-muted d-block">
                                        {{ $conversation->user->email }}
                                    </small>

                                    <p class="text-muted mb-0 mt-2">
                                        {{ \Illuminate\Support\Str::limit($conversation->message, 90) }}
                                    </p>
                                </div>
                            </div>

                            <div class="text-md-end">
                                @if ($unreadCount > 0)
                                    <span class="recy-status-badge recy-status-cancelled mb-2">
                                        {{ $unreadCount }} pesan baru
                                    </span>
                                @else
                                    <span class="recy-status-badge recy-status-paid mb-2">
                                        Sudah dibaca
                                    </span>
                                @endif

                                <small class="text-muted d-block mb-3">
                                    {{ $totalMessages }} pesan · {{ $conversation->created_at->format('d M Y H:i') }}
                                </small>

                                <a href="{{ route('admin.chats.show', $conversation->user_id ?? $chat->user_id ?? $user->id) }}"
                                    class="recy-admin-chat-btn recy-admin-chat-btn-primary">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5A8.48 8.48 0 0 1 21 11v.5Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>Buka Chat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="recy-admin-empty">
                        <div class="recy-animated-icon mx-auto mb-3">
                            <span class="recy-icon-chat">💬</span>
                        </div>

                        <h5 class="fw-bold">Belum ada chat</h5>

                        <p class="text-muted mb-0">
                            Pesan dari pelanggan akan muncul di halaman ini.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>