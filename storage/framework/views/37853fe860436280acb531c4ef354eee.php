<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e(asset('img/logo-tamansari.png')); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dropdown-content {
            display: none;
            padding-left: 1rem;
        }
        
        .dropdown.active .dropdown-content {
            display: block;
        }
        
        .dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        /* Mobile Sidebar */
        .mobile-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-sidebar.open {
            transform: translateX(0);
        }
        
        .overlay {
            display: none;
            background: rgba(0, 0, 0, 0.5);
        }
        
        .overlay.active {
            display: block;
        }

        /* Fix dropdown positioning */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            position: static;
            background: transparent;
            border: none;
            box-shadow: none;
            width: 100%;
        }

        /* Desktop dropdown */
        @media (min-width: 768px) {
            .dropdown {
                position: relative;
            }

            .dropdown-content {
                position: absolute;
                left: 0;
                top: 100%;
                background: #1f2937;
                border: 1px solid #374151;
                border-radius: 0.5rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                width: 200px;
                z-index: 50;
                padding: 0.5rem 0;
            }

            .dropdown-content a {
                padding: 0.5rem 1rem;
                margin: 0;
                border-radius: 0;
            }

            .dropdown-content a:hover {
                background: #374151;
            }
        }

        /* PERBAIKAN UTAMA: Positioning untuk dropdown user di header */
        .user-info-desktop {
            position: relative;
        }

        #dropdownMenu {
            position: absolute;
            right: 0;
            top: 100%; /* Posisikan tepat di bawah container user */
            margin-top: 0.5rem; /* Sedikit jarak */
            z-index: 1000;
        }

        /* Styling for Canvas */
        canvas {
            max-width: 100%;
            height: auto;
        }

        /* Adjustments for Chart Layout */
        .chart-container {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .chart-container canvas {
            max-width: 100%;
        }

        @media (min-width: 768px) {
            .chart-container canvas {
                max-width: 48%;
            }
        }

        /* Responsive table */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .desktop-sidebar {
                display: none;
            }
            
            .user-info-mobile {
                display: block;
            }
            
            .user-info-desktop {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .user-section {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Mobile Overlay -->
    <div class="overlay fixed inset-0 z-40" id="overlay"></div>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar fixed top-0 left-0 w-64 h-full bg-black text-white z-50 md:hidden" id="mobileSidebar">
        <div class="flex items-center justify-between h-16 border-b border-gray-700 px-4">
            <img src="<?php echo e(asset('img/logo-tamansari.png')); ?>" alt="Logo Homestay" class="h-10">
            <button class="text-white p-2" id="closeMobileSidebar">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
            <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition" onclick="closeMobileSidebar()">
                <span class="material-icons mr-2">dashboard</span> Dashboard
            </a>
            
            <!-- Dropdown Homestay -->
            <div class="dropdown">
                <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                    <div class="flex items-center">
                        <span class="material-icons mr-2">home_work</span> Kelola Homestay
                    </div>
                    <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                </button>
                <div class="dropdown-content">
                    <a href="<?php echo e(route('pemilik.homestay.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition" onclick="closeMobileSidebar()">
                        <span class="material-icons mr-2">list</span> Homestay Anda
                    </a>
                </div>
            </div>
            
            <!-- Dropdown Kamar -->
            <div class="dropdown">
                <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                    <div class="flex items-center">
                        <span class="material-icons mr-2">bed</span> Kelola Kamar
                    </div>
                    <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                </button>
                <div class="dropdown-content">
                    <a href="<?php echo e(route('pemilik.kamar.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition" onclick="closeMobileSidebar()">
                        <span class="material-icons mr-2">list</span> Daftar Kamar
                    </a>
                </div>
            </div>
            
            <!-- Dropdown Pemesanan -->
            <div class="dropdown">
                <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                    <div class="flex items-center">
                        <span class="material-icons mr-2">book</span> Pemesanan
                    </div>
                    <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                </button>
                <div class="dropdown-content">
                    <a href="<?php echo e(route('pemilik.pemesanan.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition" onclick="closeMobileSidebar()">
                        <span class="material-icons mr-2">list</span> Daftar Pemesanan
                    </a>
                </div>
            </div>
            
            <a href="<?php echo e(route('pemilik.ulasan.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition" onclick="closeMobileSidebar()">
                <span class="material-icons mr-2">reviews</span> Ulasan
            </a>
            
            <!-- Pembayaran -->
            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800 transition" onclick="closeMobileSidebar()">
                <span class="material-icons mr-2">payment</span> Pembayaran
            </a>

            <!-- Mobile User Info -->
            <div class="border-t border-gray-700 pt-4 mt-4 user-info-mobile">
                <div class="flex items-center space-x-3 p-2">
                    <div class="rounded-full bg-blue-600 text-white w-8 h-8 flex items-center justify-center text-sm font-bold">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                    <div class="text-left">
                        <div class="text-white text-sm font-semibold"><?php echo e(Auth::user()->name); ?></div>
                        <div class="text-gray-400 text-xs"><?php echo e(Auth::user()->role ?? 'User'); ?></div>
                    </div>
                </div>
                <div class="mt-2 space-y-1">
                    <a href="<?php echo e(route('pemilik.profile.show')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition text-sm" onclick="closeMobileSidebar()">
                        <i class="fas fa-user mr-3 text-gray-400"></i> Profil
                    </a>
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition text-sm" onclick="closeMobileSidebar()">
                        <i class="fas fa-home mr-3 text-gray-400"></i> Halaman Utama
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left flex items-center p-2 rounded hover:bg-gray-800 transition text-sm text-red-400" onclick="closeMobileSidebar()">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="min-h-screen flex">
        <!-- Desktop Sidebar -->
        <aside class="desktop-sidebar w-64 bg-black text-white flex-col hidden md:flex">
            <div class="flex items-center justify-center h-16 border-b border-gray-700">
                <img src="<?php echo e(asset('img/logo-tamansari.png')); ?>" alt="Logo Homestay" class="h-12">
            </div>
            <nav class="flex-1 px-4 py-4 space-y-2 text-sm">
                <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">dashboard</span> Dashboard
                </a>
                
                <!-- Dropdown Homestay -->
                <div class="dropdown relative">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">home_work</span> Kelola Homestay
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="<?php echo e(route('pemilik.homestay.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Homestay Anda
                        </a>
                    </div>
                </div>
                
                <!-- Dropdown Kamar -->
                <div class="dropdown relative">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">bed</span> Kelola Kamar
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Daftar Kamar
                        </a>
                    </div>
                </div>
                
                <!-- Dropdown Pemesanan -->
                <div class="dropdown relative">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">book</span> Pemesanan
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="<?php echo e(route('pemilik.pemesanan.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Daftar Pemesanan
                        </a>
                    </div>
                </div>
                
                <a href="<?php echo e(route('pemilik.ulasan.index')); ?>" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">reviews</span> Ulasan
                </a>
                
                <!-- Pembayaran -->
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">payment</span> Pembayaran
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Header -->
            <header class="bg-white shadow-md px-4 sm:px-6 py-4 relative">
                <div class="header-content flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile Menu Button -->
                        <button class="mobile-menu-btn text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition" id="mobileMenuButton">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-lg sm:text-xl font-semibold text-gray-800">Selamat Datang, Pemilik</h1>
                    </div>
                    
                    <div class="user-section flex items-center space-x-4">
                        <!-- Notification Icon -->
                        <div class="relative">
                            <button class="text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition">
                                <i class="fas fa-bell text-lg sm:text-xl"></i>
                            </button>
                            <span class="absolute top-0 right-0 block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                        </div>

                        <!-- User Section with Dropdown -->
                        <div class="flex items-center space-x-3 border-l border-gray-300 pl-3 user-info-desktop relative">
                            <!-- User Icon -->
                            <div class="rounded-full bg-blue-600 text-white w-8 h-8 flex items-center justify-center text-sm font-bold">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>

                            <!-- User Info -->
                            <div class="text-left hidden sm:block">
                                <div class="text-gray-700 text-sm font-semibold"><?php echo e(Auth::user()->name); ?></div>
                                <div class="text-gray-400 text-xs"><?php echo e(Auth::user()->role ?? 'User'); ?></div>
                            </div>

                            <!-- Dropdown Trigger -->
                            <button type="button" class="inline-flex justify-center items-center text-sm font-medium text-gray-700 focus:outline-none" id="dropdownButton">
                                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border rounded-md shadow-lg hidden z-50">
                                <div class="px-4 py-2 border-b text-sm text-gray-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span>Role: </span><strong class="text-blue-600"><?php echo e(Auth::user()->role ?? 'User'); ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo e(route('pemilik.profile.show')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <i class="fas fa-user mr-2 text-gray-400"></i> Profil
                                </a>
                                <a href="<?php echo e(route('home')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <i class="fas fa-home mr-2 text-gray-400"></i> Halaman Utama
                                </a>
                                
                                <!-- Logout Section -->
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4 sm:p-6 bg-white shadow-lg sm:rounded-xl flex-1 overflow-auto">
                <div class="w-full">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar functionality
        function openMobileSidebar() {
            document.getElementById('mobileSidebar').classList.add('open');
            document.getElementById('overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            document.getElementById('mobileSidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu button
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const closeMobileSidebarBtn = document.getElementById('closeMobileSidebar');
            const overlay = document.getElementById('overlay');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', openMobileSidebar);
            }

            if (closeMobileSidebarBtn) {
                closeMobileSidebarBtn.addEventListener('click', closeMobileSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeMobileSidebar);
            }

            // Dropdown functionality for user menu
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownMenu.contains(e.target) && e.target !== dropdownButton) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
            
            // Sidebar dropdown functionality - PERBAIKAN UTAMA
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    const dropdown = this.closest('.dropdown');
                    const isMobile = window.innerWidth < 768;
                    
                    // Untuk desktop, cegah perilaku default dan toggle dropdown
                    if (!isMobile) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Close other dropdowns
                        document.querySelectorAll('.dropdown').forEach(otherDropdown => {
                            if (otherDropdown !== dropdown) {
                                otherDropdown.classList.remove('active');
                            }
                        });
                        
                        // Toggle current dropdown
                        dropdown.classList.toggle('active');
                    }
                    // Untuk mobile, biarkan perilaku default (expand/collapse)
                });
            });

            // Close dropdowns when clicking outside (desktop only)
            document.addEventListener('click', function(e) {
                if (window.innerWidth >= 768) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown').forEach(dropdown => {
                            dropdown.classList.remove('active');
                        });
                    }
                }
            });

            // Close mobile sidebar when window is resized to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    closeMobileSidebar();
                    // Juga tutup semua dropdown saat beralih ke desktop
                    document.querySelectorAll('.dropdown').forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            });
        });

        // Prevent body scroll when mobile sidebar is open
        document.addEventListener('touchmove', function(e) {
            if (document.getElementById('mobileSidebar').classList.contains('open')) {
                e.preventDefault();
            }
        }, { passive: false });
    </script>
</body>
</html><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/layouts/pemilik.blade.php ENDPATH**/ ?>