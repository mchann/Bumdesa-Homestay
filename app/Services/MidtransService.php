<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

 public function createVTWebTransaction($pemesanan, $pelanggan)
{
    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $pemesanan->pemesanan_id,
            'gross_amount' => (int) $pemesanan->total_harga,
        ],
        'customer_details' => [
            'first_name' => $pelanggan->name,
            'email' => $pelanggan->email,
        ],
        'item_details' => [
            [
                'id' => $pemesanan->pemesanan_id,
                'price' => (int) $pemesanan->total_harga,
                'quantity' => 1,
                'name' => 'Booking Homestay',
            ],
        ]
    ];

    $transaction = \Midtrans\Snap::createTransaction($params);

    return $transaction->redirect_url;
}


}
