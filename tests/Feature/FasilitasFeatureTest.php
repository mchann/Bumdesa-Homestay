<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\User;

class FasilitasFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Mengatasi masalah QueryException dan 403 Forbidden dengan memastikan
        // User memiliki kolom 'role' = 'admin', sesuai dengan middleware rute.
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    // =========================================================================
    // TC-FAS-SEC-009: Akses fungsi Tambah fasilitas tanpa login (Unauthorized Access).
    // =========================================================================
    public function test_TC_FAS_SEC_009_unauthenticated_user_cannot_access_fasilitas_routes(): void
    {
        // Akses Index tanpa login
        $response = $this->get(route('admin.fasilitas.index'));
        $response->assertRedirect('/login');

        // Akses Store tanpa login
        $response = $this->post(route('admin.fasilitas.store'), ['nama_fasilitas' => 'Test']);
        $response->assertRedirect('/login');
    }

    // =========================================================================
    // TC-FAS-ADD-001: Tambah fasilitas dengan nama yang valid (kapitalisasi acak).
    // =========================================================================
    public function test_TC_FAS_ADD_001_admin_can_store_valid_fasilitas(): void
    {
        $fasilitasName = 'Pemanas Air';

        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => $fasilitasName,
        ]);

        // Ekspektasi: Redirect ke index dengan pesan sukses
        $response->assertRedirect(route('admin.fasilitas.index'));
        $response->assertSessionHas('success', 'Fasilitas berhasil ditambahkan');
        $this->assertDatabaseHas('fasilitas', ['nama_fasilitas' => $fasilitasName]);
    }

    // =========================================================================
    // TC-FAS-ADD-002: Tambah fasilitas dengan nama yang sudah ada (duplikasi).
    // =========================================================================
    public function test_TC_FAS_ADD_002_store_fails_with_duplicate_name(): void
    {
        // Pre-state: Sudah ada 'Free Wifi'
        Fasilitas::factory()->create(['nama_fasilitas' => 'Free Wifi']);
        $duplicateName = 'Free Wifi';

        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => $duplicateName,
        ]);

        // FIX: Diubah dari 422 ke 302 karena validation redirect
        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['nama_fasilitas']);
        $this->assertCount(1, Fasilitas::where('nama_fasilitas', $duplicateName)->get());
    }

    // =========================================================================
    // TC-FAS-ADD-003: Tambah fasilitas dengan input kosong.
    // =========================================================================
    public function test_TC_FAS_ADD_003_store_fails_with_empty_input(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => '', // Input kosong
        ]);

        // FIX: Diubah dari 422 ke 302 karena validation redirect
        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['nama_fasilitas']);
        $this->assertDatabaseMissing('fasilitas', ['nama_fasilitas' => '']);
    }

    // =========================================================================
    // TC-FAS-ADD-004: Tambah fasilitas dengan karakter scripting (XSS).
    // =========================================================================
    public function test_TC_FAS_ADD_004_xss_script_is_stored_as_literal_text(): void
    {
        $xssPayload = "<script>alert('XSS')</script>";

        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => $xssPayload,
        ]);

        // Ekspektasi: Berhasil disimpan (Redirect)
        $response->assertRedirect(route('admin.fasilitas.index'));
        
        // Memastikan payload XSS tersimpan persis di database
        $this->assertDatabaseHas('fasilitas', ['nama_fasilitas' => $xssPayload]);
    }

    // =========================================================================
    // TC-FAS-ADD-005: Tambah fasilitas dengan batas maksimum karakter (100).
    // =========================================================================
    public function test_TC_FAS_ADD_005_store_succeeds_with_max_length(): void
    {
        $maxName = str_repeat('A', 100);

        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => $maxName,
        ]);

        // Ekspektasi: Berhasil disimpan
        $response->assertRedirect(route('admin.fasilitas.index'));
        $this->assertDatabaseHas('fasilitas', ['nama_fasilitas' => $maxName]);
    }

    // =========================================================================
    // TC-FAS-ADD-006: Tambah fasilitas melebihi batas maksimum karakter (101).
    // =========================================================================
    public function test_TC_FAS_ADD_006_store_fails_when_exceeds_max_length(): void
    {
        $tooLongName = str_repeat('B', 101);

        $response = $this->actingAs($this->admin)->post(route('admin.fasilitas.store'), [
            'nama_fasilitas' => $tooLongName,
        ]);

        // FIX: Diubah dari 422 ke 302 karena validation redirect
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['nama_fasilitas']);
        $this->assertDatabaseMissing('fasilitas', ['nama_fasilitas' => $tooLongName]);
    }

    // =========================================================================
    // TC-FAS-DEL-007: Hapus fasilitas yang ada di daftar.
    // =========================================================================
    public function test_TC_FAS_DEL_007_admin_can_delete_existing_fasilitas(): void
    {
        // Pre-state: Buat fasilitas 'AC'
        $fasilitas = Fasilitas::factory()->create(['nama_fasilitas' => 'AC']);

        // Hapus fasilitas menggunakan Model Binding
        $response = $this->actingAs($this->admin)->delete(route('admin.fasilitas.destroy', $fasilitas));

        // Ekspektasi: Redirect ke halaman sebelumnya (back()) dengan pesan sukses
        $response->assertRedirect(); 
        $response->assertSessionHas('success', 'Fasilitas berhasil dihapus');
        
        // Memastikan data terhapus
        $this->assertDatabaseMissing('fasilitas', ['id' => $fasilitas->id]);
    }

    // =========================================================================
    // TC-FAS-DEL-008: Hapus fasilitas dan pastikan konfirmasi muncul.
    // (Uji ketersediaan data di Index, konfirmasi front-end tidak dapat diuji di Unit/Feature test)
    // =========================================================================
    public function test_TC_FAS_DEL_008_delete_action_is_visible_on_index(): void
    {
        // Pre-state: Buat fasilitas 'TV'
        Fasilitas::factory()->create(['nama_fasilitas' => 'TV']);

        // Akses halaman index
        $response = $this->actingAs($this->admin)->get(route('admin.fasilitas.index'));

        // Ekspektasi: Halaman OK dan menampilkan fasilitas 'TV'
        $response->assertStatus(200);
        $response->assertSee('TV');
        // (Asumsi tombol hapus/aksi terlihat di halaman ini)
    }

    // =========================================================================
    // Tes memastikan route Edit/Update melempar 404 (Karena rute resource hanya untuk index, create, store, destroy)
    // =========================================================================
    public function test_unsupported_edit_and_update_routes_return_404(): void
    {
        $this->actingAs($this->admin);
        $fasilitas = Fasilitas::factory()->create();
        
        // Rute yang TIDAK terdaftar di Resource harus melempar 404.
        // Kita uji endpoint URL secara langsung, bukan nama rute yang sudah dihapus.
        $editUrl = '/admin/fasilitas/' . $fasilitas->id . '/edit';
        $updateUrl = '/admin/fasilitas/' . $fasilitas->id;

        // Menguji rute Edit (GET)
        $responseEdit = $this->get($editUrl);
        $responseEdit->assertStatus(404); 

        // Menguji rute Update (PUT)
        $responseUpdate = $this->put($updateUrl, ['nama_fasilitas' => 'Gagal Update']);
        $responseUpdate->assertStatus(404); 
    }
}
