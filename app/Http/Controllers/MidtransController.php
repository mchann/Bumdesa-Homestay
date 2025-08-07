<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Midtrans\Snap;

class MidtransController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }
public function bayar($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    
    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $pemesanan->id,
            'gross_amount' => $pemesanan->total_harga,
        ],
        'customer_details' => [
            'first_name' => $pemesanan->pelanggan->name,
            'email' => $pemesanan->pelanggan->email,
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('midtrans.bayar', compact('snapToken', 'pemesanan'));
}
}
