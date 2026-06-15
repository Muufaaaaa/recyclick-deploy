<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Product Management
                        </span>

                        <h1 class="fw-bold mb-2">
                            Kelola Produk
                        </h1>

                        <p class="mb-0">
                            Tambah, edit, hapus, dan pantau produk ramah lingkungan Recyclick.
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

                        <a href="{{ route('admin.products.create') }}"
                            class="recy-admin-top-btn recy-admin-btn-primary">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <span>Tambah Produk</span>
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="recy-admin-card">
                <div class="table-responsive">
                    <table class="table recy-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Badge</th>
                                <th>Eco Points</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="recy-admin-product-img"
                                                alt="{{ $product->name }}">
                                        @else
                                            <div
                                                class="recy-admin-product-img d-flex align-items-center justify-content-center text-muted small">
                                                -
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <div class="recy-admin-meta">
                                            {{ \Illuminate\Support\Str::limit($product->description, 45) }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $product->category->name }}
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td>
                                        @if ($product->stock <= 0)
                                            <span class="badge bg-danger rounded-pill">Habis</span>
                                        @elseif ($product->stock <= 5)
                                            <span class="badge bg-warning text-dark rounded-pill">
                                                {{ $product->stock }} tersisa
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill">
                                                {{ $product->stock }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($product->eco_badge)
                                            <span class="recy-badge">
                                                {{ $product->eco_badge }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            +{{ $product->eco_points_reward }}
                                        </strong>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="recy-admin-table-btn recy-admin-btn-edit">
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 20h9" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" />
                                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                                </svg>
                                                <span>Edit</span>
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                class="m-0">
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
                                    <td colspan="8">
                                        <div class="recy-admin-empty">
                                            <div class="recy-animated-icon mx-auto mb-3">
                                                <span class="recy-icon-cart">🛒</span>
                                            </div>

                                            <h5 class="fw-bold">Produk belum ada</h5>
                                            <p class="text-muted mb-0">
                                                Tambahkan produk pertama Recyclick dari tombol Tambah Produk.
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