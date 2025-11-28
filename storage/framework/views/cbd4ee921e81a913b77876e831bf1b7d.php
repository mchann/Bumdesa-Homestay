<?php $__env->startSection('content'); ?>
<style>
    /* Color Scheme */
    :root {
        --primary: #25D366; /* WhatsApp green */
        --primary-light: #5df08d;
        --primary-dark: #128C7E;
        --secondary: #34B7F1;
        --light: #f1f8e9;
        --dark: #263238;
        --whatsapp: #25D366;
    }

    /* Packages Section */
    .packages-section {
        padding: 4rem 0;
        background-color: #f9f9f9;
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dark);
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

    /* Package Card */
    .package-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        height: 100%;
        background: white;
    }

    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .package-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .package-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .package-price {
        color: var(--dark);
        font-weight: 700;
        font-size: 1.4rem;
    }

    .package-price small {
        font-size: 0.9rem;
        color: #777;
    }

    .package-feature {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: flex-start;
    }

    .package-feature i {
        color: var(--primary);
        margin-right: 10px;
        margin-top: 3px;
        font-size: 1.1rem;
    }

    .whatsapp-btn {
        background-color: var(--whatsapp);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .whatsapp-btn:hover {
        background-color: #128C7E;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }

    .whatsapp-btn i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    .package-duration {
        color: #666;
        font-size: 0.9rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .packages-section {
            padding: 2.5rem 0;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .package-card {
            margin-bottom: 20px;
        }
    }
</style>

<!-- Tour Packages Section -->
<section class="packages-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Paket Wisata Unggulan</h2>
            <p class="lead">Nikmati pengalaman liburan tak terlupakan dengan paket wisata kami</p>
        </div>
        
        <div class="row g-4">
            <!-- Package 1 - Ijen Crater -->
            <div class="col-md-6 col-lg-4">
                <div class="package-card">
                    <div class="position-relative">
                        <img src="<?php echo e(asset('img/car-ijen.jpeg')); ?>" class="package-img" alt="Ijen Crater Tour">
                        <div class="package-badge">Best Seller</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">Paket Kawah Ijen</h5>
                                <p class="package-duration mb-0"><i class="fas fa-clock"></i> 1 Hari</p>
                            </div>
                            <div class="text-end">
                                <span class="package-price">Rp 350K <small>/orang</small></span>
                            </div>
                        </div>
                        
                        <div class="package-features mb-4">
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Trekking ke Kawah Ijen melihat Blue Fire</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Pemandu lokal berpengalaman</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Sarapan dan masker gas</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Transportasi PP dari Banyuwangi</span>
                            </div>
                        </div>
                        
                        <a href="https://wa.me/6283114655334?text=Saya%20tertarik%20untuk%20memesan%20Paket%20Kawah%20Ijen" 
                           class="btn whatsapp-btn w-100">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Package 2 - Gandrung Terracotta -->
            <div class="col-md-6 col-lg-4">
                <div class="package-card">
                    <div class="position-relative">
                        <img src="<?php echo e(asset('img/car-terakota.jpg')); ?>" class="package-img" alt="Gandrung Terracotta Tour">
                        <div class="package-badge">Budaya</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">Paket Gandrung Terracotta</h5>
                                <p class="package-duration mb-0"><i class="fas fa-clock"></i> 1/2 Hari</p>
                            </div>
                            <div class="text-end">
                                <span class="package-price">Rp 250K <small>/orang</small></span>
                            </div>
                        </div>
                        
                        <div class="package-features mb-4">
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Tur budaya dengan pemandu lokal</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Pertunjukan tari Gandrung</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Makan siang tradisional</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Transportasi PP dari hotel</span>
                            </div>
                        </div>
                        
                        <a href="https://wa.me/6283114655334?text=Saya%20tertarik%20untuk%20memesan%20Paket%20Gandrung%20Terracotta" 
                           class="btn whatsapp-btn w-100">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Package 3 - Sendang Seruni -->
            <div class="col-md-6 col-lg-4">
                <div class="package-card">
                    <div class="position-relative">
                        <img src="<?php echo e(asset('img/car-seruni.png')); ?>" class="package-img" alt="Sendang Seruni Tour">
                        <div class="package-badge">Alam</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">Paket Sendang Seruni</h5>
                                <p class="package-duration mb-0"><i class="fas fa-clock"></i> 1 Hari</p>
                            </div>
                            <div class="text-end">
                                <span class="package-price">Rp 200K <small>/orang</small></span>
                            </div>
                        </div>
                        
                        <div class="package-features mb-4">
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Wisata alam ke Sendang Seruni</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Sesi penyegaran dengan air alami</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Minuman herbal tradisional</span>
                            </div>
                            <div class="package-feature">
                                <i class="fas fa-check-circle"></i>
                                <span>Transportasi PP dari Banyuwangi</span>
                            </div>
                        </div>
                        
                        <a href="https://wa.me/6283114655334?text=Saya%20tertarik%20untuk%20memesan%20Paket%20Sendang%20Seruni" 
                           class="btn whatsapp-btn w-100">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <div class="whatsapp-help py-3 px-4 rounded d-inline-block">
                <p class="mb-1"><i class="fab fa-whatsapp text-success me-2"></i> Butuh bantuan memilih paket?</p>
                <a href="https://wa.me/6283114655334" class="btn btn-outline-success">
                    <i class="fab fa-whatsapp me-2"></i> Chat Kami Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/page/packages.blade.php ENDPATH**/ ?>