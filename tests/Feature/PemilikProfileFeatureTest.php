<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PemilikProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth; // ⬅ Tambahkan ini

class PemilikProfileFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'pemilik@test.com',
            'password' => bcrypt('password123'),
            'role' => 'pemilik',
        ]);

        $this->actingAs($this->user);
    }

    /** 1️⃣ Tampilan Awal & Mode Edit */
    public function test_tampilan_awal_dan_mode_edit()
    {
        PemilikProfile::create([
            'user_id' => $this->user->id,
            'nama_lengkap' => 'Irfan Maulana',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Bandung',
        ]);

        $response = $this->get(route('pemilik.profile.show'));
        $response->assertStatus(200);
        $response->assertSee('Irfan Maulana');
        $response->assertSee('Edit Profil');
    }

    /** 2️⃣ Transisi ke Mode Edit */
    public function test_transisi_ke_mode_edit()
    {
        PemilikProfile::create([
            'user_id' => $this->user->id,
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Bandung',
        ]);

        $response = $this->get(route('pemilik.profile.edit'));
        $response->assertStatus(200);
        $response->assertSee('Simpan Perubahan');
    }

    /** 3️⃣ Simpan Seluruh Field Valid */
    public function test_simpan_seluruh_field_valid()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan Maulana',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Merdeka Bandung',
        ]);

        $response->assertRedirect(route('pemilik.profile.show'));
        $this->assertDatabaseHas('pemilik_profiles', [
            'user_id' => $this->user->id,
            'nama_lengkap' => 'Irfan Maulana',
        ]);
    }

    /** 4️⃣ Simpan Hanya Nama Lengkap */
    public function test_simpan_hanya_nama_lengkap()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => '',
            'alamat' => '',
        ]);

        $response->assertSessionHasErrors(['nomor_telepon', 'alamat']);
    }

    /** 5️⃣ Simpan Hanya Nomor Telepon */
    public function test_simpan_hanya_nomor_telepon()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => '',
            'nomor_telepon' => '08123456789',
            'alamat' => '',
        ]);

        $response->assertSessionHasErrors(['nama_lengkap', 'alamat']);
    }

    /** 6️⃣ Validasi Nama Lengkap Kosong */
    public function test_validasi_nama_lengkap_kosong()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => '',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Bandung',
        ]);

        $response->assertSessionHasErrors(['nama_lengkap']);
    }

    /** 7️⃣ Validasi Nomor Telepon Kosong */
    public function test_validasi_nomor_telepon_kosong()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => '',
            'alamat' => 'Bandung',
        ]);

        $response->assertSessionHasErrors(['nomor_telepon']);
    }

    /** 8️⃣ Validasi Nomor Telepon Non-Angka */
    public function test_validasi_nomor_telepon_non_angka()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => 'ABC123',
            'alamat' => 'Bandung',
        ]);

        $response->assertSessionHasErrors(['nomor_telepon']);
    }

    /** 9️⃣ Validasi Nomor Telepon Terlalu Pendek */
    public function test_validasi_nomor_telepon_terlalu_pendek()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => '0812',
            'alamat' => 'Bandung',
        ]);

        $response->assertSessionHasErrors(['nomor_telepon']);
    }

    /** 🔟 Validasi Nama Melebihi Batas Maks. */
    public function test_validasi_nama_melebihi_batas_maks()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => str_repeat('A', 300),
            'nomor_telepon' => '08123456789',
            'alamat' => 'Bandung',
        ]);

        $response->assertSessionHasErrors(['nama_lengkap']);
    }

    /** 1️⃣1️⃣ Validasi Alamat Melebihi Batas Maks. */
    public function test_validasi_alamat_melebihi_batas_maks()
    {
        $response = $this->post(route('pemilik.profile.store'), [
            'nama_lengkap' => 'Irfan',
            'nomor_telepon' => '08123456789',
            'alamat' => str_repeat('B', 300),
        ]);

        $response->assertSessionHasErrors(['alamat']);
    }

    /** 1️⃣2️⃣ Login dengan Field Kosong */
    public function test_login_dengan_field_kosong()
    {
        Auth::logout(); // ✅ Ganti auth()->logout()

        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** 1️⃣3️⃣ Login dengan Format Email Salah */
    public function test_login_dengan_format_email_salah()
    {
        Auth::logout(); // ✅ Ganti auth()->logout()

        $response = $this->post(route('login'), [
            'email' => 'salahformat',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** 1️⃣4️⃣ Cek Fungsi "Show/Hide Password" */
    public function test_cek_fungsi_show_hide_password()
    {
        Auth::logout(); // ✅ Ganti auth()->logout()

        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('id="password"', false);
        $response->assertSee('id="togglePassword"', false);
    }

    /** 1️⃣5️⃣ Cek Tautan "Register here" */
    public function test_cek_tautan_register_here()
    {
        Auth::logout(); // ✅ Ganti auth()->logout()

        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('Register here');
        $response->assertSee(route('register'));
    }
}
