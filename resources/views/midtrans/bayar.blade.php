<!DOCTYPE html>
<html>
<head>
    <title>Bayar Homestay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Total yang harus dibayar: Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h2>

    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    // Redirect ke halaman sukses
                },
                onPending: function(result){
                    alert("Menunggu pembayaran...");
                    console.log(result);
                },
                onError: function(result){
                    alert("Pembayaran gagal.");
                    console.log(result);
                },
                onClose: function(){
                    alert('Kamu menutup popup sebelum menyelesaikan pembayaran');
                }
            });
        };
    </script>
</body>
</html>
