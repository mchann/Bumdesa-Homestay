@extends('layout.main')

@section('content')
<style>
    /* Green Color Scheme - Natural Tone */
    :root {
        --primary: #388e3c;
        --primary-light: #66bb6a;
        --primary-dark: #2e7d32;
        --secondary: #a5d6a7;
        --light: #f1f8e9;
        --dark: #263238;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('{{ asset('img/car-ijen.jpeg') }}');
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
        font-size: 2rem;
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
        width: 50px;
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

    /* History Box */
    .history-box {
        background-color: var(--light);
        border-left: 4px solid var(--primary);
        padding: 1.5rem;
        margin: 2rem 0;
    }

    /* Feature Icons */
    .feature-icon {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
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
                <h1 class="display-4 fw-bold mb-4">IJEN CRATER</h1>
                <p class="lead mb-5">Keajaiban Alam dengan Blue Fire yang Legendaris</p>
                <a href="#history" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-book me-2"></i> Pelajari Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section id="history" class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center">Sejarah Kawah Ijen</h2>
                
                <div class="history-box">
                    <p>Kawah Ijen telah menjadi bagian penting dari sejarah geologi Jawa Timur selama ribuan tahun. Gunung berapi aktif ini terbentuk melalui proses vulkanik yang panjang, menciptakan kaldera seluas 134 kilometer persegi.</p>
                    
                    <p>Pada masa kolonial Belanda tahun 1800-an, Kawah Ijen mulai dikenal sebagai sumber belerang terbesar di Jawa. Para penambang tradisional telah bekerja di sini secara turun-temurun, mengumpulkan belerang dengan cara tradisional yang berbahaya.</p>
                    
                    <p>Fenomena blue fire pertama kali didokumentasikan secara ilmiah pada tahun 1968 oleh seorang vulkanolog Perancis, meskipun masyarakat lokal telah mengetahui keajaiban ini selama berabad-abad.</p>
                </div>
                
                <p>Kawah Ijen kini menjadi salah satu destinasi wisata vulkanik terpenting di Indonesia, menarik para peneliti dan wisatawan dari seluruh dunia untuk menyaksikan fenomena alam yang langka ini.</p>
            </div>
        </div>
    </div>
</section>

<!-- Unique Features Section -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Keunikan Kawah Ijen</h2>
            <p class="lead">Fenomena alam yang tidak ditemukan di tempat lain</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h4>Blue Fire</h4>
                    <p>Salah satu dari dua fenomena api biru alami di dunia, disebabkan oleh pembakaran gas sulfur pada suhu tinggi.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h4>Danau Asam</h4>
                    <p>Danau kawah asam terbesar di dunia dengan diameter 1 km dan kedalaman 200 meter, dengan pH 0.5.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <h4>Penambang Belerang</h4>
                    <p>Tradisi penambangan belerang manual yang telah berlangsung turun-temurun sejak zaman kolonial.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Single Attraction Section -->
<section class="section bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('img/car-ijen.jpeg') }}" alt="Kawah Ijen" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Pengalaman Mendaki</h2>
                <p>Pendakian ke Kawah Ijen dimulai dari Pos Paltuding dengan ketinggian 1.850 mdpl. Perjalanan sejauh 3 km dengan kemiringan 30-45 derajat membutuhkan waktu sekitar 1.5-2 jam.</p>
                <p>Puncak pendakian akan memberikan pemandangan sunrise yang spektakuler dan pemandangan danau kawah yang memukau. Untuk melihat blue fire, pendaki harus memulai pendakian pada dini hari sekitar pukul 2 pagi.</p>
                <a href="#" class="btn btn-primary mt-3">
                    <i class="fas fa-info-circle me-2"></i> Panduan Pendakian
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Conservation Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Konservasi & Pelestarian</h2>
                <p>Kawah Ijen merupakan kawasan yang dilindungi karena nilai geologis dan ekologisnya. Pengunjung diharapkan:</p>
                
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="feature-icon">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <p>Tidak membuang sampah sembarangan</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-icon">
                            <i class="fas fa-mask"></i>
                        </div>
                        <p>Menggunakan masker gas saat mendekati kawah</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <p>Menghormati para penambang lokal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection