<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Edit Product
                        </span>

                        <h1 class="fw-bold mb-2">
                            Edit Produk
                        </h1>

                        <p class="mb-0">
                            Perbarui informasi produk Recyclick.
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
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="recy-admin-form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control recy-form-control"
                                    value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Kategori</label>
                                <select name="category_id" class="form-select recy-form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Deskripsi</label>
                                <textarea name="description" class="form-control recy-form-control" rows="5"
                                    required>{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Harga</label>
                                    <input type="number" name="price" class="form-control recy-form-control"
                                        value="{{ old('price', $product->price) }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Stok</label>
                                    <input type="number" name="stock" class="form-control recy-form-control"
                                        value="{{ old('stock', $product->stock) }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Eco Points</label>
                                    <input type="number" name="eco_points_reward" class="form-control recy-form-control"
                                        value="{{ old('eco_points_reward', $product->eco_points_reward) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Badge</label>
                                    <input type="text" name="eco_badge" class="form-control recy-form-control"
                                        value="{{ old('eco_badge', $product->eco_badge) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Impact</label>
                                    <input type="number" name="eco_impact" class="form-control recy-form-control"
                                        value="{{ old('eco_impact', $product->eco_impact) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-4">
                                <label class="recy-admin-form-label">Gambar Produk</label>

                                <input type="file" name="image" id="productImageInput"
                                    class="form-control recy-form-control" accept="image/*">

                                <input type="hidden" name="remove_image" id="removeImageInput" value="0">

                                <div id="productImagePreviewBox"
                                    class="recy-image-preview-box {{ $product->image ? '' : 'd-none' }}">

                                    <div class="recy-image-preview-frame">
                                        <img id="productImagePreview"
                                            src="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                                            alt="Preview Foto Produk">
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
                                        Klik Hapus Foto lalu simpan perubahan untuk menghapus foto produk.
                                    </div>
                                </div>

                                <small class="text-muted d-block mt-2">
                                    Pilih file baru jika ingin mengganti gambar.
                                </small>
                            </div>

                            <div class="recy-admin-detail-card">
                                <h6 class="fw-bold mb-3">Ringkasan Produk</h6>

                                <div class="recy-admin-info-row">
                                    <span>Slug</span>
                                    <strong>{{ $product->slug }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Stok</span>
                                    <strong>{{ $product->stock }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Eco Points</span>
                                    <strong class="text-success">+{{ $product->eco_points_reward }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Dibuat</span>
                                    <strong>{{ $product->created_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="recy-btn-primary">
                            Update Produk
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
            const removeInput = document.getElementById('removeImageInput');

            if (!input || !previewBox || !preview || !removeBtn || !removeInput) return;

            input.addEventListener('change', function () {
                const file = input.files[0];

                if (!file) {
                    return;
                }

                preview.src = URL.createObjectURL(file);
                previewBox.classList.remove('d-none');
                removeInput.value = '0';
            });

            removeBtn.addEventListener('click', function () {
                input.value = '';
                preview.src = '';
                previewBox.classList.add('d-none');
                removeInput.value = '1';
            });
        });
    </script>
</x-app-layout>