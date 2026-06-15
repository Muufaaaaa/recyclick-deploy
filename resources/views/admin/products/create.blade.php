<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Add Product
                        </span>

                        <h1 class="fw-bold mb-2">
                            Tambah Produk
                        </h1>

                        <p class="mb-0">
                            Tambahkan produk eco-friendly baru ke katalog Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('admin.products.index') }}" class="recy-admin-back-btn">
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
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="recy-admin-form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control recy-form-control"
                                    value="{{ old('name') }}" placeholder="Contoh: Reusable Tote Bag" required>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Kategori</label>
                                <select name="category_id" class="form-select recy-form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Deskripsi</label>
                                <textarea name="description" class="form-control recy-form-control" rows="5"
                                    placeholder="Jelaskan manfaat dan detail produk..."
                                    required>{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Harga</label>
                                    <input type="number" name="price" class="form-control recy-form-control"
                                        value="{{ old('price') }}" placeholder="35000" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Stok</label>
                                    <input type="number" name="stock" class="form-control recy-form-control"
                                        value="{{ old('stock') }}" placeholder="25" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Eco Points</label>
                                    <input type="number" name="eco_points_reward" class="form-control recy-form-control"
                                        value="{{ old('eco_points_reward', 10) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Badge</label>
                                    <input type="text" name="eco_badge" class="form-control recy-form-control"
                                        placeholder="Eco Choice / Recycled / Plastic Free"
                                        value="{{ old('eco_badge') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Impact</label>
                                    <input type="number" name="eco_impact" class="form-control recy-form-control"
                                        value="{{ old('eco_impact', 1) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="recy-eco-box mb-4">
                                <h5 class="fw-bold text-success mb-2">
                                    Informasi Eco Product
                                </h5>

                                <p class="text-muted small mb-0">
                                    Gunakan badge seperti <strong>Reusable</strong>, <strong>Recycled</strong>,
                                    atau <strong>Plastic Free</strong> agar produk terlihat lebih menarik.
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto Produk</label>

                                <input type="file" name="image" id="productImageInput"
                                    class="form-control recy-form-control" accept="image/*">

                                <div id="productImagePreviewBox" class="recy-image-preview-box d-none">
                                    <div class="recy-image-preview-frame">
                                        <img id="productImagePreview" src="" alt="Preview Foto Produk">
                                    </div>

                                    <button type="button" id="removeProductImageBtn" class="recy-remove-image-btn">
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
                                        <span>Hapus Foto</span>
                                    </button>

                                    <div class="recy-image-preview-note">
                                        Foto ini baru preview. Foto akan tersimpan setelah produk dibuat.
                                    </div>
                                </div>
                            </div>

                            <div class="recy-admin-detail-card">
                                <h6 class="fw-bold mb-3">Preview Status</h6>

                                <div class="recy-admin-info-row">
                                    <span>Status</span>
                                    <strong class="text-success">Produk Baru</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Upload Gambar</span>
                                    <strong>Opsional</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Tampil di Katalog</span>
                                    <strong>Ya</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 flex-wrap">
                        <button class="recy-btn-primary">
                            Simpan Produk
                        </button>

                        <a href="{{ route('admin.products.index') }}" class="recy-btn-outline text-decoration-none">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('productImageInput');
            const previewBox = document.getElementById('productImagePreviewBox');
            const preview = document.getElementById('productImagePreview');
            const removeBtn = document.getElementById('removeProductImageBtn');

            if (!input || !previewBox || !preview || !removeBtn) return;

            input.addEventListener('change', function () {
                const file = input.files[0];

                if (!file) {
                    previewBox.classList.add('d-none');
                    preview.src = '';
                    return;
                }

                preview.src = URL.createObjectURL(file);
                previewBox.classList.remove('d-none');
            });

            removeBtn.addEventListener('click', function () {
                input.value = '';
                preview.src = '';
                previewBox.classList.add('d-none');
            });
        });
    </script>
</x-app-layout>