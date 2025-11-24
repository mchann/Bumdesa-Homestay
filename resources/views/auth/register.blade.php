@extends('layout.main')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="w-100" style="max-width: 420px;">
        {{-- Header --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2" style="font-size: 1.75rem; color: #000000;">Create an Account</h2>
            <p class="text-muted">Join Dewitari Tamansari</p>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Register Form --}}
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name Field --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium" style="color: #000000;">Name<span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" 
                           class="form-control py-2 px-3 @error('name') is-invalid @enderror" 
                           placeholder="Enter Your Name"
                           value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div class="mb-4">
                    <label for="email" class="form-label fw-medium" style="color: #000000;">Email Address<span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email" 
                           class="form-control py-2 px-3 @error('email') is-invalid @enderror" 
                           placeholder="Enter Your Email"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="mb-4">
                    <label for="password" class="form-label fw-medium" style="color: #000000;">Password<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="password" name="password" type="password" 
                               class="form-control py-2 px-3 border-end-0 @error('password') is-invalid @enderror" 
                               placeholder="Enter Your Password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" 
                                data-target="password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Confirm Password Field --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-medium" style="color: #000000;">Confirm Password<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="password_confirmation" name="password_confirmation" type="password" 
                               class="form-control py-2 px-3 border-end-0" 
                               placeholder="Confirm Your Password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" 
                                data-target="password_confirmation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn w-100 py-2 mb-3 fw-medium" style="border-radius: 8px; background-color: #03cb00; color: white;">
                    Register
                </button>

                {{-- Login Link --}}
                <div class="text-center mb-4">
                    <p class="text-muted">Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none" style="color: #03cb00; font-weight: 500;">Login here</a>
                    </p>
                </div>

                {{-- Divider --}}
                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted">Or Continue With</span>
                    <hr class="flex-grow-1">
                </div>

                {{-- Social Login --}}
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('facebook.redirect') }}" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border border-gray-300 bg-white rounded-3 fw-medium"
                       style="transition: all 0.3s ease;">
                        <div class="social-icon-wrapper me-2" style="width: 20px; height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100%" height="100%" fill="#1877F2">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </div>
                        Facebook
                    </a>
                    <a href="{{ route('google.redirect') }}" 
                       class="btn d-flex align-items-center justify-content-center py-2 px-4 border border-gray-300 bg-white rounded-3 fw-medium"
                       style="transition: all 0.3s ease;">
                        <div class="social-icon-wrapper me-2" style="width: 20px; height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100%" height="100%">
                                <path fill="#EA4335" d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115z"/>
                                <path fill="#34A853" d="M16.04 18.013c-1.09.703-2.474 1.078-4.04 1.078a7.077 7.077 0 0 1-6.723-4.823l-4.04 3.067A11.965 11.965 0 0 0 12 24c2.933 0 5.735-1.043 7.834-3l-3.793-2.987z"/>
                                <path fill="#4A90E2" d="M19.834 21c2.195-2.048 3.62-5.096 3.62-9 0-.71-.109-1.473-.272-2.182H12v4.637h6.436c-.317 1.559-1.17 2.766-2.395 3.558L19.834 21z"/>
                                <path fill="#FBBC05" d="M5.277 14.268A7.12 7.12 0 0 1 4.909 12c0-.782.125-1.533.357-2.235L1.24 6.65A11.934 11.934 0 0 0 0 12c0 1.92.445 3.73 1.237 5.335l4.04-3.067z"/>
                            </svg>
                        </div>
                        Google
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript untuk toggle password --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('svg');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = `
                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                `;
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = `
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                `;
            }
        });
    });
});
</script>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .rounded-3 {
        border-radius: 12px !important;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px !important;
        height: 44px;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(46, 139, 87, 0.25);
    }
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    hr {
        border-color: #e5e7eb;
    }
    .social-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    a.btn:hover {
        color: #2e8b57 !important;
    }
    .form-label {
        margin-bottom: 0.5rem;
        display: block;
    }
    .text-danger {
        color: #dc3545;
    }
    .toggle-password {
        cursor: pointer;
        border-radius: 0 8px 8px 0 !important;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-left: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        transition: all 0.2s ease;
    }
    .toggle-password:hover {
        background-color: #e9ecef;
    }
    .input-group .form-control.border-end-0 {
        border-right: none;
    }
</style>
@endpush