<?php $__env->startSection('content'); ?>
    
<div class="container-fluid hero-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('<?php echo e(asset('img/hv-jiwa-jawa.jpg')); ?>'); background-size: cover; background-position: center; min-height: 400px; display: flex; align-items: center; padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
               <!-- Modern Search Card -->
<div class="card rounded-4 shadow-lg border-0 overflow-hidden" style="border-radius: 20px !important;">
    <div class="card-body p-0">
        <!-- Gradient Header Section -->
        <div class="text-white p-4" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="d-flex align-items-center">
                <i class="fas fa-home fa-2x me-3"></i>
                <div>
                    <h4 class="mb-0 fw-bold">Temukan Homestay Terbaik</h4>
                    <p class="mb-0 opacity-75">Temukan pengalaman menginap yang sempurna</p>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="p-4">
            <?php if(isset($homestay) && $homestay): ?>
                <form method="GET" action="<?php echo e(route('homestay.details', ['id' => $homestay->homestay_id])); ?>">
            <?php else: ?>
                <form method="GET" action="<?php echo e(route('homestay.index')); ?>">
            <?php endif; ?>

                <!-- Search Location -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted small">LOKASI</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt text-success"></i></span>
                        <input type="text" class="form-control border-0 py-3" name="search" placeholder="Kota, daerah, atau nama homestay" value="<?php echo e(request()->input('search')); ?>">
                    </div>
                </div>

                <!-- Date and Guest Selection -->
                <div class="row g-3 mb-4">
                    <!-- Check-In Date -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted small">CHECK-IN</label>
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text bg-white border-0"><i class="far fa-calendar-alt text-success"></i></span>
                            <input type="date" class="form-control border-0 py-2" id="checkin-date" name="checkin_date"
                                value="<?php echo e(request()->input('checkin_date', now()->toDateString())); ?>">
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted small">DURASI</label>
                        <select class="form-select shadow-sm border-0 py-2" id="duration" name="duration" style="height: 46px;">
                            <?php $__currentLoopData = [1, 2, 3, 7, 14]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($day); ?>" <?php echo e(request()->input('duration') == $day ? 'selected' : ''); ?>>
                                    <?php echo e($day); ?> Malam
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Check-Out Date -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted small">CHECK-OUT</label>
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text bg-white border-0"><i class="far fa-calendar-check text-success"></i></span>
                            <input type="date" class="form-control border-0 py-2" id="checkout-date" name="checkout_date"
                                value="<?php echo e(request()->input('checkout_date', now()->addDays(1)->toDateString())); ?>">
                        </div>
                    </div>

                    <!-- Guests and Rooms -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted small">TAMU & KAMAR</label>
                        <button type="button" class="form-control text-start shadow-sm rounded-3 p-2 bg-white border-0" 
                                data-bs-toggle="modal" data-bs-target="#guestModal"
                                style="height: 46px;">
                            <span id="guest-summary" class="text-dark">
                                <?php echo e(request()->input('dewasa', 2)); ?> Dewasa,
                                <?php echo e(request()->input('anak', 0)); ?> Anak,
                                <?php echo e(request()->input('kamar', 1)); ?> Kamar
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="d-grid mt-2">
                    <button class="btn rounded-3 py-3 fw-bold shadow" 
                            type="submit"
                            style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                        <i class="fas fa-search me-2"></i>CARI HOMESTAY
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- card -->
            </div>
        </div>
    </div>
