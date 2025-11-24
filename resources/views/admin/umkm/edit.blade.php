@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold text-primary mb-0"><i class="fas fa-edit me-2"></i>Edit Produk UMKM</h1>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Kiri: Informasi Produk -->
                    <div class="col-lg-8">
                        <div class="p-3 rounded-3 border bg-light">
                            <h5 class="fw-bold mb-3 text-primary">Informasi Produk</h5>

                            <div class="mb-3">
                                <label for="nama_produk" class="form-label fw-semibold">Nama Produk *</label>
                                <input type="text" class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                                       id="nama_produk" name="nama_produk" 
                                       value="{{ old('nama_produk', $umkm->nama_produk) }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi *</label>
                                <textarea class="form-control form-control-lg @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        <div class="form-floating mb-3">
    <input type="text" class="form-control @error('no_telepon_owner') is-invalid @enderror"
           id="no_telepon_owner" name="no_telepon_owner"
           value="{{ old('no_telepon_owner') }}" 
           placeholder="6283114655334" 
           pattern="^62[0-9]{9,12}$"
           title="Format: 62xxxxxxxxxxx (contoh: 6283114655334)"
           required>
    <label for="no_telepon_owner" class="required-label">No. Telepon Owner *</label>
    @error('no_telepon_owner') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">
        Format: 62xxxxxxxxxxx (contoh: 6283114655334). 
        Jika input 08xxx atau +628xxx akan otomatis dikonversi.
    </small>
</div>

                    <!-- Kanan: Gambar Produk -->
                    <div class="col-lg-4">
                        <div class="p-3 rounded-3 border bg-light">
                            <h5 class="fw-bold mb-3 text-primary">Gambar Produk</h5>

                            @if($umkm->gambar)
                                <div class="mb-3 text-center">
                                    <img id="preview-gambar" 
                                         src="{{ asset('storage/' . $umkm->gambar) }}" 
                                         alt="{{ $umkm->nama_produk }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="height: 220px; object-fit: cover;">
                                </div>
                            @else
                                <div class="mb-3 text-center">
                                    <img id="preview-gambar" 
                                         src="https://via.placeholder.com/300x200?text=Preview+Gambar" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="height: 220px; object-fit: cover;">
                                </div>
                            @endif

                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted d-block mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Bagian Harga dan Detail -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-semibold">Harga (Rp) *</label>
                        <input type="number" class="form-control form-control-lg @error('harga') is-invalid @enderror"
                               id="harga" name="harga" min="0"
                               value="{{ old('harga', $umkm->harga) }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="kategori" class="form-label fw-semibold">Kategori *</label>
                        <select class="form-select form-select-lg @error('kategori') is-invalid @enderror" 
                                id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('kategori', $umkm->kategori) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="stok" class="form-label fw-semibold">Stok *</label>
                        <input type="number" class="form-control form-control-lg @error('stok') is-invalid @enderror"
                               id="stok" name="stok" min="0"
                               value="{{ old('stok', $umkm->stok) }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-4 mt-3">
                    <div class="col-md-3">
                        <label for="berat" class="form-label fw-semibold">Berat *</label>
                        <input type="number" class="form-control form-control-lg @error('berat') is-invalid @enderror"
                               id="berat" name="berat" min="0" step="0.01"
                               value="{{ old('berat', $umkm->berat) }}" required>
                        @error('berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="satuan_berat" class="form-label fw-semibold">Satuan Berat *</label>
                        <select class="form-select form-select-lg @error('satuan_berat') is-invalid @enderror" 
                                id="satuan_berat" name="satuan_berat" required>
                            <option value="gr" {{ old('satuan_berat', $umkm->satuan_berat) == 'gr' ? 'selected' : '' }}>Gram</option>
                            <option value="kg" {{ old('satuan_berat', $umkm->satuan_berat) == 'kg' ? 'selected' : '' }}>Kilogram</option>
                            <option value="ml" {{ old('satuan_berat', $umkm->satuan_berat) == 'ml' ? 'selected' : '' }}>Mililiter</option>
                        </select>
                        @error('satuan_berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="badge" class="form-label fw-semibold">Badge</label>
                        <select class="form-select form-select-lg" id="badge" name="badge">
                            <option value="">Tidak ada badge</option>
                            <option value="Terlaris" {{ old('badge', $umkm->badge) == 'Terlaris' ? 'selected' : '' }}>Terlaris</option>
                            <option value="Baru" {{ old('badge', $umkm->badge) == 'Baru' ? 'selected' : '' }}>Baru</option>
                            <option value="Diskon" {{ old('badge', $umkm->badge) == 'Diskon' ? 'selected' : '' }}>Diskon</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label fw-semibold">Status *</label>
                        <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status', $umkm->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $umkm->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="tags" class="form-label fw-semibold">Tags (pisahkan dengan koma)</label>
                    <input type="text" class="form-control form-control-lg" id="tags" name="tags"
                           value="{{ old('tags', $umkm->tags ? implode(', ', $umkm->tags) : '') }}"
                           placeholder="Contoh: kopi, banyuwangi, lokal">
                </div>

                <!-- Tombol Aksi -->
                <div class="text-end mt-5">
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i>Update Produk
                    </button>
                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Gambar Script -->
<script>
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview-gambar');
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => preview.src = event.target.result;
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
