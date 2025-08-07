@extends('layouts.app')

@section('content')
<style>
    /* Terracotta Color Scheme */
    :root {
        --primary: #e2725b;
        --primary-light: #ef9a82;
        --primary-dark: #c45a44;
        --secondary: #8d6e63;
        --light: #f5f5f5;
        --dark: #3e2723;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                    url('{{ asset('img/car-terakota.jpg') }}');
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
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
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
    }

    .gallery-img:hover {
        transform: scale(1.02);
    }

    /* Feature Card */
    .feature-card {
        border-left: 4px solid var(--primary);
        background-color: var(--light);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-radius: 0 4px 4px 0;
    }

    /* Map Container */
    .map-container {
        height: 400px;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-section {
            height: 50vh;
        }
        
        .section {
            padding: 2.5rem 0;
        }
        
        .map-container {
            height: 300px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Gandrung Terracotta Park</h1>
                <p class="lead mb-5">Keajaiban Budaya Banyuwangi dalam 1.000 Patung Terakota</p>
                <a href="#about" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-info-circle me-2"></i> Jelajahi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Tentang Gandrung Terracotta Park</h2>
                <p class="lead">Sebuah penghormatan terhadap seni dan budaya Banyuwangi yang abadi.</p>
                
                <div class="feature-card">
                    <p>Gandrung Terracotta Park merupakan taman budaya yang menampilkan 1.000 patung penari Gandrung dari bahan terakota. Setiap patung dibuat dengan detail menakjubkan, menggambarkan gerakan khas tarian Gandrung yang elegan.</p>
                </div>
                
                <p>Taman ini tidak hanya menjadi tempat wisata, tetapi juga pusat pelestarian budaya Gandrung yang merupakan ikon Banyuwangi. Dibangun dengan konsep yang memadukan seni tradisional dan keindahan alam.</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('img/car-terakota.jpg') }}" alt="Gandrung Terracotta Park" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Galeri Taman</h2>
            <p class="lead">Keindahan seni terakota dalam balutan budaya Gandrung</p>
        </div>
        
        <div class="row g-3">
            <div class="col-md-4 col-6">
                <img src="{{ asset('img/car-terakota.jpg') }}" class="gallery-img" alt="Patung Gandrung">
            </div>
            <div class="col-md-4 col-6">
                <img src="{{ asset('img/car-terakota.jpg') }}" class="gallery-img" alt="Tarian Gandrung">
            </div>
            <div class="col-md-4 col-6">
                <img src="{{ asset('img/car-terakota.jpg') }}" class="gallery-img" alt="Landscape Taman">
            </div>
        </div>
    </div>
</section>

<!-- Cultural Significance Section -->
<section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center">Makna Budaya</h2>
                
                <div class="feature-card">
                    <h4>Gandrung Dance</h4>
                    <p>Tarian Gandrung merupakan tarian tradisional khas Banyuwangi yang telah diakui sebagai Warisan Budaya Takbenda Indonesia. Tarian ini melambangkan rasa syukur masyarakat setelah panen.</p>
                </div>
                
                <div class="feature-card">
                    <h4>Terracotta Art</h4>
                    <p>Penggunaan material terakota merupakan penghormatan terhadap tradisi gerabah yang telah ada di Banyuwangi sejak zaman kerajaan. Teknik pembuatan patung mengadaptasi metode tradisional dengan sentuhan modern.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visitor Info Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.266169709527!2d114.25454247358749!3d-8.175918381948778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd14ff63a26e751%3A0x7b57daf8951337c!2sTaman%20Gandrung%20Terakota!5e0!3m2!1sid!2sid!4v1754118583041!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Informasi Pengunjung</h2>
                
                <div class="mb-4">
                    <h5><i class="fas fa-calendar-alt text-primary me-2"></i> Jam Operasional</h5>
                    <p>Setiap hari 08:00 - 17:00 WIB</p>
                </div>
                
                <div class="mb-4">
                    <h5><i class="fas fa-ticket-alt text-primary me-2"></i> Harga Tiket</h5>
                    <p>Rp 20.000 (Dewasa), Rp 10.000 (Anak-anak)</p>
                </div>
                
                <div class="mb-4">
                    <h5><i class="fas fa-clock text-primary me-2"></i> Waktu Terbaik Berkunjung</h5>
                    <p>Pukul 15:00 - 17:00 untuk menikmati pertunjukan tari sore hari</p>
                </div>
                
                <a href="https://maps.google.com/maps?q=Taman+Gandrung+Terakota" 
                   target="_blank" 
                   class="btn btn-primary mt-3">
                    <i class="fas fa-map-marked-alt me-2"></i> Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>
@endsection