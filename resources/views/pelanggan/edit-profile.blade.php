@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body text-center p-4">
                    <div class="avatar-wrapper mx-auto mb-3 position-relative">
                        <div class="avatar bg-gradient-primary text-white d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; border-radius: 50%; font-size: 36px; box-shadow: 0 4px 20px rgba(78, 115, 223, 0.3);">
                            {{ strtoupper(substr(optional($profile)->nama_lengkap ?? Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ optional($profile)->nama_lengkap ?? Auth::user()->name ?? 'Nama Pengguna' }}</h5>
                    <p class="text-muted small mb-4">Pelanggan</p>

                    <div class="list-group list-group-flush rounded-lg">
                        <a href="{{ route('pelanggan.profile') }}" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-user me-3 text-primary"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="{{ route('pelanggan.profile.edit') }}" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center active">
                            <i class="fas fa-edit me-3 text-primary"></i>
                            <span>Edit Profil</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-lock me-3 text-info"></i>
                            <span>Keamanan</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4">Akun Terhubung</h6>
                    <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle me-3 shadow-sm">
                                <i class="fab fa-google text-danger"></i>
                            </div>
                            <span>Google</span>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">Terhubung</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-user-edit me-2 text-primary"></i>Edit Profil
                    </h4>
                    <a href="{{ route('pelanggan.profile') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Terdapat kesalahan dalam pengisian form:
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pelanggan.profile.update') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control bg-light" 
                                           value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <small class="text-muted">Email tidak dapat diubah</small>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" name="nama_lengkap" 
                                           class="form-control @error('nama_lengkap') is-invalid @enderror"
                                           value="{{ old('nama_lengkap', optional($profile)->nama_lengkap ?? Auth::user()->name) }}" 
                                           required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-phone text-muted"></i>
                                    </span>
                                    <input type="text" name="nomor_telepon" 
                                           class="form-control @error('nomor_telepon') is-invalid @enderror"
                                           value="{{ old('nomor_telepon', optional($profile)->nomor_telepon) }}" 
                                           required pattern="[0-9]+" title="Hanya angka">
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kewarganegaraan -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kewarganegaraan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-globe text-muted"></i>
                                    </span>
                                    <input type="text" name="kewarganegaraan" 
                                           class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                           value="{{ old('kewarganegaraan', optional($profile)->kewarganegaraan) }}" 
                                           required>
                                    @error('kewarganegaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-venus-mars text-muted"></i>
                                    </span>
                                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Male" {{ old('jenis_kelamin', optional($profile)->jenis_kelamin) === 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Female" {{ old('jenis_kelamin', optional($profile)->jenis_kelamin) === 'Female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-calendar-day text-muted"></i>
                                    </span>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" 
                                           class="form-control @error('tgl_lahir') is-invalid @enderror"
                                           value="{{ old('tgl_lahir', optional($profile)->tgl_lahir) }}" 
                                           required max="{{ date('Y-m-d') }}" min="1900-01-01">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!-- Custom error untuk umur < 17 tahun (client-side) -->
                                    <div id="umur-error" class="invalid-feedback d-none">
                                        Umur minimal 17 tahun.
                                    </div>
                                </div>
                                <small class="text-muted">Minimal umur 17 tahun</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8fafc;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    .list-group-item {
        transition: all 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .list-group-item.active {
        background-color: rgba(78, 115, 223, 0.1);
        border-left: 3px solid #4e73df;
        color: #4a4a4a;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }
    .input-group-text {
        min-width: 45px;
        justify-content: center;
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #3a5ec4;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
    }
    .alert {
        border-radius: 8px;
    }
    .avatar {
        transition: all 0.3s ease;
    }
    .avatar:hover {
        transform: scale(1.05);
    }
</style>

<script>
// Client-side validation (Bootstrap + custom umur)
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                // Cek validasi umur sebelum submit
                if (!validateUmur()) {
                    event.preventDefault();
                    event.stopPropagation();
                    return false;
                }
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Fungsi validasi umur minimal 17 tahun
function validateUmur() {
    const tglLahirInput = document.getElementById('tgl_lahir');
    const umurError = document.getElementById('umur-error');
    if (!tglLahirInput || !tglLahirInput.value) {
        // Jika kosong, biarkan server-side handle (required sudah ada)
        return true;
    }

    const today = new Date();
    const birthDate = new Date(tglLahirInput.value);
    const minUmur = 17;
    const minBirthDate = new Date(today.getFullYear() - minUmur, today.getMonth(), today.getDate());

    // Hitung umur akurat
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (age < minUmur || birthDate > minBirthDate) {
        tglLahirInput.classList.add('is-invalid');
        umurError.classList.remove('d-none');
        return false;
    } else {
        tglLahirInput.classList.remove('is-invalid');
        umurError.classList.add('d-none');
        return true;
    }
}

// Event listener untuk real-time validation tanggal lahir
document.addEventListener('DOMContentLoaded', function() {
    const tglLahirInput = document.getElementById('tgl_lahir');
    if (tglLahirInput) {
        tglLahirInput.addEventListener('change', validateUmur);
        tglLahirInput.addEventListener('blur', validateUmur);
        // Set max date ke hari ini
        tglLahirInput.max = new Date().toISOString().split('T')[0];
    }
});
</script>
@endsection