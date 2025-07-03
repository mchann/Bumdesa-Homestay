@extends('layouts.admin')

@section('title', 'Edit Peraturan')

@section('content')
<style>
    .card-form {
        background: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        max-width: 600px;
        margin: 2rem auto;
    }

    .card-form h2 {
        font-size: 1.6rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 1rem;
        padding: 0.8rem 1.2rem;
        font-size: 1.1rem;
        border: 1px solid #dcdfe1;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        padding: 0.6rem 1.4rem;
        font-weight: 500;
        font-size: 1rem;
        border-radius: 0.5rem;
        width: 100%;
        color: #212529;
        transition: background-color 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }
</style>

<div class="container">
    <div class="card-form">
        <h2><i class="bi bi-pencil-square text-warning"></i> Edit Peraturan</h2>
        <form action="{{ route('admin.peraturan.update', $peraturan->peraturan_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="isi_peraturan" class="form-label">Isi Peraturan</label>
                <input type="text" class="form-control" id="isi_peraturan" name="isi_peraturan" 
                    value="{{ $peraturan->isi_peraturan }}" required>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-save2"></i> Update
            </button>
        </form>
    </div>
</div>
@endsection