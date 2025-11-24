<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PelangganProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilePelangganFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'pelanggan',
        ]);

        $this->actingAs($this->user);
    }

    /** 🧩 1. Menampilkan profil jika sudah ada */
    public function test_user_can_view_existing_profile()
    {
        PelangganProfile::create([
            'user_id' => $this->user->id,
            'nama_lengkap' => 'John Doe',
            'nomor_telepon' => '08123456789',
            'kewarganegaraan' => 'Indonesia',
            'jenis_kelamin' => 'Male',
            'tgl_lahir' => '2000-01-01',
        ]);

        $response = $this->get(route('pelanggan.profile'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.profile');
        $response->assertSee('John Doe');
    }

    /** 🧩 2. Redirect jika profil belum dibuat */
    public function test_redirects_when_profile_not_exists()
    {
        $response = $this->get(route('pelanggan.profile'));

        $response->assertRedirect(route('pelanggan.profile.edit'));
        $response->assertSessionHas('info', 'Silakan lengkapi profil Anda terlebih dahulu.');
    }

    /** 🧩 3. Dapat membuka form edit */
    public function test_user_can_open_edit_form()
    {
        PelangganProfile::create([
            'user_id' => $this->user->id,
            'nama_lengkap' => 'John Doe',
            'nomor_telepon' => '08123456789',
            'kewarganegaraan' => 'Indonesia',
            'jenis_kelamin' => 'Male',
            'tgl_lahir' => '2000-01-01',
        ]);

        $response = $this->get(route('pelanggan.profile.edit'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.edit-profile');
        $response->assertSee('John Doe');
    }

    /** ✅ 4. Berhasil update profil */
    public function test_user_can_update_profile_successfully()
    {
        $response = $this->put(route('pelanggan.profile.update'), [
            'nama_lengkap' => 'Jane Doe',
            'nomor_telepon' => '08123456789',
            'kewarganegaraan' => 'Indonesia',
            'jenis_kelamin' => 'Female',
            'tgl_lahir' => '2000-05-05',
        ]);

        $response->assertRedirect(route('pelanggan.profile'));
        $this->assertDatabaseHas('pelanggan_profiles', [
            'user_id' => $this->user->id,
            'nama_lengkap' => 'Jane Doe',
        ]);
    }

    /** ⚠ 5. Validasi gagal saat umur < 17 tahun */
    public function test_update_fails_when_under_17_years_old()
    {
        $response = $this->put(route('pelanggan.profile.update'), [
            'nama_lengkap' => 'Baby Doe',
            'nomor_telepon' => '08123456789',
            'kewarganegaraan' => 'Indonesia',
            'jenis_kelamin' => 'Male',
            'tgl_lahir' => now()->subYears(10)->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors(['tgl_lahir']);
    }

    /** ❌ 6. Validasi gagal ketika data tidak lengkap */
    public function test_validation_fails_with_empty_fields()
    {
        $response = $this->put(route('pelanggan.profile.update'), [
            'nama_lengkap' => '',
            'nomor_telepon' => '',
            'kewarganegaraan' => '',
            'jenis_kelamin' => '',
            'tgl_lahir' => '',
        ]);

        $response->assertSessionHasErrors([
            'nama_lengkap',
            'nomor_telepon',
            'kewarganegaraan',
            'jenis_kelamin',
            'tgl_lahir',
        ]);
    }
}