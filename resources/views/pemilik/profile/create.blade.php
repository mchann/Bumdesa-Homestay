@extends('layouts.pemilik')

@section('title', 'Profil Pemilik')

@section('content')
    <h2>Edit Profil Pemilik Homestay</h2>

    <form action="{{ route('pemilik.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" 
                value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" 
                value="{{ old('nomor_telepon', $profile->nomor_telepon) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="4" required>{{ old('alamat', $profile->alamat) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</x-app-layout>
