<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisKamarRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        // Pastikan pengguna memiliki izin (misalnya, role 'admin')
        return true; 
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan.
     */
    public function rules(): array
    {
        return [
            'nama_jenis' => [
                'required',
                'string',
                'max:100',
                // 🛡️ Rule REGEX untuk mencegah karakter berbahaya (XSS, SQLI)
                // Hanya izinkan huruf, angka, spasi, dan tanda baca dasar yang aman (.,-()/).
                'regex:/^[a-zA-Z0-9\s\.\,\-\(\)\/]+$/', 
                'unique:jenis_kamar,nama_jenis',
            ],
        ];
    }

    /**
     * Dapatkan pesan kesalahan yang disesuaikan untuk aturan validasi tertentu.
     */
    public function messages(): array
    {
        return [
            'nama_jenis.required' => 'Nama jenis wajib diisi.', 
            'nama_jenis.unique' => 'Nama jenis sudah digunakan.',
            'nama_jenis.regex' => 'Input mengandung karakter tidak valid.', 
        ];
    }
}
