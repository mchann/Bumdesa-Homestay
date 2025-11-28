<!-- Navbar Start -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-lg-2 py-1">
    <div class="container-fluid px-lg-4 px-3">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center me-lg-4 me-2" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('img/logo-tamansari.png')); ?>" width="60" height="60" class="img-fluid">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse mt-lg-0 mt-2" id="navbarCollapse">

            <!-- Main Menu -->
            <ul class="navbar-nav mx-auto mb-lg-0 mb-3 gap-lg-2 gap-1">
                <li class="nav-item">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link text-light px-lg-3 px-2 py-2 
                    <?php echo e(request()->routeIs('home') ? 'active bg-gradient-primary' : ''); ?>">
                        Home
                    </a>
                </li>

                <!-- Destinations -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light px-lg-3 px-2 py-2" href="#" data-bs-toggle="dropdown">
                        Destinations
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow-lg border-0">
                        <li><a class="dropdown-item" href="<?php echo e(route('destinations.ijencrater')); ?>">Ijen Crater</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('destinations.gandrung')); ?>">Gandrung Terracotta Park</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('destinations.sendang')); ?>">Sendang Seruni</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('packages')); ?>" class="nav-link text-light px-lg-3 px-2 py-2">
                        Tour Packages
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('umkm')); ?>" class="nav-link text-light px-lg-3 px-2 py-2">
                        UMKM
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('homestay.index')); ?>" class="nav-link text-light px-lg-3 px-2 py-2">
                        Homestays
                    </a>
                </li>
            </ul>

            <!-- USER DROPDOWN (mobile & desktop dalam collapse, tetap rapi) -->
            <ul class="navbar-nav ms-lg-auto">
                <?php if(auth()->guard()->check()): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle d-flex align-items-center"
                       href="#" data-bs-toggle="dropdown">

                        <!-- ICON TIDAK DIGANTI -->
                        <i class="fas fa-user-circle fs-3"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2">
                        <?php if(Auth::user()->role === 'admin'): ?>
                            <li><a class="dropdown-item py-2" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <?php elseif(Auth::user()->role === 'pemilik'): ?>
                            <li><a class="dropdown-item py-2" href="<?php echo e(route('pemilik.dashboard')); ?>">Dashboard</a></li>
                        <?php elseif(Auth::user()->role === 'pelanggan'): ?>
                            <li><a class="dropdown-item py-2" href="<?php echo e(route('pelanggan.profile')); ?>">My Account</a></li>
                            <li><a class="dropdown-item py-2" href="<?php echo e(route('pelanggan.history')); ?>">My Order</a></li>
                        <?php endif; ?>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item text-danger py-2">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

                <?php else: ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('login')); ?>" class="nav-link text-light px-3 py-2">Login</a>
                </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- Navbar End -->


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
        color: #212529;
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
        
        /* Mobile dropdown adjustments */
        .dropdown-menu {
            background-color: rgba(0,0,0,0.2);
            border: none;
            box-shadow: none;
            margin-left: 1rem;
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
</style><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/component/navbar.blade.php ENDPATH**/ ?>