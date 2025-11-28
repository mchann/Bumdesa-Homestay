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
</div> 
            </div>
        </div>
    </div>
</div>


    
    <div class="container py-5">
        <div class="section-header mb-4">
            <h2 class="fw-bold mb-2">Featured Properties</h2>
            <p class="text-muted">Curated selections for your perfect stay</p>
        </div>
        
        <div class="row g-4">
            <?php $__currentLoopData = $homestays->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $homestay->kamar->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card property-card border-0 shadow-sm h-100">
                            <div class="position-relative property-image-container">
                                <img class="img-fluid property-image" src="<?php echo e(asset('storage/'.$homestay->foto_homestay)); ?>" alt="<?php echo e($homestay->nama_homestay); ?>">
                                <?php if($kamar->diskon): ?>
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <span class="badge discount-badge">Save <?php echo e($kamar->diskon); ?>%</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body">
                                <h3 class="h6 card-title mb-2 fw-bold text-dark"><?php echo e($homestay->nama_homestay); ?></h3>
                                <p class="card-text mb-2 text-muted small"><?php echo e($kamar->nama_kamar); ?></p>
                                
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
                                    <span class="text-muted small ms-1"><?php echo e($homestay->rating); ?> (<?php echo e($homestay->review_count); ?> reviews)</span>
                                </div>
                                
                                <p class="card-text mb-3 small text-muted">Capacity: <?php echo e($kamar->kapasitas); ?> person<?php echo e($kamar->kapasitas > 1 ? 's' : ''); ?></p>
                                
                                <?php if($kamar->harga): ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold text-dark">Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?></span>
                                            <span class="text-muted small d-block">per night</span>
                                        </div>
                                        <a href="<?php echo e(route('homestay.details', $homestay->homestay_id)); ?>" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="container-fluid background-section py-5" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo e(asset('img/dialog.jpg')); ?>');">
        <div class="container">
            <div class="row justify-content-center text-center text-white">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-3">Why Choose Our Homestays?</h2>
                    <p class="mb-4 lead">Experience the perfect blend of comfort, convenience, and authentic local living</p>
                    
                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-shield-alt fa-2x mb-3"></i>
                                <h5>Verified Properties</h5>
                                <p class="small">All homestays are carefully verified for quality and safety</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-headset fa-2x mb-3"></i>
                                <h5>24/7 Support</h5>
                                <p class="small">Round-the-clock customer support for all your needs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-tag fa-2x mb-3"></i>
                                <h5>Best Price Guarantee</h5>
                                <p class="small">Get the best rates with our price match guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1">Available Homestays</h1>
                <p class="text-muted small"><?php echo e(count($homestays)); ?> properties found in your search area</p>
            </div>
            <div class="sort-options">
                <select class="form-select form-select-sm border-0 shadow-sm">
                    <option selected>Sort by: Recommended</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Highest Rated</option>
                    <option>Most Reviewed</option>
                </select>
            </div>
        </div>

       <div class="row g-4">
    <?php $__currentLoopData = $homestays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homestay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $homestay->kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-md-6 col-lg-4">
                <div class="card property-card border-0 shadow-sm h-100">
                    <div class="position-relative property-image-container">
                        <img class="img-fluid property-image" src="<?php echo e(asset('storage/'.$homestay->foto_homestay)); ?>" alt="<?php echo e($homestay->nama_homestay); ?>">
                        <?php if($kamar->diskon): ?>
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge discount-badge">Save <?php echo e($kamar->diskon); ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h2 class="h6 card-title mb-0 fw-bold text-dark"><?php echo e($homestay->nama_homestay); ?></h2>
                            <div class="property-rating text-end">
                                <?php
                                    // Ambil data rating dari ulasan real
                                    $reviews = $homestay->ulasans()
                                        ->where('disembunyikan', false)
                                        ->get();
                                    
                                    $averageRating = $reviews->count() > 0 ? $reviews->avg('rating') : 0;
                                    $reviewCount = $reviews->count();
                                ?>
                                
                                <span class="text-warning small">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= floor($averageRating)): ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif($i == ceil($averageRating) && $averageRating % 1 != 0): ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </span>
                                <div class="text-muted small">
                                    <?php if($reviewCount > 0): ?>
                                        <?php echo e(number_format($averageRating, 1)); ?> (<?php echo e($reviewCount); ?>)
                                    <?php else: ?>
                                        No reviews
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <h3 class="h6 card-subtitle mb-2 text-muted"><?php echo e($kamar->nama_kamar); ?></h3>
                        
                        <p class="card-text mb-3 small text-muted">Capacity: <?php echo e($kamar->kapasitas); ?> person<?php echo e($kamar->kapasitas > 1 ? 's' : ''); ?></p>
                        
                        <?php if($kamar->harga): ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <?php if($kamar->diskon): ?>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="text-danger text-decoration-line-through small">
                                                Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?>

                                            </span>
                                            <span class="fw-bold text-dark">
                                                Rp <?php echo e(number_format($kamar->harga - ($kamar->harga * $kamar->diskon / 100), 0, ',', '.')); ?>

                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="fw-bold text-dark">Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?></span>
                                    <?php endif; ?>
                                    <span class="text-muted small d-block">per night</span>
                                    <?php if($kamar->diskon): ?>
                                        <span class="text-success small">Including taxes & fees</span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo e(route('homestay.details', $homestay->homestay_id)); ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
        
        
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
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

   
<?php
    // Ambil data ulasan terbaru dari database sesuai dengan controller Ulasan
    $testimonials = App\Models\Ulasan::with(['pelanggan', 'homestay'])
        ->whereHas('pemesanan', function($query) {
            $query->where('status', 'selesai'); // Hanya ulasan dari pemesanan yang selesai
        })
        ->whereNotNull('komentar')
        ->where('komentar', '!=', '')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();
