@extends('layouts.app')

@section('title', 'Simulasi Pembayaran')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">Pembayaran Virtual Account</h3>

        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('img/bca.png') }}" alt="Logo BCA" height="40" class="me-3">
            <h5 class="mb-0">Bank Central Asia (BCA)</h5>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nomor Virtual Account</label>
            <div class="input-group">
                <input type="text" class="form-control bg-light" id="vaNumber" value="123456789012" readonly>
                <button class="btn btn-outline-secondary" type="button" onclick="copyVA()">Copy</button>
            </div>
        </div>

        <!-- Rincian Biaya -->
        <div class="mb-4">
            <strong>Rincian Biaya:</strong>
            <div class="mt-2 p-3 bg-light rounded">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal Kamar:</span>
                    <span>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>
                        Biaya Layanan Sistem
                        <br>
                        <small class="text-muted">Pemeliharaan platform</small>
                    </span>
                    <span>Rp 4.500</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span class="text-success">Total Pembayaran:</span>
                    <span class="text-success">Rp {{ number_format($pemesanan->total_harga + 4500, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <hr>

        <h5 class="fw-bold">Cara Membayar:</h5>
        <ol class="mb-4">
            <li>Buka aplikasi m-Banking BCA atau kunjungi ATM BCA.</li>
            <li>Pilih menu <strong>Transfer > Virtual Account</strong>.</li>
            <li>Masukkan nomor VA: <code>123456789012</code></li>
            <li>Pastikan jumlah nominal: <strong class="text-success">Rp {{ number_format($pemesanan->total_harga + 4500, 0, ',', '.') }}</strong></li>
            <li>Konfirmasi dan selesaikan transaksi.</li>
        </ol>

        <div class="text-center mt-4">
            <p class="text-white"> <span id="countdown"></span> </p>
        </div>
    </div>
</div>

<script>
function copyVA() {
    const vaInput = document.getElementById('vaNumber');
    vaInput.select();
    vaInput.setSelectionRange(0, 99999); // Untuk mobile
    document.execCommand("copy");
    alert("Nomor VA berhasil disalin: " + vaInput.value);
}

let seconds = 20;
const countdownEl = document.getElementById('countdown');

const timer = setInterval(() => {
    seconds--;
    countdownEl.textContent = seconds;

    if (seconds <= 0) {
        clearInterval(timer);
        window.location.href = "{{ route('pemesanan.success', ['id' => $pemesanan->pemesanan_id]) }}";
    }
}, 1000);
</script>
@endsection