@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    try {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        $jumlahMalam = max(1, $checkOutDate->diffInDays($checkInDate));
    } catch (Exception $e) {
        $jumlahMalam = 1; // fallback default
    }

    $hargaPerMalam = $kamar->harga;
    $subtotal = $hargaPerMalam * $jumlahMalam;
    $jumlahKamar = old('jumlah_kamar', 1);
    $totalHarga = $subtotal * $jumlahKamar;
    $totalTamu = ($dewasa ?? 0) + ($anak ?? 0);
@endphp

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h2 class="mb-0">Data Pemesanan</h2>
                    <p class="text-muted mb-0">Fill in all the info correctly to make sure you get the booking confirmation email.</p>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle fa-lg me-3"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Perhatian!</h6>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('pelanggan.pemesanan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5 class="mb-3">Title</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">First name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Last name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Contact Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">Find Message</h5>
                            <div class="d-flex align-items-center bg-light p-3 rounded-2">
                                <i class="fas fa-globe me-3 text-primary"></i>
                                <div>
                                    <p class="mb-0 fw-bold">mobileblog.pwit.com</p>
                                    <p class="mb-0 text-muted">(802-3456-7950)</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">Who are you ordering for (optional)</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="order_for" id="order_for_me" value="me">
                                <label class="form-check-label" for="order_for_me">
                                    The email is posted
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="order_for" id="order_for_someone" value="someone">
                                <label class="form-check-label" for="order_for_someone">
                                    Your mailing list removes this
                                </label>
                            </div>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">Special requests (optional)</h5>
                            <p class="text-muted mb-3">Special requests are not guaranteed, but the property will try to meet your needs. Additional charges may apply.</p>
                            <textarea class="form-control" name="special_requests" rows="3" placeholder="Please write your requests in English or Bahasa Indonesia"></textarea>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">Invoice Details</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Room Rate (per night)</td>
                                            <td class="text-end">Rp {{ number_format($hargaPerMalam, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Duration</td>
                                            <td class="text-end">{{ $jumlahMalam }} night(s)</td>
                                        </tr>
                                        <tr>
                                            <td>Room Subtotal</td>
                                            <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Number of Rooms</td>
                                            <td class="text-end">{{ $jumlahKamar }}</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="fw-bold">Total Payment</td>
                                            <td class="text-end fw-bold">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">Your Booking Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-2 mb-3">
                                        <h6 class="fw-bold">Check-in</h6>
                                        <p class="mb-0">{{ $checkIn }}</p>
                                        <p class="mb-0 text-muted">After 13:00</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-2 mb-3">
                                        <h6 class="fw-bold">Check-out</h6>
                                        <p class="mb-0">{{ $checkOut }}</p>
                                        <p class="mb-0 text-muted">Before 12:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> Stay duration: {{ $jumlahMalam }} night(s)
                            </div>
                        </div>

                        <div class="mb-4 border-top pt-4">
                            <h5 class="mb-3">You choose</h5>
                            <p class="fw-bold">{{ $jumlahKamar }} rooms for {{ $totalTamu }} guests ({{ $dewasa ?? 0 }} adults, {{ $anak ?? 0 }} children)</p>
                            <a href="#" class="text-primary">Change your options</a>
                        </div>

                        <input type="hidden" name="kamar_id" value="{{ $kamar->kamar_id ?? '' }}">
                        <input type="hidden" name="tgl_check_in" value="{{ old('tgl_check_in', $checkIn) }}">
                        <input type="hidden" name="tgl_check_out" value="{{ old('tgl_check_out', $checkOut) }}">
                        <input type="hidden" name="jumlah_kamar" value="{{ $jumlahKamar }}">
                        <input type="hidden" name="jumlah_tamu" value="{{ $totalTamu }}">
                        <input type="hidden" name="jumlah_dewasa" value="{{ $dewasa ?? 0 }}">
                        <input type="hidden" name="jumlah_anak" value="{{ $anak ?? 0 }}">

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold">
                            <i class="fas fa-arrow-right me-2"></i>PROCEED TO PAYMENT
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0"><i class="fas fa-home me-2"></i>{{ $homestay->nama_homestay ?? 'Homestay' }}</h4>
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
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                {{ $kamar->jenisKamar->nama_jenis ?? 'Standard' }}
                            </span>
                        </div>
                    </div>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-user-friends text-muted me-2"></i> Capacity: {{ $kamar->kapasitas ?? '-' }} guests</li>
                        @if($kamar->ukuran_kamar)
                            <li class="mb-2"><i class="fas fa-arrows-alt text-muted me-2"></i> Size: {{ $kamar->ukuran_kamar }} m²</li>
                        @endif
                        <li class="mb-2"><i class="fas fa-calendar-day text-muted me-2"></i> Check-in: {{ $checkIn }}</li>
                        <li class="mb-2"><i class="fas fa-calendar-times text-muted me-2"></i> Check-out: {{ $checkOut }}</li>
                        <li class="mb-2"><i class="fas fa-door-closed text-muted me-2"></i> Rooms: {{ $jumlahKamar }}</li>
                        <li class="mb-2"><i class="fas fa-user text-muted me-2"></i> Adults: {{ $dewasa ?? 0 }}</li>
                        <li class="mb-2"><i class="fas fa-child text-muted me-2"></i> Children: {{ $anak ?? 0 }}</li>
                    </ul>
                    
                    <div class="border-top pt-3 mt-3">
                        <h5 class="mb-3">Payment Summary</h5>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Room Rate</td>
                                <td class="text-end">Rp {{ number_format($hargaPerMalam, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Nights</td>
                                <td class="text-end">{{ $jumlahMalam }}</td>
                            </tr>
                            <tr>
                                <td>Room Subtotal</td>
                                <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rooms</td>
                                <td class="text-end">{{ $jumlahKamar }}</td>
                            </tr>
                            <tr class="border-top">
                                <td class="fw-bold">Total Amount</td>
                                <td class="text-end fw-bold">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card { border-radius: 12px; overflow: hidden; }
    .form-control { border-radius: 8px; padding: 10px 15px; }
    .btn-primary { border-radius: 8px; }
    .badge { border-radius: 6px; padding: 5px 10px; font-weight: 500; }
    .alert { border-radius: 8px; }
    .table-borderless td { padding: 0.25rem 0; }
    .table-borderless tr:last-child td { padding-bottom: 0.75rem; }
</style>
@endsection