?>

<div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">What Our Guests Say</h2>
            <p class="text-muted">Real experiences from travelers like you</p>
        </div>
        
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <span class="text-warning">
                                
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($i <= $testimonial->rating): ?>
                                        <i class="fas fa-star"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <small class="text-muted ms-1">(<?php echo e($testimonial->rating); ?>/5)</small>
                            </span>
                        </div>
                        <p class="card-text mb-4">
                            "<?php echo e($testimonial->komentar); ?>"
                        </p>
                        <div class="d-flex align-items-center justify-content-center">
                            
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0"><?php echo e($testimonial->pelanggan->name ?? 'Guest'); ?></h6>
                                <small class="text-muted">
                                    <?php if($testimonial->homestay): ?>
                                        Stayed at <?php echo e($testimonial->homestay->nama_homestay); ?>

                                    <?php else: ?>
                                        Traveler
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <div class="col-md-4">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <span class="text-warning">
                                
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <small class="text-muted ms-1">(5/5)</small>
                            </span>
                        </div>
                        <p class="card-text mb-4">"Excellent service! The homestay was clean and comfortable. Will definitely return."</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0">John Doe</h6>
                                <small class="text-muted">Traveler</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <span class="text-warning">
                                
                                <?php for($i = 1; $i <= 4; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <i class="fas fa-star-half-alt"></i>
                                <small class="text-muted ms-1">(4.5/5)</small>
                            </span>
                        </div>
                        <p class="card-text mb-4">"Strategic location close to the city center. Complete facilities and very friendly staff."</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0">Jane Smith</h6>
                                <small class="text-muted">Family Traveler</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <span class="text-warning">
                                
                                <?php for($i = 1; $i <= 4; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <i class="far fa-star"></i>
                                <small class="text-muted ms-1">(4/5)</small>
                            </span>
                        </div>
                        <p class="card-text mb-4">"Very affordable price for the quality provided. Highly recommended for backpackers."</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0">Robert Johnson</h6>
                                <small class="text-muted">Backpacker</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <?php if($testimonials->count() > 0): ?>
        <div class="text-center mt-5">
            <a href="<?php echo e(route('testimonials.all')); ?>" class="btn btn-outline-success">
                <i class="fas fa-comments me-2"></i> View All Testimonials
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="fw-bold mb-3">Stay Updated</h2>
                <p class="text-muted mb-4">Subscribe to our newsletter for exclusive deals and travel tips</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Your email address">
                    <button class="btn btn-primary px-4" type="button">Subscribe</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="guestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Guests and Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Adults</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="adult-minus">-</button>
                            <input type="number" class="form-control text-center" value="2" min="1" id="adult-count">
                            <button class="btn btn-outline-secondary" type="button" id="adult-plus">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Children (2-12 years)</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="child-minus">-</button>
                            <input type="number" class="form-control text-center" value="0" min="0" id="child-count">
                            <button class="btn btn-outline-secondary" type="button" id="child-plus">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rooms</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="room-minus">-</button>
                            <input type="number" class="form-control text-center" value="1" min="1" id="room-count">
                            <button class="btn btn-outline-secondary" type="button" id="room-plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-guest">Save</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Hero Section */
    .hero-section {
        background-size: cover;
        background-position: center;
        min-height: 400px;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    /* Search Card */
    .search-card {
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .search-input-group {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .search-input-group:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .search-input-group .form-control {
        border: none;
        box-shadow: none;
    }

    .search-input-group .input-group-text {
        border: none;
        background: white;
    }

    .search-btn {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .guest-select-btn {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: white;
        transition: all 0.3s ease;
    }

    .guest-select-btn:hover {
        border-color: #0d6efd;
    }

    /* Property Cards */
    .property-card {
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .property-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .property-image-container {
        overflow: hidden;
    }

    .property-image {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .property-card:hover .property-image {
        transform: scale(1.05);
    }

    .discount-badge {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }

    /* Background Section */
    .background-section {
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    .background-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    }

    .background-section .container {
        position: relative;
        z-index: 2;
    }

    .feature-item {
        padding: 2rem 1rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    /* Testimonials */
    .testimonial-card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #495057;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 300px;
            padding: 40px 0;
        }
        
        .search-card .row {
            flex-direction: column;
        }
        
        .search-card .col-md-2,
        .search-card .col-md-4 {
            width: 100%;
            margin-bottom: 1rem;
        }
        
        .background-section {
            background-attachment: scroll;
        }
    }

    /* Button Styles */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-outline-primary {
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        transform: translateY(-1px);
    }

    /* Text Colors */
    .text-dark {
        color: #2c3e50 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    /* Card Body Padding */
    .card-body {
        padding: 1.25rem;
    }

    /* Section Headers */
    .section-header h2 {
        color: #2c3e50;
        font-weight: 600;
    }

    /* Form Controls */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                
                let summary = `${adults} Adult${adults > 1 ? 's' : ''}`;
                if (children > 0) summary += `, ${children} Child${children > 1 ? 'ren' : ''}`;
                summary += `, ${rooms} Room${rooms > 1 ? 's' : ''}`;
                
                guestSummary.textContent = summary;
                $('#guestModal').modal('hide');
            });
        }
        
        // Date calculation for check-in and check-out
        const checkinDate = document.getElementById('checkin-date');
        const checkoutDate = document.getElementById('checkout-date');
        
        if (checkinDate && checkoutDate) {
            checkinDate.addEventListener('change', function() {
                const checkin = new Date(this.value);
                const checkout = new Date(checkin);
                checkout.setDate(checkin.getDate() + 1);
                checkoutDate.value = checkout.toISOString().split('T')[0];
            });
        }

        // Add smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add loading animation for images
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/page/homestays.blade.php ENDPATH**/ ?>