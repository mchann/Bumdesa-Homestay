<?php $__env->startSection('content'); ?>
<style>
    /* Modern Design System */
    :root {
        --primary: #00a859;
        --primary-dark: #00874a;
        --secondary: #ff9e16;
        --dark: #1a1a1a;
        --light: #f8f9fa;
        --gray: #6c757d;
    }
    
    /* Hero Video Section - Modern Fullscreen */
    .hero-video-container {
        position: relative;
        height: 100vh;
        min-height: 600px;
        overflow: hidden;
    }
    
    .hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        object-fit: cover;
        z-index: 0;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 2rem;
        color: white;
    }
    
    /* Modern Typography */
    .hero-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }
    
    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.5rem);
        max-width: 800px;
        margin-bottom: 2rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    
    /* Modern Button */
    .btn-primary {
        background-color: var(--primary);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 168, 89, 0.3);
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 168, 89, 0.4);
    }
    
    /* Section Styles */
    .section {
        padding: 5rem 0;
        position: relative;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }
    
    .section-subtitle {
        font-size: 1.25rem;
        color: var(--gray);
        max-width: 700px;
        margin-bottom: 3rem;
    }
    
    /* Modern Card Design */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    /* UMKM Products Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }
    
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Video Background Section */
    .video-section {
        position: relative;
        height: 500px;
        overflow: hidden;
    }
    
    .video-section video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        object-fit: cover;
    }
    
    /* Profile Section */
    .profile-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* Tamansari Licin Homestay Section */
    .homestay-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
    }
    
    .homestay-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .section {
            padding: 3rem 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>

<!-- Hero Section with Video Background -->
<section class="hero-video-container relative overflow-hidden">
    <!-- Video Background -->
    <video autoplay muted loop playsinline class="hero-video w-full h-full object-cover">
        <source src="<?php echo e(asset('img/pesona.mp4')); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <!-- Overlay -->
    <div class="hero-overlay absolute inset-0 bg-black bg-opacity-50"></div>
    
    <!-- Content -->
    <div class="hero-content relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
        <div class="container px-4 mx-auto">
            <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold mb-4 animate-fadeInUp" style="animation-delay: 0.2s">
                Desa Wisata Tamansari Licin
            </h1>
            <p class="hero-subtitle text-lg md:text-xl lg:text-2xl mb-8 max-w-2xl mx-auto animate-fadeInUp" style="animation-delay: 0.4s">
                Temukan keindahan alam dan keramahan masyarakat Desa Tamansari, Licin Banyuwangi
            </p>
            <div class="animate-fadeInUp" style="animation-delay: 0.6s">
                <a href="#destinasi" class="btn-primary inline-flex items-center px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 transition duration-300">
                    Jelajahi Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    
       
    </div>
</section>

<!-- About Section -->
<section id="about" class="section bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="section-title">Tentang Desa Tamansari</h2>
                <p class="lead mb-4">
                    Desa Tamansari terletak di Kecamatan Licin, Banyuwangi, dengan pemandangan alam yang memukau dan udara sejuk di kaki Gunung Ijen.
                </p>
                <p>
                    Desa ini menawarkan pengalaman wisata yang autentik dengan homestay-homestay tradisional, perkebunan kopi, dan panorama alam yang memesona. Masyarakatnya yang ramah akan membuat Anda merasa seperti di rumah sendiri.
                </p>
                <div class="mt-4">
                    <a href="#" class="btn btn-primary mr-3">Selengkapnya</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="text-primary mb-3">
                                    <i class="fas fa-mountain fa-3x"></i>
                                </div>
                                <h3 class="h5">Gunung Ijen</h3>
                                <p class="text-muted">Jelajahi keindahan kawah Ijen dengan blue fire-nya yang terkenal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="text-primary mb-3">
                                    <i class="fas fa-coffee fa-3x"></i>
                                </div>
                                <h3 class="h5">Kopi Ijen</h3>
                                <p class="text-muted">Rasakan kopi khas yang ditanam di lereng Gunung Ijen</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="text-primary mb-3">
                                    <i class="fas fa-home fa-3x"></i>
                                </div>
                                <h3 class="h5">Homestay</h3>
                                <p class="text-muted">Pengalaman menginap bersama masyarakat lokal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="text-primary mb-3">
                                    <i class="fas fa-utensils fa-3x"></i>
                                </div>
                                <h3 class="h5">Kuliner</h3>
                                <p class="text-muted">Nikmati makanan khas Banyuwangi yang autentik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Destinasi Wisata Section -->
<section id="destinasi" class="section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Destinasi Wisata</h2>
            <p class="section-subtitle mx-auto">
                Temukan tempat-tempat menarik di Desa Tamansari dan sekitarnya yang wajib Anda kunjungi
            </p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e(asset('img/car-ijen.jpeg')); ?>" class="card-img-top" alt="Kawah Ijen">
                    <div class="card-body">
                        <h5 class="card-title">Kawah Ijen</h5>
                        <p class="card-text">Menyaksikan fenomena blue fire dan danau asam terbesar di dunia.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">4.8 <i class="fas fa-star"></i></span>
                            <a href="#" class="text-primary">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e(asset('img/car-seruni.png')); ?>" class="card-img-top" alt="Air Terjun Tumpak Sewu">
                    <div class="card-body">
                        <h5 class="card-title">Sendang Seruni</h5>
                        <p class="card-text">Pemandian Naturistic Tamansari</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">4.9 <i class="fas fa-star"></i></span>
                            <a href="#" class="text-primary">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e(asset('img/car-terakota.jpg')); ?>" class="card-img-top" alt="Kebun Kopi Tamansari">
                    <div class="card-body">
                        <h5 class="card-title">Taman Gandrung Terakota</h5>
                        <p class="card-text">Wisata taman 1000 patung Gandrung Banyuwangi</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">4.7 <i class="fas fa-star"></i></span>
                            <a href="#" class="text-primary">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary btn-lg">
                Lihat Semua Destinasi <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- UMKM Products Section -->
<section class="section bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Produk UMKM Desa Tamansari</h2>
            <p class="section-subtitle mx-auto">
                Dukung perekonomian lokal dengan membeli produk-produk berkualitas dari masyarakat Desa Tamansari
            </p>
        </div>
        
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <img src="<?php echo e(asset('img/hv-jiwa-jawa.jpg')); ?>" alt="Kopi Ijen" class="w-100" style="height: 200px; object-fit: cover;">
                <div class="p-4">
                    <h5>Kopi Ijen Raung</h5>
                    <p class="text-muted">Kopi arabika khas lereng Gunung Ijen</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold text-primary">Rp 75.000</span>
                        <button class="btn btn-sm btn-primary">Beli</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <img src="<?php echo e(asset('img/hv-ijen-resto.jpg')); ?>" alt="Tenun Osing" class="w-100" style="height: 200px; object-fit: cover;">
                <div class="p-4">
                    <h5>Tenun Osing</h5>
                    <p class="text-muted">Kain tradisional khas Banyuwangi</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold text-primary">Rp 250.000</span>
                        <button class="btn btn-sm btn-primary">Beli</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="product-card">
                <img src="<?php echo e(asset('img/card-package-01.png')); ?>" alt="Madu Ijen" class="w-100" style="height: 200px; object-fit: cover;">
                <div class="p-4">
                    <h5>Madu Hutan Ijen</h5>
                    <p class="text-muted">Madu alami dari hutan sekitar Ijen</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold text-primary">Rp 120.000</span>
                        <button class="btn btn-sm btn-primary">Beli</button>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card">
                <img src="<?php echo e(asset('img/hv-andung.jpg')); ?>" alt="Kerajinan Bambu" class="w-100" style="height: 200px; object-fit: cover;">
                <div class="p-4">
                    <h5>Kerajinan Bambu</h5>
                    <p class="text-muted">Produk kerajinan tangan dari bambu</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold text-primary">Rp 85.000</span>
                        <button class="btn btn-sm btn-primary">Beli</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary btn-lg">
                Lihat Semua Produk <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Homestay Tamansari Section with Green Color Scheme -->
<section class="section bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Homestay di Tamansari Licin</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Menginap di homestay lokal untuk pengalaman yang lebih autentik
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $homestays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($homestay->kamar->count() > 0): ?>
                    <?php
                        $cheapestRoom = $homestay->kamar->sortBy('harga')->first();
                    ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <!-- Photo display -->
                        <div class="h-48 relative overflow-hidden">
                            <?php if($homestay->foto_homestay): ?>
                                <img src="<?php echo e(asset('storage/'.$homestay->foto_homestay)); ?>" 
                                     alt="<?php echo e($homestay->nama_homestay); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="absolute inset-0 flex items-center justify-center bg-green-100 text-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo e($homestay->nama_homestay); ?></h3>
                            
                            <!-- Rating with yellow stars -->
                            <div class="flex items-center mb-3">
                                <div class="flex items-center text-yellow-400 mr-2">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= floor($homestay->rating)): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        <?php elseif($i == ceil($homestay->rating) && $homestay->rating % 1 != 0): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-gray-600 text-sm">(<?php echo e($homestay->review_count ?? 0); ?> ulasan)</span>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-600 mb-2">Kapasitas: <?php echo e($cheapestRoom->kapasitas ?? 2); ?> orang</p>
                                <p class="text-xl font-bold text-green-600">
                                    Rp<?php echo e(number_format($cheapestRoom->harga, 0, ',', '.')); ?> 
                                    <span class="text-sm font-normal text-gray-500">/malam</span>
                                </p>
                            </div>
                            
                            <a href="<?php echo e(route('homestay.details', $homestay->homestay_id)); ?>" 
                               class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors duration-300">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-8">
                    <div class="inline-block p-4 bg-yellow-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-gray-600">Tidak ada data homestay saat ini</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-10">
            <a href="<?php echo e(route('homestay.index')); ?>" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-300">
                Lihat Semua Homestay
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="section bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Apa Kata Mereka?</h2>
            <p class="section-subtitle mx-auto">
                Pengalaman pengunjung yang pernah datang ke Desa Wisata Tamansari
            </p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text mb-4">"Pengalaman menginap di homestay Tamansari sangat berkesan. Pemandangan Ijen dari kamar sangat indah, dan kopinya luar biasa!"</p>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="rounded-circle mr-3" width="50" height="50" alt="Testimonial 1">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Travel Blogger</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text mb-4">"Wisata ke Kawah Ijen sangat mudah dari sini. Pemandu lokal sangat ramah dan berpengetahuan luas tentang daerah ini."</p>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="rounded-circle mr-3" width="50" height="50" alt="Testimonial 2">
                            <div>
                                <h6 class="mb-0">David Wilson</h6>
                                <small class="text-muted">Fotografer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text mb-4">"Produk UMKM di sini berkualitas tinggi. Saya membeli kopi dan tenun sebagai oleh-oleh, semua sangat istimewa!"</p>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="rounded-circle mr-3" width="50" height="50" alt="Testimonial 3">
                            <div>
                                <h6 class="mb-0">Lisa Chen</h6>
                                <small class="text-muted">Wisatawan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/page/home.blade.php ENDPATH**/ ?>