<x-app-layout>
    <h2>Lengkapi Profil Anda</h2>
    
    <form action="{{ route('admin.profile.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat">{{ old('alamat') }}</textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>
</x-app-layout>
