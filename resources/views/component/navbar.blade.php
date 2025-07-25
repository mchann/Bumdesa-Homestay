<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-lg-2 py-1">
    <div class="container-fluid px-lg-4 px-3">
        {{-- Navbar logo --}}
        <a class="navbar-brand d-flex align-items-center me-lg-4 me-2" href="{{ route('home') }}">
            <img src="{{ asset('img/logo-tamansari.png') }}" width="60" height="60" alt="Logo" class="img-fluid" style="max-width: 60px; height: auto; transition: all 0.3s ease;">
        </a>

        {{-- Navbar toggler --}}
        <button class="navbar-toggler ms-auto border-0 focus:shadow-none focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar menus --}}
        <div class="collapse navbar-collapse mt-lg-0 mt-2" id="navbarCollapse">
            <ul class="navbar-nav mx-auto mb-lg-0 mb-3 gap-lg-2 gap-1">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-light px-lg-3 px-2 py-2 rounded {{ request()->routeIs('home') ? 'active bg-gradient-primary' : '' }}">
                        <span class="position-relative">
                            Home
                            <span class="position-absolute bottom-0 start-0 w-0 h-1 bg-primary transition-all" style="transition-duration: 0.3s;"></span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('destinations') }}" class="nav-link text-light px-lg-3 px-2 py-2 rounded {{ request()->routeIs('destinations') ? 'active bg-gradient-primary' : '' }}">
                        <span class="position-relative">
                            Destinations
                            <span class="position-absolute bottom-0 start-0 w-0 h-1 bg-primary transition-all" style="transition-duration: 0.3s;"></span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('packages') }}" class="nav-link text-light px-lg-3 px-2 py-2 rounded {{ request()->routeIs('packages') ? 'active bg-gradient-primary' : '' }}">
                        <span class="position-relative">
                            Tour Packages
                            <span class="position-absolute bottom-0 start-0 w-0 h-1 bg-primary transition-all" style="transition-duration: 0.3s;"></span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('homestay.index') }}" class="nav-link text-light px-lg-3 px-2 py-2 rounded {{ request()->routeIs('homestay.index') ? 'active bg-gradient-primary' : '' }}">
                        <span class="position-relative">
                            Homestays
                            <span class="position-absolute bottom-0 start-0 w-0 h-1 bg-primary transition-all" style="transition-duration: 0.3s;"></span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- User Icon with Notification Badge --}}
        <div class="d-flex align-items-center justify-content-center ms-lg-4 ms-2">
            @auth
                <div class="dropdown">
                    <a class="nav-link text-light position-relative p-0" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="position-relative" style="width: 42px; height: 42px;">
                            <div class="bg-secondary d-flex align-items-center justify-content-center rounded-circle" style="width: 100%; height: 100%; transition: all 0.3s ease;">
                                <i class="fas fa-user text-white" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" aria-labelledby="userDropdown" style="min-width: 220px;">
                        @if(Auth::user()->role === 'admin')
                            <li><a class="dropdown-item py-2 px-3" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                        @elseif(Auth::user()->role === 'pemilik')
                            <li><a class="dropdown-item py-2 px-3" href="{{ route('pemilik.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                        @elseif(Auth::user()->role === 'pelanggan')
                            <li><a class="dropdown-item py-2 px-3" href="{{ route('pelanggan.profile') }}"><i class="fas fa-user me-2"></i>My Account</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-credit-card me-2"></i>My Card</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-shopping-bag me-2"></i>Purchase List</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-clipboard-list me-2"></i>My Order</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-exchange-alt me-2"></i>Refund</a></li>
                        @endif
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-3 text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link text-light d-flex align-items-center px-3 py-2 rounded bg-primary-hover">
                    <i class="fas fa-sign-in-alt me-2"></i> 
                    <span class="d-none d-lg-inline">Login</span>
                </a>
            @endauth
        </div>
    </div>
</nav>
<!-- Navbar End -->

{{-- Dummy div to prevent content from being hidden under navbar --}}
<div style="height: 72px;"></div>

<style>
    :root {
        --navbar-height: 72px;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, rgba(13,110,253,0.2) 0%, rgba(13,110,253,0.1) 100%);
    }
    
    .bg-primary-hover:hover {
        background-color: rgba(13,110,253,0.2);
    }
    
    .nav-link.active {
        font-weight: 500;
    }
    
    .nav-link:hover span span {
        width: 100% !important;
    }
    
    .dropdown-item {
        transition: all 0.2s ease;
        border-radius: 4px;
        margin: 2px 6px;
        width: auto;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(2px);
    }
    
    .dropdown-menu {
        border-radius: 8px;
    }
    
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background-color: #2c3034;
            padding: 1rem;
            margin-top: 0.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .navbar-nav {
            gap: 0.5rem !important;
        }
        
        .nav-link {
            padding: 0.75rem 1rem !important;
        }
        
        .nav-link.active {
            background-color: rgba(13,110,253,0.2);
        }
    }
    
    @media (max-width: 767.98px) {
        .navbar-brand img {
            width: 50px !important;
        }
        
        .navbar {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .dummy-div {
            height: 64px !important;
        }
    }
    
    @media (max-width: 575.98px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .login-text {
            display: none;
        }
        
        .navbar-brand {
            margin-right: 0.5rem;
        }
    }
</style>