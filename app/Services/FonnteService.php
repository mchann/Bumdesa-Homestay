<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Kirim pesan WhatsApp via Fonnte API.
     */
    public function sendMessage(string $target, string $message): void
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62', // Indonesia
        ]);

        // Logging request dan response
        Log::info('Fonnte Request', [
            'target' => $target,
            'message' => $message,
        ]);

        if ($response->successful()) {
            Log::info('Fonnte Response Success', $response->json());
        } else {
            Log::error('Fonnte Response Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        }
    }
}
