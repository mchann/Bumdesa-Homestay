

<?php $__env->startSection('title', 'Sendang Seruni'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Natural Color Scheme */
    :root {
        --primary: #2e7d32;
        --primary-light: #4caf50;
        --primary-dark: #1b5e20;
        --secondary: #8bc34a;
        --light: #f1f8e9;
        --dark: #263238;
        --water: #4fc3f7;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                    url('<?php echo e(asset('img/car-seruni.png')); ?>');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        align-items: center;
        color: white;
        text-align: center;
    }

    /* Section Styling */
    .section {
        padding: 4rem 0;
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--primary-dark);
        position: relative;
        text-align: center;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary);
    }

    /* Button Styling */
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    /* Gallery Style */
    .gallery-img {
        border-radius: 8px;
        transition: transform 0.3s;
        height: 200px;
        object-fit: cover;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .gallery-img:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    /* Feature Card */
    .feature-card {
        background-color: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        border-top: 4px solid var(--primary);
    }

    /* Water Icon */
    .water-icon {
        color: var(--water);
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-section {
            height: 50vh;
        }
        
        .section {
            padding: 2.5rem 0;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">SENDANG SERUNI</h1>
                <p class="lead mb-5">Oasis Alami di Tengah Keindahan Banyuwangi</p>
                <a href="#about" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-water me-2"></i> Jelajahi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Keindahan Sendang Seruni</h2>
                <p class="lead">Mata air alami yang menyegarkan di tengah hijaunya alam Banyuwangi.</p>
                
                <div class="feature-card">
                    <div class="water-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <p>Sendang Seruni merupakan mata air alami yang jernih dan menyegarkan, dikelilingi oleh pemandangan alam yang asri dan menyejukkan. Tempat ini menjadi favorit bagi wisatawan yang ingin menikmati ketenangan alam.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo e(asset('img/car-seruni.png')); ?>" alt="Sendang Seruni" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section bg-white">
    <div class="container">
        <h2 class="section-title">Galeri Sendang Seruni</h2>
        <p class="lead text-center mb-5">Keindahan alam yang memesona</p>
        
        <div class="row g-3">
            <div class="col-md-4 col-6">
                <img src="<?php echo e(asset('img/car-seruni.png')); ?>" class="gallery-img" alt="Mata air Sendang Seruni">
            </div>
            <div class="col-md-4 col-6">
                <img src="<?php echo e(asset('img/car-seruni.png')); ?>" class="gallery-img" alt="Pemandangan alam">
            </div>
            <div class="col-md-4 col-6">
                <img src="<?php echo e(asset('img/car-seruni.png')); ?>" class="gallery-img" alt="Suasana sejuk">
            </div>
        </div>
    </div>
</section>

<!-- Cultural Significance Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title">Nilai Budaya</h2>
                
                <div class="feature-card">
                    <h4><i class="fas fa-history text-primary me-2"></i> Tempat Sakral</h4>
                    <p>Sendang Seruni bukan hanya tempat wisata biasa, tetapi juga memiliki nilai spiritual bagi masyarakat sekitar. Banyak yang percaya mata air ini memiliki kekuatan magis dan sering digunakan untuk ritual tradisional.</p>
                </div>
                
                <div class="feature-card">
                    <h4><i class="fas fa-leaf text-primary me-2"></i> Harmoni dengan Alam</h4>
                    <p>Keberadaan Sendang Seruni mengajarkan kita untuk menjaga keseimbangan alam. Masyarakat setempat sangat menghormati dan menjaga kelestarian tempat ini.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visitor Info Section -->
<section class="section bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.245608358915!2d114.23987667358757!3d-8.177994381974408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd14e9d1e51e7a9%3A0x15d92ca8e735a808!2sSendang%20Seruni%20(natural%20swimming%20pool)!5e0!3m2!1sid!2sid!4v1754118950787!5m2!1sid!2sid" 
                            style="border:0; border-radius: 8px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title text-start">Informasi Kunjungan</h2>
                
                <div class="mb-4">
                    <h5><i class="fas fa-clock text-primary me-2"></i> Jam Buka</h5>
                    <p>Setiap hari 08:00 - 17:00 WIB</p>
                </div>
                
                <div class="mb-4">
                    <h5><i class="fas fa-ticket-alt text-primary me-2"></i> Tiket Masuk</h5>
                    <p>Rp 15.000 per orang</p>
                </div>
                
                <div class="mb-4">
                    <h5><i class="fas fa-lightbulb text-primary me-2"></i> Tips Berkunjung</h5>
                    <p>Bawa pakaian ganti jika ingin bermain air. Waktu terbaik berkunjung adalah pagi hari saat udara masih sejuk.</p>
                </div>
                
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-info-circle me-2"></i> Panduan Lengkap
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/page/destinations/sendang.blade.php ENDPATH**/ ?>