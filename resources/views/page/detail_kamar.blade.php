@extends('layout.main')

@section('content')
<div class="bg-light py-5">
    <div class="container bg-white shadow rounded p-4">

        {{-- Galeri Foto Kamar --}}
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="mb-2">
                    <img src="{{ asset('storage/' . ($kamar->foto_kamar ?? $homestay->foto_homestay)) }}"
                         class="w-100 rounded" style="height: 400px; object-fit: cover;">
                </div>
                <div class="d-flex gap-2 overflow-auto pb-2">
                    <img src="{{ asset('storage/' . $homestay->foto_homestay) }}"
                         class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                    @foreach($homestay->kamar->take(4) as $kamar)
                        @if($kamar->foto_kamar)
                            <img src="{{ asset('storage/' . $kamar->foto_kamar) }}"
                                 class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Info Kamar --}}
            <div class="col-md-4">
                <h3 class="fw-bold">{{ $kamar->nama_kamar }}</h3>
                <div class="text-muted small mb-2">
                    <p>{{ $kamar->deskripsi ?? 'Deskripsi belum tersedia.' }}</p>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-medium">Tempat Tidur</td>
                            <td>{{ $kamar->tipe_tempat_tidur ?? 'Double Bed' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Kapasitas</td>
                            <td>{{ $kamar->kapasitas ?? 2 }} Tamu</td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Harga</td>
                            <td>
                                @if($kamar->harga)
                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                    <div class="text-muted small">Di luar pajak & biaya</div>
                                @else
                                    Harga tidak tersedia
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <a href="#" class="btn btn-primary w-100 mt-3">Pilih Kamar</a>
            </div>
        </div>

        {{-- Fasilitas --}}
        <h5 class="fw-semibold">Fasilitas Kamar</h5>
        <ul class="list-unstyled">
            @foreach($kamar->fasilitas as $fasilitas)
                <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $fasilitas->nama_fasilitas }}</li>
            @endforeach
        </ul>

    </div>
</div>
@endsection
