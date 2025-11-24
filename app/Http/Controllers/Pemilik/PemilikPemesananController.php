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
     * Ambil homestay milik pemilik login
     */
    private function getHomestay(): Homestay
    {
        $user = Auth::user();
        $profile = PemilikProfile::where('user_id', $user->id)->firstOrFail();

        return Homestay::where('pemilik_id', $profile->pemilik_id)->firstOrFail();
    }

    /**
     * Display a listing of the reservations.
     */
    public function index(Request $request)
    {
        $homestay = $this->getHomestay();
        $status = $request->input('status', 'semua');

        // Build the base query
        $query = Pemesanan::where('homestay_id', $homestay->homestay_id)
            ->with(['pelanggan', 'kamar.homestay'])
            ->latest();

        // Apply status filter if not 'semua'
        if ($status !== 'semua') {
            $query->where('status', $this->mapStatusFilter($status));
        }

        // Clone query for statistics before pagination
        $pemesanansForStats = (clone $query)->get();

        // Statistik total
        $totalPemesanan = $pemesanansForStats->count();
        $totalPemesananBerhasil = $pemesanansForStats->where('status', 'berhasil')->count();
        $totalPendapatan = $pemesanansForStats->where('status', 'berhasil')->sum('total_harga');

        // Paginate results
        $pemesanans = $query->paginate(self::ITEMS_PER_PAGE)
            ->appends(['status' => $status]);

        return view('pemilik.pemesanan.index', compact(
            'pemesanans',
            'status',
            'totalPemesanan',
            'totalPemesananBerhasil',
            'totalPendapatan'
        ));
    }

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $homestay = $this->getHomestay();

        $pemesanan = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->where('homestay_id', $homestay->homestay_id)
            ->findOrFail($id);

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

        $homestay = $this->getHomestay();

        $pemesanan = Pemesanan::where('homestay_id', $homestay->homestay_id)
            ->findOrFail($id);

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
}