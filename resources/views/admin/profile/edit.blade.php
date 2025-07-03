<x-app-layout>
    <h2>Edit Profil Anda</h2>

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $profile->nama_lengkap) }}">
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $profile->nomor_telepon) }}">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat">{{ old('alamat', $profile->alamat) }}</textarea>
        </div>
        <button type="submit">Update Profil</button>
    </form>
</x-app-layout>
