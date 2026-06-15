<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Category Management
                        </span>

                        <h1 class="fw-bold mb-2">
                            Kelola Kategori
                        </h1>

                        <p class="mb-0">
                            Atur kategori produk ramah lingkungan di Recyclick.
                        </p>
                    </div>

                    <div class="recy-admin-toolbar">
                        <a href="{{ route('admin.dashboard') }}" class="recy-admin-top-btn recy-admin-btn-outline">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 13h6V4H4v9Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M14 20h6V4h-6v16Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M4 20h6v-3H4v3Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>Admin Panel</span>
                        </a>

                        <a href="{{ route('admin.categories.create') }}"
                            class="recy-admin-top-btn recy-admin-btn-primary">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 7h7v7H4V7Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M13 7h7v7h-7V7Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M12 17v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M10 19h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <span>Tambah Kategori</span>
                        </a>
                    </div>
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

            <div class="recy-admin-card">
                <div class="table-responsive">
                    <table class="table recy-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Total Produk</th>
                                <th class="text-center" width="190">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $category->slug }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $category->description ?? '-' }}
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-success rounded-pill">
                                            {{ $category->products_count }} produk
                                        </span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="recy-admin-action-wrap">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="recy-admin-table-btn recy-admin-btn-edit">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 20h9" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" />
                                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                                </svg>
                                                <span>Edit</span>
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" data-confirm-title="Hapus Kategori?"
                                                data-confirm-message="Kategori hanya bisa dihapus jika belum memiliki produk.">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="recy-admin-table-btn recy-admin-btn-delete">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M3 6h18" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" />
                                                        <path d="M8 6V4h8v2" stroke="currentColor" stroke-width="2"
                                                            stroke-linejoin="round" />
                                                        <path d="M19 6l-1 14H6L5 6" stroke="currentColor" stroke-width="2"
                                                            stroke-linejoin="round" />
                                                        <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="recy-admin-empty">
                                            <div class="recy-animated-icon mx-auto mb-3">
                                                <span class="recy-icon-recycle">♻</span>
                                            </div>

                                            <h5 class="fw-bold">Kategori belum ada</h5>

                                            <p class="text-muted mb-0">
                                                Tambahkan kategori pertama untuk produk Recyclick.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>