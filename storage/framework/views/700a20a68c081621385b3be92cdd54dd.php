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
<section class="hero-video-container">
    <video autoplay muted loop playsinline class="hero-video">
        <source src="<?php echo e(asset('img/pesona.mp4')); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <div class="container">
            <h1 class="hero-title animate-fadeInUp" style="animation-delay: 0.2s">
                Desa Wisata Tamansari Licin
            </h1>
            <p class="hero-subtitle animate-fadeInUp" style="animation-delay: 0.4s">
                Temukan keindahan alam dan keramahan masyarakat Desa Tamansari, Licin Banyuwangi
            </p>
            <div class="animate-fadeInUp" style="animation-delay: 0.6s">
                <a href="#destinasi" class="btn-primary">
                    Jelajahi Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    
        <a href="#about" class="absolute bottom-8 text-white text-2xl animate-bounce">
            <i class="fas fa-chevron-down"></i>
        </a>
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
                    <img src="<?php echo e(asset('img/kawah.png')); ?>" class="card-img-top" alt="Air Terjun Tumpak Sewu">
                    <div class="card-body">
                        <h5 class="card-title">Air Terjun Tumpak Sewu</h5>
                        <p class="card-text">Air terjun setinggi 120 meter dengan pemandangan spektakuler.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">4.9 <i class="fas fa-star"></i></span>
                            <a href="#" class="text-primary">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e(asset('img/hv-jiwa-jawa.jpg')); ?>" class="card-img-top" alt="Kebun Kopi Tamansari">
                    <div class="card-body">
                        <h5 class="card-title">Kebun Kopi Tamansari</h5>
                        <p class="card-text">Wisata agro melihat proses penanaman hingga pengolahan kopi khas Ijen.</p>
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
                <img src="<?php echo e(asset('img/haha.jpg')); ?>" alt="Kopi Ijen" class="w-100" style="height: 200px; object-fit: cover;">
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
                <img src="<?php echo e(asset('img/haha.jpg')); ?>" alt="Tenun Osing" class="w-100" style="height: 200px; object-fit: cover;">
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
                <img src="<?php echo e(asset('img/haha.jpg')); ?>" alt="Madu Ijen" class="w-100" style="height: 200px; object-fit: cover;">
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
                <img src="<?php echo e(asset('img/haha.jpg')); ?>" alt="Kerajinan Bambu" class="w-100" style="height: 200px; object-fit: cover;">
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

<!-- Homestay Tamansari Section -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Homestay di Tamansari Licin</h2>
            <p class="section-subtitle mx-auto">
                Menginap di homestay lokal untuk pengalaman yang lebih autentik dan mendukung masyarakat setempat
            </p>
        </div>
        
        <div class="row">
            <!-- Homestay 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="homestay-card">
                    <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="card-img-top" alt="Ijen View Homestay" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">Ijen View Homestay</h5>
                                <p class="text-muted mb-3"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Desa Tamansari, Licin</p>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="card-text">Homestay dengan pemandangan langsung ke Gunung Ijen dan kebun kopi.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="font-weight-bold text-primary">Rp 250.000</span>/malam
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Homestay 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="homestay-card">
                    <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="card-img-top" alt="Kopi Tani Homestay" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">Kopi Tani Homestay</h5>
                                <p class="text-muted mb-3"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Desa Tamansari, Licin</p>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">Pengalaman tinggal di tengah perkebunan kopi dengan udara sejuk.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="font-weight-bold text-primary">Rp 300.000</span>/malam
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Homestay 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="homestay-card">
                    <img src="<?php echo e(asset('img/haha.jpg')); ?>" class="card-img-top" alt="Rumah Osing Homestay" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">Rumah Osing Homestay</h5>
                                <p class="text-muted mb-3"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Desa Tamansari, Licin</p>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">Homestay tradisional dengan arsitektur khas Osing Banyuwangi.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="font-weight-bold text-primary">Rp 200.000</span>/malam
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="#" class="btn btn-primary btn-lg">
                Lihat Semua Homestay <i class="fas fa-arrow-right ml-2"></i>
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

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="mb-2">Siap Mengunjungi Desa Tamansari?</h3>
                <p class="mb-0">Dapatkan pengalaman wisata yang tak terlupakan di Banyuwangi</p>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a href="#" class="btn btn-light btn-lg mr-3">Pesan Sekarang</a>
                <a href="#" class="btn btn-outline-light btn-lg">Kontak Kami</a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/page/home.blade.php ENDPATH**/ ?>