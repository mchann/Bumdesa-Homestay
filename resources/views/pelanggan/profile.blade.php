@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body text-center p-4">
                    <div class="avatar-wrapper mx-auto mb-3 position-relative">
                        <div class="avatar bg-gradient-primary text-white d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; border-radius: 50%; font-size: 36px; box-shadow: 0 4px 20px rgba(78, 115, 223, 0.3);">
                            {{ strtoupper(substr($profile->nama_lengkap ?? Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $profile->nama_lengkap ?? Auth::user()->name ?? 'Nama Pengguna' }}</h5>
                    <p class="text-muted small mb-4">Pelanggan</p>
                    
                    <div class="list-group list-group-flush rounded-lg">
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center active">
                            <i class="fas fa-user me-3 text-primary"></i>
                            <span>My Account</span>
                            <i class="fas fa-chevron-right ms-auto text-muted"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-credit-card me-3 text-info"></i>
                            <span>My Card</span>
                            <i class="fas fa-chevron-right ms-auto text-muted"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-shopping-cart me-3 text-success"></i>
                            <span>Purchase List</span>
                            <i class="fas fa-chevron-right ms-auto text-muted"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-box me-3 text-warning"></i>
                            <span>My Order</span>
                            <i class="fas fa-chevron-right ms-auto text-muted"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                            <i class="fas fa-exchange-alt me-3 text-secondary"></i>
                            <span>Refund</span>
                            <i class="fas fa-chevron-right ms-auto text-muted"></i>
                        </a>
                        <a href="{{ route('logout') }}" 
   class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center text-danger"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt me-3"></i>
    <span>Logout</span>
    <i class="fas fa-chevron-right ms-auto"></i>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4">Connected Accounts</h6>
                    <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle me-3 shadow-sm">
                                <i class="fab fa-google text-danger"></i>
                            </div>
                            <span>Google</span>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">Connected</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle me-3 shadow-sm">
                                <i class="fab fa-facebook text-primary"></i>
                            </div>
                            <span>Facebook</span>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">Connect</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">Account Information</h4>
                    <a href="{{ route('pelanggan.profile.edit') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                </div>
                
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 text-uppercase small text-primary">Personal Data</h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Full Name *</label>
                            <div class="p-3 bg-light rounded-lg border">{{ $profile->nama_lengkap ?? Auth::user()->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Country</label>
                            <div class="p-3 bg-light rounded-lg border">{{ $profile->kewarganegaraan ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Gender</label>
                            <div class="p-3 bg-light rounded-lg border">
                                @isset($profile->jenis_kelamin)
                                    @if($profile->jenis_kelamin === 'Male')
                                        Laki-laki
                                    @elseif($profile->jenis_kelamin === 'Female')
                                        Perempuan
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endisset
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Date of birth</label>
                            <div class="p-3 bg-light rounded-lg border">
                                @isset($profile->tgl_lahir)
                                    {{ \Carbon\Carbon::parse($profile->tgl_lahir)->format('d F Y') }}
                                @else
                                    -
                                @endisset
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Email Address *</label>
                            <div class="p-3 bg-light rounded-lg border">{{ Auth::user()->email ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small text-muted mb-2">Phone Number</label>
                            <div class="p-3 bg-light rounded-lg border">{{ $profile->nomor_telepon ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h4 class="mb-0 fw-bold">Security Setting</h4>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-danger me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Delete Account</h6>
                                <p class="small mb-0">Once an account is deleted, you will not be able to access its data forever.</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-danger px-4 py-2">
                        <i class="fas fa-trash-alt me-2"></i> Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8fafc;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    .list-group-item {
        transition: all 0.3s ease;
        border-left: 0;
        border-right: 0;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    .list-group-item.active {
        background-color: rgba(78, 115, 223, 0.1);
        border-left: 3px solid #4e73df;
        color: #4a4a4a;
    }
    .avatar {
        transition: all 0.3s ease;
    }
    .avatar:hover {
        transform: scale(1.05);
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #3a5ec4;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
    }
    .btn-outline-danger {
        transition: all 0.3s ease;
    }
    .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
    }
    .rounded-lg {
        border-radius: 10px;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    .form-control-static {
        min-height: 44px;
        padding-top: 12px;
        padding-bottom: 12px;
    }
</style>
@endsection