<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\PemilikProfile;
use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PemilikPemesananController extends Controller
{
    const ITEMS_PER_PAGE = 10;
    
    // Status mapping for consistent filtering
    const STATUS_MAP = [
        'berhasil' => 'berhasil',
        'menunggu_konfirmasi' => 'menunggu_konfirmasi',
        'dibatalkan' => 'dibatalkan',
        'selesai' => 'selesai'
    ];

    /**
     * Display a listing of the reservations.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->input('status', 'semua');

        // Get owner profile or redirect if not found
        $profile = PemilikProfile::where('user_id', $user->id)->firstOrFail();
        
        // Get homestay or redirect if not found
        $homestay = Homestay::where('pemilik_id', $profile->pemilik_id)->firstOrFail();

        // Build the base query
        $query = Pemesanan::where('homestay_id', $homestay->homestay_id)
            ->with([
                'pelanggan',
                'kamar.homestay' => function($query) use ($profile) {
                    $query->where('pemilik_id', $profile->pemilik_id);
                }
            ])
            ->latest();

        // Apply status filter if not 'semua'
        if ($status !== 'semua') {
            $query->where('status', $this->mapStatusFilter($status));
        }

        // Paginate results
        $pemesanans = $query->paginate(self::ITEMS_PER_PAGE)
            ->appends(['status' => $status]);

        return view('pemilik.pemesanan.index', compact('pemesanans', 'status'));
    }

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $user = Auth::user();
        $profile = PemilikProfile::where('user_id', $user->id)->firstOrFail();

        $pemesanan = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->findOrFail($id);

        // Authorization check
        $this->authorizePemilik($pemesanan, $profile);

        return view('pemilik.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Update the status of the specified reservation.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['berhasil', 'dibatalkan', 'selesai'])
            ]
        ]);

        $user = Auth::user();
        $profile = PemilikProfile::where('user_id', $user->id)->firstOrFail();
        $pemesanan = Pemesanan::findOrFail($id);

        // Authorization check
        $this->authorizePemilik($pemesanan, $profile);

        // Additional validation for status transitions
        $this->validateStatusTransition($pemesanan->status, $validated['status']);

        $pemesanan->update(['status' => $validated['status']]);

        return redirect()->route('pemilik.pemesanan.index')
            ->with('success', 'Status pemesanan berhasil diperbarui');
    }

    /**
     * Map status filter to database value
     */
    protected function mapStatusFilter(string $filter): string
    {
        return self::STATUS_MAP[$filter] ?? $filter;
    }

    /**
     * Validate status transition
     */
    protected function validateStatusTransition(string $currentStatus, string $newStatus): void
    {
        $allowedTransitions = [
            'menunggu_konfirmasi' => ['berhasil', 'dibatalkan'],
            'berhasil' => ['selesai'],
        ];

        if (isset($allowedTransitions[$currentStatus])) {
            if (!in_array($newStatus, $allowedTransitions[$currentStatus])) {
                abort(422, 'Transisi status tidak valid');
            }
        }
    }

    /**
     * Authorization check for owner
     */
    protected function authorizePemilik(Pemesanan $pemesanan, PemilikProfile $profile): void
    {
        if ($pemesanan->kamar->homestay->pemilik_id !== $profile->pemilik_id) {
            abort(403, 'Anda tidak diizinkan mengakses pemesanan ini');
        }
    }
}