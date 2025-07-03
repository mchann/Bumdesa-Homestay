<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Bumdes</title>
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
        
        /* Styling for Canvas */
        canvas {
            max-width: 100%;
            height: auto;
        }

        /* Adjustments for Chart Layout */
        .chart-container {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .chart-container canvas {
            max-width: 48%;
        }

        /* Styling the charts */
        #orderChart {
            margin-bottom: 2rem;
        }

        #statusChart {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white flex flex-col">
            <div class="flex items-center justify-center h-16 border-b border-gray-700">
                <img src="{{ asset('img/logo-tamansari.png') }}" alt="Logo Homestay" class="h-12">
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">dashboard</span> Dashboard
                </a>
                
                <!-- Dropdown Homestay -->
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition cursor-pointer">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">home_work</span> Kelola Homestay
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('admin.pemilik.list') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Pemilik Homestay
                        </a>
                    </div>
                </div>

                
                <div class="dropdown">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <!-- Updated Icon for Homestay Facilities -->
                            <span class="material-icons mr-2">home</span> Fasilitas
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>                                       
                    <div class="dropdown-content">
                        <a href="{{ route('admin.fasilitas.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Fasilitas Homestay
                        </a>
                    </div>
                </div>
                
                <!-- Dropdown Pemesanan -->
                <div class="dropdown">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">book</span> Peraturan
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('admin.peraturan.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">list</span> Daftar Peraturan
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">payment</span> Pemesanan
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
                    <span class="material-icons mr-2">rate_review</span> Ulasan & Rating
                </a>
                
                <!-- Dropdown Laporan -->
                <div class="dropdown">
                    <button class="dropdown-toggle flex items-center justify-between w-full p-2 rounded hover:bg-gray-800 transition">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">analytics</span> Statistik & Laporan
                        </div>
                        <span class="dropdown-arrow material-icons transition-transform">expand_more</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">show_chart</span> Statistik
                        </a>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">description</span> Laporan Bulanan
                        </a>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-gray-700 transition">
                            <span class="material-icons mr-2">summarize</span> Laporan Tahunan
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">Selamat Datang, Admin Bumdes</h1>
                <div class="flex items-center space-x-4 relative">
                    <!-- Notification Icon -->
                    <div class="relative">
                        <button class="text-gray-600">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <span class="absolute top-0 right-0 block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                    </div>

                    <!-- User Section with Dropdown -->
                    <div class="flex items-center space-x-3 border-l border-gray-300 pl-3">
                        <!-- User Icon -->
                        <div class="rounded-full bg-blue-600 text-white w-8 h-8 flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <!-- User Info -->
                        <div class="text-left">
                            <div class="text-gray-700 text-sm font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-gray-400 text-xs">
                                {{ Auth::user()->role ?? 'User' }}
                            </div>
                        </div>

                        <!-- Dropdown Trigger -->
                        <button type="button" class="inline-flex justify-center items-center text-sm font-medium text-gray-700 focus:outline-none" id="dropdownButton">
                            <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-white border rounded-md shadow-lg hidden z-50 top-full">
                            <div class="px-4 py-2 border-b text-sm text-gray-500">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span>Role: </span><strong class="text-blue-600">{{ Auth::user()->role ?? 'User' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('pemilik.profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-user mr-2 text-gray-400"></i> Profil
                            </a>
                            <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-home mr-2 text-gray-400"></i> Halaman Utama
                            </a>  
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-cog mr-2 text-gray-400"></i> Pengaturan Akun
                            </a>                   

                            <!-- Logout Section -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 bg-white shadow-lg sm:rounded-xl">
                <div class="w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
    
            dropdownButton.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
    
            document.addEventListener('click', function (e) {
                if (!dropdownMenu.contains(e.target) && e.target !== dropdownButton) {
                    dropdownMenu.classList.add('hidden');
                }
            });
    
            // FIXED SIDEBAR DROPDOWN
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
    
                    const thisDropdown = this.closest('.dropdown');
    
                    // Tutup dropdown lain
                    document.querySelectorAll('.dropdown').forEach(drop => {
                        if (drop !== thisDropdown) {
                            drop.classList.remove('active');
                        }
                    });
    
                    // Toggle dropdown saat ini
                    thisDropdown.classList.toggle('active');
                });
            });
        });
    </script>
</body>
</html>