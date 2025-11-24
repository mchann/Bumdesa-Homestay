<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PemilikProfile;
use App\Models\Homestay;
use App\Models\Peraturan;

class HomestayFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected PemilikProfile $profile;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user pemilik
        $this->user = User::factory()->create(['role' => 'pemilik']);
        $this->profile = PemilikProfile::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->actingAs($this->user);

        Storage::fake('public');
    }

    /** 1️⃣ Input Nama Homestay Valid */
    public function test_input_nama_homestay_valid()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Test',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'deskripsi' => 'Deskripsi homestay',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertRedirect(route('pemilik.homestay.index'));
        $this->assertDatabaseHas('homestays', ['nama_homestay' => 'Homestay Test']);
    }

    /** 2️⃣ Nama Homestay Kosong (Wajib Isi) */
    public function test_nama_homestay_kosong_gagal()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => '',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertSessionHasErrors('nama_homestay');
    }

    /** 3️⃣ Nama Homestay Panjang (>100 Karakter) */
    public function test_nama_homestay_terlalu_panjang()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => str_repeat('a', 101),
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertSessionHasErrors('nama_homestay');
    }

    /** 4️⃣ Nama Homestay Duplikat */
    public function test_nama_homestay_duplikat()
    {
        Homestay::factory()->create([
            'nama_homestay' => 'Homestay Test',
            'pemilik_id' => $this->profile->pemilik_id
        ]);

        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Test',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);

        $response->assertSessionHasErrors('nama_homestay');
    }

    /** 5️⃣ Nama Homestay Berisi Script (XSS Test) */
    public function test_nama_homestay_xss()
    {
        $script = '<script>alert(1)</script>';
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => $script,
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $this->assertDatabaseMissing('homestays', ['nama_homestay' => $script]);
    }

    /** 6️⃣ Foto Homestay Valid */
    public function test_foto_homestay_valid()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Foto',
            'foto_homestay' => UploadedFile::fake()->image('valid.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertRedirect();
        Storage::disk('public')->assertExists('foto_homestay/' . $response->original->foto_homestay ?? '');
    }

    /** 7️⃣ Foto Homestay tidak Valid */
    public function test_foto_homestay_tidak_valid()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Foto',
            'foto_homestay' => UploadedFile::fake()->create('file.pdf', 100),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertSessionHasErrors('foto_homestay');
    }

    /** 8️⃣ Foto Homestay Tidak Diisi */
    public function test_foto_homestay_kosong()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Foto',
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertSessionHasErrors('foto_homestay');
    }

    /** 9️⃣ Deskripsi Kosong */
    public function test_deskripsi_kosong_valid()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Deskripsi',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'deskripsi' => '',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertRedirect();
    }

    /** 10️⃣ Deskripsi terlalu panjang (>1000 karakter) */
    public function test_deskripsi_terlalu_panjang()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Deskripsi',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'deskripsi' => str_repeat('a', 1001),
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertSessionHasErrors('deskripsi');
    }

    /** 11️⃣ Alamat Homestay Valid */
    public function test_alamat_valid()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Alamat',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => 'Bandung',
        ]);
        $response->assertRedirect();
    }

    /** 12️⃣ Alamat Homestay Kosong (wajib) */
    public function test_alamat_kosong()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Alamat',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => '',
        ]);
        $response->assertSessionHasErrors('alamat_homestay');
    }

    /** 13️⃣ Alamat Homestay terlalu panjang (>200) */
    public function test_alamat_terlalu_panjang()
    {
        $response = $this->post(route('pemilik.homestay.store'), [
            'nama_homestay' => 'Homestay Alamat',
            'foto_homestay' => UploadedFile::fake()->image('foto.jpg'),
            'link_google_maps' => 'https://goo.gl/maps/test',
            'alamat_homestay' => str_repeat('a', 201),
        ]);
        $response->assertSessionHasErrors('alamat_homestay');
    }

    /** 14️⃣ Peraturan menginap tidak bisa diubah pemilik */
    public function test_peraturan_tidak_bisa_diubah()
    {
        $peraturan = Peraturan::factory()->create(['nama_peraturan' => 'Maksimal 10 orang']);
        $homestay = Homestay::factory()->create(['pemilik_id' => $this->profile->pemilik_id]);
        $homestay->peraturan()->sync([$peraturan->peraturan_id]);

        $this->put(route('pemilik.homestay.update', $homestay->homestay_id), [
            'nama_homestay' => $homestay->nama_homestay,
            'link_google_maps' => $homestay->link_google_maps,
            'alamat_homestay' => $homestay->alamat_homestay,
            'deskripsi' => $homestay->deskripsi,
            'peraturan' => [] // kosong, tidak bisa diubah
        ]);

        $this->assertDatabaseHas('homestay_peraturan', [
            'homestay_id' => $homestay->homestay_id,
            'peraturan_id' => $peraturan->peraturan_id
        ]);
    }

    /** 15️⃣ Peraturan Dimodifikasi (Satu Dicentang Ulang) di form EDIT */
    public function test_peraturan_dimodifikasi_satu_dicentang()
    {
        $peraturan1 = Peraturan::factory()->create();
        $peraturan2 = Peraturan::factory()->create();

        $homestay = Homestay::factory()->create(['pemilik_id' => $this->profile->pemilik_id]);
        $homestay->peraturan()->sync([$peraturan1->peraturan_id, $peraturan2->peraturan_id]);

        // Update hanya peraturan1
        $this->put(route('pemilik.homestay.update', $homestay->homestay_id), [
            'nama_homestay' => $homestay->nama_homestay,
            'link_google_maps' => $homestay->link_google_maps,
            'alamat_homestay' => $homestay->alamat_homestay,
            'deskripsi' => $homestay->deskripsi,
            'peraturan' => [$peraturan1->peraturan_id]
        ]);

        $this->assertDatabaseHas('homestay_peraturan', [
            'homestay_id' => $homestay->homestay_id,
            'peraturan_id' => $peraturan1->peraturan_id
        ]);
        $this->assertDatabaseMissing('homestay_peraturan', [
            'homestay_id' => $homestay->homestay_id,
            'peraturan_id' => $peraturan2->peraturan_id
        ]);
    }
}
