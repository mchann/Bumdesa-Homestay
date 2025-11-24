<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\JenisKamar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JenisKamarFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // 🔒 Buat user dengan role admin
        $this->user = User::factory()->create([
            'role' => 'admin',
        ]);
 
        // 🔑 Login sebagai user admin
        $this->actingAs($this->user);
    }

    /** ✅ Test 1: Menyimpan jenis kamar baru (TC-JK-001) */
    public function test_user_can_create_jenis_kamar(): void
    {
        $response = $this->post(route('admin.jenis-kamar.store'), [
            'nama_jenis' => 'Deluxe Room',
        ]);

        $response->assertRedirect(route('admin.jenis-kamar.index'));
        $this->assertDatabaseHas('jenis_kamar', [
            'nama_jenis' => 'Deluxe Room',
        ]);
    }

    /** ❌ Test 2: Validasi gagal saat field kosong (TC-JK-002) */
    public function test_validation_fails_when_nama_jenis_empty(): void
    {
        $response = $this->post(route('admin.jenis-kamar.store'), [
            'nama_jenis' => '',
        ]);

        $response->assertSessionHasErrors(['nama_jenis']);
    }

    /** ⚠ Test 3: Validasi gagal saat duplikat (TC-JK-003) */
    public function test_validation_fails_when_duplicate_nama_jenis(): void
    {
        JenisKamar::create(['nama_jenis' => 'Deluxe Room']);

        $response = $this->post(route('admin.jenis-kamar.store'), [
            'nama_jenis' => 'Deluxe Room',
        ]);

        $response->assertSessionHasErrors(['nama_jenis']);
    }

    /** ✏ Test 4: Menampilkan index (TC-JK-004) */
    public function test_index_page_loads_successfully(): void
    {
        $response = $this->get(route('admin.jenis-kamar.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.jenis_kamar.index');
    }

    /** 🗑 Test 5: Menghapus jenis kamar (TC-JK-005) */
    public function test_user_can_delete_jenis_kamar(): void
    {
        $jenis = JenisKamar::create(['nama_jenis' => 'Standard Room']);

        $response = $this->delete(route('admin.jenis-kamar.destroy', $jenis->jenis_kamar_id));

        $response->assertRedirect(route('admin.jenis-kamar.index'));
        $this->assertDatabaseMissing('jenis_kamar', [
            'jenis_kamar_id' => $jenis->jenis_kamar_id,
        ]);
    }

    /** 🛡️ Test 6: Keamanan - Validasi gagal saat input mengandung XSS Tag (TC-JK-006) */
    public function test_validation_fails_with_xss_input(): void
    {
        $response = $this->post(route('admin.jenis-kamar.store'), [
            'nama_jenis' => '<script>alert(\'xss\')</script>',
        ]);

        // Ekspektasi: Tes ini HARUS GAGAL di validasi karena adanya tag <script>
        $response->assertSessionHasErrors(['nama_jenis']);
        
        $this->assertDatabaseMissing('jenis_kamar', [
            'nama_jenis' => '<script>alert(\'xss\')</script>',
        ]);
    }

    /** 🛡️ Test 7: Keamanan - Validasi gagal saat input mengandung potensi SQL Injection (TC-JK-007) */
    public function test_validation_fails_with_sql_injection_input(): void
    {
        $response = $this->post(route('admin.jenis-kamar.store'), [
            'nama_jenis' => 'OR \'1\'=\'1',
        ]);

        // Ekspektasi: Tes ini HARUS GAGAL di validasi karena adanya tanda kutip dan OR/AND
        $response->assertSessionHasErrors(['nama_jenis']);

        $this->assertDatabaseMissing('jenis_kamar', [
            'nama_jenis' => 'OR \'1\'=\'1',
        ]);
    }
}
