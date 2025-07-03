@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
    <h2>Profil Admin</h2>

    @if (empty($profile) || !$profile->nama_lengkap)
        <div class="alert alert-warning">
            Profil Anda belum lengkap. <a href="{{ route('admin.profile.create') }}" class="btn btn-warning">Lengkapi Profil</a>
        </div>
    @else
        <!-- Tampilkan Profil jika Sudah Lengkap -->
        <p>Nama Lengkap: {{ $profile->nama_lengkap ?? 'Belum diisi' }}</p>
        <p>Nomor Telepon: {{ $profile->nomor_telepon ?? 'Belum diisi' }}</p>
        <p>Alamat: {{ $profile->alamat ?? 'Belum diisi' }}</p>
    @endif
    <a href="{{ route('profile.edit') }}">Edit Profil</a>

@endsection