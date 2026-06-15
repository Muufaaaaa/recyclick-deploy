<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Add Category
                        </span>

                        <h1 class="fw-bold mb-2">
                            Tambah Kategori
                        </h1>

                        <p class="mb-0">
                            Buat kategori baru untuk mengelompokkan produk Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('admin.categories.index') }}" class="recy-admin-back-btn">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M12 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="recy-admin-form-card">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="recy-admin-form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control recy-form-control" value="{{ old('name') }}"
                            placeholder="Contoh: Reusable Product" required>
                    </div>

                    <div class="mb-4">
                        <label class="recy-admin-form-label">Deskripsi</label>
                        <textarea name="description" class="form-control recy-form-control" rows="4"
                            placeholder="Deskripsi singkat kategori...">{{ old('description') }}</textarea>
                    </div>

                    <div class="recy-category-tip-box mb-4">
                        <div class="recy-category-tip-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 17v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M12 8h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor"
                                    stroke-width="2" />
                            </svg>
                        </div>

                        <div>
                            <h6 class="fw-bold text-success mb-1">
                                Tips Kategori
                            </h6>

                            <small class="text-muted">
                                Gunakan kategori yang jelas seperti Reusable Product, Recycled Craft,
                                Eco Lifestyle, atau Zero Waste agar katalog lebih mudah dipahami user.
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button class="recy-btn-primary">
                            Simpan Kategori
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="recy-btn-outline text-decoration-none">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>