</div>

    
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Featured Properties</h2>
            <a href="#" class="btn btn-outline-primary">View All</a>
        </div>
        
        <div class="row g-4">
            <?php $__currentLoopData = $homestays->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $homestay->kamar->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="position-relative">
                                <img class="img-fluid rounded-top" src="<?php echo e(asset('storage/'.$homestay->foto_homestay)); ?>" alt="<?php echo e($homestay->nama_homestay); ?>" style="height: 200px; width: 100%; object-fit: cover;">
                                <?php if($kamar->diskon): ?>
                                    <div class="position-absolute top-0 start-0 p-2 bg-danger text-white fw-bold rounded-end">
                                        Hemat <?php echo e($kamar->diskon); ?>%
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body">
                                <h3 class="h5 card-title mb-2"><?php echo e($homestay->nama_homestay); ?></h3>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-warning small me-1">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($homestay->rating)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif($i == ceil($homestay->rating) && $homestay->rating % 1 != 0): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="text-muted small"><?php echo e($homestay->rating); ?> (<?php echo e($homestay->review_count); ?> ulasan)</span>
                                </div>
                                
                                <p class="card-text mb-3"><?php echo e($kamar->nama_kamar); ?> - Kapasitas: <?php echo e($kamar->kapasitas); ?> orang</p>
                                
                                <?php if($kamar->harga): ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?> / malam</span>
                                        <a href="<?php echo e(route('homestay.details', $homestay->homestay_id)); ?>" class="btn btn-sm btn-primary">Book Now</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    

    
    <div class="container py-5">
        <div class="row">
            
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="h6 mb-3 fw-bold">Filter by</h5>
                        
                        
                        <div class="mb-4">
                            <h6 class="small fw-bold mb-2">Price per night</h6>
                            <div class="range-slider mb-2">
                                <input type="range" class="form-range" min="0" max="1000000" step="50000" id="priceRange">
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span>Rp0</span>
                                <span>Rp1,000,000+</span>
                            </div>
                        </div>
                        
                        
                        <div class="mb-4">
                            <h6 class="small fw-bold mb-2">Guest rating</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="rating5" checked>
                                <label class="form-check-label d-flex align-items-center" for="rating5">
                                    <div class="text-warning small me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>4.5+ (Excellent)</span>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="rating4">
                                <label class="form-check-label d-flex align-items-center" for="rating4">
                                    <div class="text-warning small me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span>3.5+ (Very Good)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rating3">
                                <label class="form-check-label d-flex align-items-center" for="rating3">
                                    <div class="text-warning small me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span>2.5+ (Good)</span>
                                </label>
                            </div>
                        </div>
                        
                        
                        <div class="mb-4">
                            <h6 class="small fw-bold mb-2">Facilities</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="wifi" checked>
                                <label class="form-check-label" for="wifi">
                                    <i class="fas fa-wifi text-muted me-1"></i> Free WiFi
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="pool">
                                <label class="form-check-label" for="pool">
                                    <i class="fas fa-swimming-pool text-muted me-1"></i> Swimming Pool
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="parking">
                                <label class="form-check-label" for="parking">
                                    <i class="fas fa-parking text-muted me-1"></i> Free Parking
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="ac">
                                <label class="form-check-label" for="ac">
                                    <i class="fas fa-snowflake text-muted me-1"></i> Air Conditioning
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="breakfast">
                                <label class="form-check-label" for="breakfast">
                                    <i class="fas fa-utensils text-muted me-1"></i> Breakfast Included
                                </label>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary btn-sm w-100 mt-2">
                            <i class="fas fa-filter me-1"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Our Listings</h1>
                    <div class="sort-options">
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option selected>Sort by: Recommended</option>
                            <option>Price (lowest first)</option>
                            <option>Price (highest first)</option>
                            <option>Top Rated</option>
                            <option>Distance from center</option>
                        </select>
                    </div>
                </div>

                <p class="small text-muted mb-4"><?php echo e(count($homestays)); ?> properti ditemukan</p>

                <div class="row g-4">
                    <?php $__currentLoopData = $homestays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $homestay->kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="position-relative">
                                        <img class="img-fluid rounded-top" src="<?php echo e(asset('storage/'.$homestay->foto_homestay)); ?>" alt="<?php echo e($homestay->nama_homestay); ?>" style="height: 200px; width: 100%; object-fit: cover;">
                                        <?php if($kamar->diskon): ?>
                                            <div class="position-absolute top-0 start-0 p-2 bg-danger text-white fw-bold rounded-end">
                                                Hemat <?php echo e($kamar->diskon); ?>%
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h2 class="h5 card-title mb-2"><?php echo e($homestay->nama_homestay); ?></h2>
                                        <h3 class="h6 card-subtitle mb-2 text-muted"><?php echo e($kamar->nama_kamar); ?></h3>
                                        
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-warning small me-1">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= floor($homestay->rating)): ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php elseif($i == ceil($homestay->rating) && $homestay->rating % 1 != 0): ?>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    <?php else: ?>
                                                        <i class="far fa-star"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </span>
                                            <span class="text-muted small"><?php echo e($homestay->rating); ?> (<?php echo e($homestay->review_count); ?> ulasan)</span>
                                        </div>

                                        <p class="card-text mb-3">Kapasitas: <?php echo e($kamar->kapasitas); ?> orang</p>
                                        
                                        <?php if($kamar->harga): ?>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?> / malam</span>
                                                <a href="<?php echo e(route('homestay.details', $homestay->homestay_id)); ?>" class="btn btn-sm btn-primary">Details</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Client Feedback</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                            </div>
                            <p class="card-text mb-4">"Pelayanan sangat memuaskan! Homestaynya bersih dan nyaman. Akan kembali lagi."</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Client" width="50" height="50">
                                <div>
                                    <h6 class="mb-0">John Doe</h6>
                                    <small class="text-muted">Traveler</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </span>
                            </div>
                            <p class="card-text mb-4">"Lokasi strategis dekat dengan pusat kota. Fasilitas lengkap dan staff sangat ramah."</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Client" width="50" height="50">
                                <div>
                                    <h6 class="mb-0">Jane Smith</h6>
                                    <small class="text-muted">Family Traveler</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                            </div>
                            <p class="card-text mb-4">"Harga sangat terjangkau untuk kualitas yang diberikan. Sangat recommended untuk backpacker."</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Client" width="50" height="50">
                                <div>
                                    <h6 class="mb-0">Robert Johnson</h6>
                                    <small class="text-muted">Backpacker</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="guestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tamu dan Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Dewasa</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="adult-minus">-</button>
                            <input type="number" class="form-control text-center" value="2" min="1" id="adult-count">
                            <button class="btn btn-outline-secondary" type="button" id="adult-plus">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anak-anak (2-12 tahun)</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="child-minus">-</button>
                            <input type="number" class="form-control text-center" value="0" min="0" id="child-count">
                            <button class="btn btn-outline-secondary" type="button" id="child-plus">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="room-minus">-</button>
                            <input type="number" class="form-control text-center" value="1" min="1" id="room-count">
                            <button class="btn btn-outline-secondary" type="button" id="room-plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="save-guest">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .hero-section {
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .btn-outline-primary {
        border-width: 2px;
        font-weight: 500;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .range-slider {
        padding: 0.5rem 0;
    }

    .form-range::-webkit-slider-thumb {
        background: #0d6efd;
    }

    .form-range::-moz-range-thumb {
        background: #0d6efd;
    }

    .form-range::-ms-thumb {
        background: #0d6efd;
    }

    /* New styles for featured section */
    .featured-section {
        background-color: #f8f9fa;
    }

    .client-feedback {
        background-color: #f8f9fa;
    }

    .client-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Price range slider functionality
    document.addEventListener('DOMContentLoaded', function() {
        const priceRange = document.getElementById('priceRange');
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                console.log('Price range selected:', this.value);
            });
        }
        
        // Guest modal functionality
        const adultPlus = document.getElementById('adult-plus');
        const adultMinus = document.getElementById('adult-minus');
        const adultCount = document.getElementById('adult-count');
        
        const childPlus = document.getElementById('child-plus');
        const childMinus = document.getElementById('child-minus');
        const childCount = document.getElementById('child-count');
        
        const roomPlus = document.getElementById('room-plus');
        const roomMinus = document.getElementById('room-minus');
        const roomCount = document.getElementById('room-count');
        
        const guestSummary = document.getElementById('guest-summary');
        const saveGuest = document.getElementById('save-guest');
        
        if (adultPlus && adultMinus) {
            adultPlus.addEventListener('click', () => {
                adultCount.value = parseInt(adultCount.value) + 1;
            });
            
            adultMinus.addEventListener('click', () => {
                if (parseInt(adultCount.value) > 1) {
                    adultCount.value = parseInt(adultCount.value) - 1;
                }
            });
        }
        
        if (childPlus && childMinus) {
            childPlus.addEventListener('click', () => {
                childCount.value = parseInt(childCount.value) + 1;
            });
            
            childMinus.addEventListener('click', () => {
                if (parseInt(childCount.value) > 0) {
                    childCount.value = parseInt(childCount.value) - 1;
                }
            });
        }
        
        if (roomPlus && roomMinus) {
            roomPlus.addEventListener('click', () => {
                roomCount.value = parseInt(roomCount.value) + 1;
            });
            
            roomMinus.addEventListener('click', () => {
                if (parseInt(roomCount.value) > 1) {
                    roomCount.value = parseInt(roomCount.value) - 1;
                }
            });
        }
        
        if (saveGuest && guestSummary) {
            saveGuest.addEventListener('click', () => {
                const adults = adultCount.value;
                const children = childCount.value;
                const rooms = roomCount.value;
                
                let summary = `${adults} Dewasa`;
                if (children > 0) summary += `, ${children} Anak`;
                summary += `, ${rooms} Kamar`;
                
                guestSummary.textContent = summary;
                $('#guestModal').modal('hide');
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/page/homestays.blade.php ENDPATH**/ ?>