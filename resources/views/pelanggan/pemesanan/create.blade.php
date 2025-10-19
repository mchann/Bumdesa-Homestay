@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    try {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        $jumlahMalam = max(1, $checkOutDate->diffInDays($checkInDate));
    } catch (Exception $e) {
        $jumlahMalam = 1;
    }

    $hargaPerMalam = $kamar->harga;
    $subtotal = $hargaPerMalam * $jumlahMalam;
    $jumlahKamar = old('jumlah_kamar', 1);
    $biayaSistem = 4500; // Biaya sistem yang ditambahkan
    $totalHarga = ($subtotal * $jumlahKamar) + $biayaSistem;
    $totalTamu = ($dewasa ?? 0) + ($anak ?? 0);
@endphp

<div class="container py-5">
    <div class="row g-4">
        <!-- Left Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-4">
                    <h3 class="fw-bold text-success mb-1">Data Pemesanan</h3>
                    <p class="text-muted mb-0">Isi data dengan benar agar pemesanan Anda dapat diproses.</p>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex rounded-3 mb-4">
                            <i class="fas fa-exclamation-circle fa-lg me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Perhatian!</h6>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.pemesanan.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Identitas Pemesan</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    {{-- PERBAIKAN: Prioritas ambil dari pelangganProfile->nama_lengkap, fallback ke user->name --}}
                                    <input type="text" class="form-control" 
                                           name="full_name" 
                                           value="{{ old('full_name', auth()->user()->pelangganProfile?->nama_lengkap ?? auth()->user()->name ?? '') }}" 
                                           required>
                                    {{-- Opsional: Tambah hint jika profile belum lengkap --}}
                                    @if(!auth()->user()->pelangganProfile)
                                        <small class="text-muted">Lengkapi profil Anda di <a href="{{ route('pelanggan.profile.edit') }}">halaman profil</a> untuk auto-fill.</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Kontak</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone', auth()->user()->pelangganProfile?->nomor_telepon ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Permintaan Khusus</h5>
                            <p class="text-muted small mb-2">Tidak dijamin, namun pihak homestay akan berusaha memenuhinya. Maksimal 1000 karakter.</p>
                            <textarea class="form-control" 
                                    name="special_requests" 
                                    rows="3" 
                                    placeholder="Contoh: Kamar bebas rokok, dekat kolam renang, atau permintaan sarapan khusus." 
                                    maxlength="1000"  
                                    >{{ old('special_requests') }}</textarea>
                            <small class="text-muted">Opsional – Tulis permintaan Anda.</small>
                        </div>

                        <!-- Invoice -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Rincian Pembayaran</h5>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr><td>Harga Kamar / Malam</td><td class="text-end">Rp {{ number_format($hargaPerMalam, 0, ',', '.') }}</td></tr>
                                    <tr><td>Durasi</td><td class="text-end">{{ $jumlahMalam }} malam</td></tr>
                                    <tr><td>Subtotal</td><td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td></tr>
                                    <tr><td>Jumlah Kamar</td><td class="text-end">{{ $jumlahKamar }}</td></tr>
                                    <tr><td>Biaya Sistem</td><td class="text-end">Rp {{ number_format($biayaSistem, 0, ',', '.') }}</td></tr>
                                    <tr class="border-top fw-bold">
                                        <td>Total</td>
                                        <td class="text-end text-success">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Checkin & Checkout -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Detail Menginap</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-3">
                                        <h6 class="fw-bold mb-1">Check-in</h6>
                                        <p class="mb-0">{{ $checkIn }}</p>
                                        <small class="text-muted">Setelah 13:00</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-3">
                                        <h6 class="fw-bold mb-1">Check-out</h6>
                                        <p class="mb-0">{{ $checkOut }}</p>
                                        <small class="text-muted">Sebelum 12:00</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="kamar_id" value="{{ $kamar->kamar_id ?? '' }}">
                        <input type="hidden" name="tgl_check_in" value="{{ old('tgl_check_in', $checkIn) }}">
                        <input type="hidden" name="tgl_check_out" value="{{ old('tgl_check_out', $checkOut) }}">
                        <input type="hidden" name="jumlah_kamar" value="{{ $jumlahKamar }}">
                        <input type="hidden" name="jumlah_tamu" value="{{ $totalTamu }}">
                        <input type="hidden" name="jumlah_dewasa" value="{{ $dewasa ?? 0 }}">
                        <input type="hidden" name="jumlah_anak" value="{{ $anak ?? 0 }}">

                        <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold">
                            <i class="fas fa-check-circle me-2"></i>LANJUTKAN PEMBAYARAN
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="col-lg-4">
            <div class="card border-0 shadow rounded-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 py-4">
                    <h4 class="fw-bold mb-1 text-success"><i class="fas fa-home me-2"></i>{{ $homestay->nama_homestay ?? 'Homestay' }}</h4>
                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> {{ $homestay->alamat_homestay ?? '-' }}</p>
                </div>
                @if ($kamar)
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            @if($kamar->foto_kamar)
                                <img src="{{ asset('storage/'.$kamar->foto_kamar) }}" class="rounded-3" style="width: 100px; height: 75px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 75px;">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $kamar->nama_kamar ?? '-' }}</h5>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                {{ $kamar->jenisKamar->nama_jenis ?? 'Standard' }}
                            </span>
                        </div>
                    </div>
                    
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-user-friends text-muted me-2"></i> Kapasitas: {{ $kamar->kapasitas ?? '-' }} tamu</li>
                        @if($kamar->ukuran_kamar)
                            <li class="mb-2"><i class="fas fa-arrows-alt text-muted me-2"></i> Ukuran: {{ $kamar->ukuran_kamar }} m²</li>
                        @endif
                        <li class="mb-2"><i class="fas fa-calendar-day text-muted me-2"></i> Check-in: {{ $checkIn }}</li>
                        <li class="mb-2"><i class="fas fa-calendar-times text-muted me-2"></i> Check-out: {{ $checkOut }}</li>
                        <li class="mb-2"><i class="fas fa-door-closed text-muted me-2"></i> Kamar: {{ $jumlahKamar }}</li>
                        <li class="mb-2"><i class="fas fa-user text-muted me-2"></i> Dewasa: {{ $dewasa ?? 0 }}</li>
                        <li class="mb-2"><i class="fas fa-child text-muted me-2"></i> Anak: {{ $anak ?? 0 }}</li>
                    </ul>
                    
                    <div class="border-top pt-3 mt-3">
                        <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>
                        <table class="table table-sm table-borderless">
                            <tr><td>Harga Kamar</td><td class="text-end">Rp {{ number_format($hargaPerMalam, 0, ',', '.') }}</td></tr>
                            <tr><td>Malam</td><td class="text-end">{{ $jumlahMalam }}</td></tr>
                            <tr><td>Subtotal</td><td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td></tr>
                            <tr><td>Kamar</td><td class="text-end">{{ $jumlahKamar }}</td></tr>
                            <tr><td>Biaya Sistem</td><td class="text-end">Rp {{ number_format($biayaSistem, 0, ',', '.') }}</td></tr>
                            <tr class="border-top fw-bold">
                                <td>Total</td>
                                <td class="text-end text-success">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<style>
    .card { border-radius: 1rem; }
    .form-control { border-radius: 0.6rem; padding: 12px 14px; }
    .btn-success { background-color: #25D366; border: none; border-radius: 0.6rem; }
    .btn-success:hover { background-color: #1DA955; }
    .badge { font-size: 0.75rem; padding: 6px 10px; }
    .alert { border-radius: 0.8rem; }
</style>
@endsection