



<?php $__env->startSection('content'); ?>
<title>Tamansari | <?php echo e($title ?? 'Default Title'); ?></title>

<div class="bg-light pt-4 pb-5">
  <div class="container-lg">

    <div class="row g-3 align-items-start mb-5" data-aos="fade-down">
  
  <div class="col-xl-8 col-lg-7">
    
    <div id="homestayCarousel" class="carousel slide rounded-4 overflow-hidden shadow-sm border mb-2" data-bs-ride="carousel">
      <div class="carousel-inner ratio ratio-16x9">
        <?php
          $allImages = [$homestay->foto_homestay];
          foreach($homestay->kamar as $kamar) {
            if($kamar->foto_kamar) $allImages[] = $kamar->foto_kamar;
          }
          $allImages = array_slice($allImages, 0, 8);
        ?>
        
        <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
            <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                class="d-block w-100 h-100 object-fit-cover"
                alt="Homestay image <?php echo e($index + 1); ?>">
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#homestayCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#homestayCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
    
    
    <div class="row g-2">
      <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-3">
          <div class="ratio ratio-4x3 rounded-3 overflow-hidden cursor-pointer border <?php echo e($index === 0 ? 'border-success border-2' : 'border-light'); ?>"
              data-bs-target="#homestayCarousel" data-bs-slide-to="<?php echo e($index); ?>">
            <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                class="w-100 h-100 object-fit-cover"
                alt="Thumbnail <?php echo e($index + 1); ?>">
          </div>
           
          
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  
  <div class="col-xl-4 col-lg-5">
    
    <div class="d-flex gap-2 mb-3" data-aos="zoom-in">
      <button class="btn btn-outline-secondary flex-grow-1 py-2">
        <i class="bi bi-share-fill me-2"></i> Share
      </button>
      <button class="btn btn-outline-secondary py-2 px-3">
        <i class="bi bi-bookmark"></i>
      </button>
    </div>
    
    
    <div class="bg-white rounded-4 p-3 shadow-sm border mb-3" data-aos="fade-left">
      <div class="d-flex align-items-center mb-3">
        <div class="bg-warning bg-opacity-10 rounded-3 p-2 me-3">
          <i class="bi bi-star-fill text-warning"></i>
        </div>
        <div>
          <div class="fw-bold mb-1">4.8 <span class="text-muted">(120 reviews)</span></div>
          <div class="text-success small">Excellent</div>
        </div>
      </div>
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
          <i class="bi bi-geo-alt-fill text-success"></i>
        </div>
        <div>
          <div class="fw-bold mb-1">Location</div>
          <div class="small text-muted"><?php echo e(Str::limit($homestay->alamat_homestay, 30)); ?></div>
        </div>
      </div>
    </div>

    
    <div class="bg-white rounded-4 p-3 shadow-sm border">
      <div class="text-end mb-2">
        <span class="text-decoration-line-through text-muted small me-2">Rp 1.200.000</span>
        <span class="badge bg-danger small">20% OFF</span>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="text-muted small">Starting from</span>
        <span class="fs-5 fw-bold text-success">Rp <?php echo e(number_format($homestay->kamar->min('harga'),0,',','.')); ?></span>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small">per night</span>
        <span class="badge bg-primary small">-</span>
      </div>
      <a href="#availability" class="btn btn-success w-100 py-2">
        <i class="bi bi-calendar-check me-2"></i> Book Now
      </a>
    </div>
  </div>
</div>

    
    <div class="row g-4">
      
      <div class="col-lg-8">
        
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-right">
          <div class="card-header bg-light">
            <h2 class="fw-bold mb-0"><?php echo e($homestay->nama_homestay); ?></h2>
          </div>
          <div class="card-body">
            <div class="text-muted mb-4">
              <?php echo nl2br(e($homestay->deskripsi ?: 'Description not available.')); ?>

            </div>
            
            <h5 class="fw-semibold mb-3 d-flex align-items-center">
              <i class="bi bi-list-check text-success me-2"></i> Featured Facilities
            </h5>
            <div class="d-flex flex-wrap gap-2">
              <?php $__currentLoopData = $homestay->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2 border">
                  <?php
                    $icon = match(true) {
                      str_contains(strtolower($f->nama_fasilitas), 'wifi') => 'wifi',
                      str_contains(strtolower($f->nama_fasilitas), 'parkir') => 'parking',
                      str_contains(strtolower($f->nama_fasilitas), 'ac') => 'snow',
                      str_contains(strtolower($f->nama_fasilitas), 'kolam') => 'water',
                      str_contains(strtolower($f->nama_fasilitas), 'restoran') => 'cup-hot',
                      str_contains(strtolower($f->nama_fasilitas), 'tv') => 'tv',
                      str_contains(strtolower($f->nama_fasilitas), 'kamar mandi') => 'droplet',
                      str_contains(strtolower($f->nama_fasilitas), 'sarapan') => 'egg-fried',
                      default => 'check-circle'
                    };
                  ?>
                  <i class="bi bi-<?php echo e($icon); ?> text-success me-2"></i>
                  <span class="small"><?php echo e($f->nama_fasilitas); ?></span>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>

        
        <?php if(isset($homestay) && $homestay): ?>
        <form method="GET" action="<?php echo e(route('homestay.details', ['id' => $homestay->homestay_id])); ?>">
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" id="availability" data-aos="fade-up">
            <div class="card-header bg-light">
                <h5 class="fw-semibold mb-0 d-flex align-items-center">
                    <i class="bi bi-calendar-date text-success me-2"></i> Check Room Availability
                </h5>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label class="form-label small mb-1 fw-semibold">Check-in</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="check_in" class="form-control" value="<?php echo e($checkIn ?? ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-1 fw-semibold">Check-out</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="check_out" class="form-control" value="<?php echo e($checkOut ?? ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small mb-1 fw-semibold">Adults</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="number" name="dewasa" min="1" value="<?php echo e($dewasa ?? 2); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small mb-1 fw-semibold">Children</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="number" name="anak" min="0" value="<?php echo e($anak ?? 0); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-success w-100 py-3 fw-bold">
                            <i class="bi bi-search me-2"></i> Check Availability
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>

        
<div class="mb-5" data-aos="fade-up">
    <h4 class="fw-semibold mb-4 d-flex align-items-center">
        <i class="bi bi-door-open text-success me-2"></i> Room Options
    </h4>

    <?php
        use Carbon\Carbon;
        $checkIn = request('check_in') ? Carbon::parse(request('check_in')) : null;
        $checkOut = request('check_out') ? Carbon::parse(request('check_out')) : null;
    ?>

    <?php if(count($kamarGrouped) === 0): ?>
        <div class="alert alert-warning">
            No rooms available for your search criteria
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $kamarGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => $kamarList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $kamarList = $kamarList->filter(function ($kamar) use ($checkIn, $checkOut) {
                foreach ($kamar->roomClose as $penutupan) {
                    $start = Carbon::parse($penutupan->start_date);
                    $end = Carbon::parse($penutupan->end_date);
                    if ($checkIn && $checkOut && $checkIn->lte($end) && $checkOut->gte($start)) {
                        return false; // kamar sedang ditutup
                    }
                }
                return true;
            });

            if ($kamarList->isEmpty()) continue;

            $firstKamar = $kamarList->first();
            $stok = $kamarList->count();
        ?>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3 room-card">
            <div class="row g-0">
                <div class="col-md-4 position-relative">
                    <?php if($firstKamar->foto_kamar): ?>
                        <img src="<?php echo e(asset('storage/'.$firstKamar->foto_kamar)); ?>" class="w-100 h-100 object-fit-cover" style="min-height: 220px">
                    <?php else: ?>
                        <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 220px">
                            <i class="bi bi-image text-muted" style="font-size: 2rem"></i>
                        </div>
                    <?php endif; ?>
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge <?php echo e($firstKamar->status == 'tersedia' ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($firstKamar->status == 'tersedia' ? 'Available' : 'Not Available'); ?> (<?php echo e($stok); ?>)
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="p-3 h-100 d-flex flex-column">

                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="fw-bold">
                                <?php echo e($firstKamar->nama_kamar); ?>

                                <span class="badge bg-light text-dark border ms-2"><?php echo e($firstKamar->jenis_kamar); ?></span>
                            </h5>
                            <div class="text-end">
                                <div class="text-decoration-line-through small text-muted">Rp <?php echo e(number_format($firstKamar->harga * 1.2,0,',','.')); ?></div>
                                <div class="text-success fw-bold fs-5">Rp <?php echo e(number_format($firstKamar->harga,0,',','.')); ?><span class="fs-6">/night</span></div>
                            </div>
                        </div>

                        <div class="d-flex gap-4 mb-3 small text-muted">
                            <div><i class="bi bi-people-fill text-success me-1"></i> <?php echo e($firstKamar->kapasitas ?? 2); ?> persons</div>
                            <div><i class="bi bi-door-open text-success me-1"></i> <?php echo e($firstKamar->tipe_tempat_tidur ?? 'Double Bed'); ?></div>
                            <?php if($firstKamar->ukuran_kamar): ?>
                                <div><i class="bi bi-arrows-angle-expand text-success me-1"></i> <?php echo e($firstKamar->ukuran_kamar); ?> m²</div>
                            <?php endif; ?>
                        </div>

                        <?php if($firstKamar->deskripsi_kamar): ?>
                            <p class="text-muted small flex-grow-1"><?php echo e($firstKamar->deskripsi_kamar); ?></p>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <div class="text-muted small mb-1">*Price excluding tax</div>
                                <div class="d-flex gap-2">
                                    <?php
                                        $facilities = [];
                                        $deskripsi = strtolower($firstKamar->deskripsi_kamar ?? '');

                                        if(str_contains($deskripsi, 'ac')) $facilities[] = 'ac';
                                        if(str_contains($deskripsi, 'wifi')) $facilities[] = 'wifi';
                                        if(str_contains($deskripsi, 'televisi') || str_contains($deskripsi, 'tv')) $facilities[] = 'tv';
                                        if(str_contains($deskripsi, 'kamar mandi') || str_contains($deskripsi, 'shower')) $facilities[] = 'shower';
                                        if(str_contains($deskripsi, 'breakfast') || str_contains($deskripsi, 'sarapan')) $facilities[] = 'breakfast';
                                    ?>

                                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $icon = match($facility) {
                                                'ac' => 'snow',
                                                'wifi' => 'wifi',
                                                'tv' => 'tv',
                                                'shower' => 'droplet',
                                                'breakfast' => 'cup-hot',
                                                default => 'check'
                                            };
                                        ?>
                                        <span class="badge bg-light text-dark border small d-flex align-items-center">
                                            <i class="bi bi-<?php echo e($icon); ?> text-success me-1"></i><?php echo e(ucfirst($facility)); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <a href="<?php echo e(route('pelanggan.pemesanan.create', [
                                'homestay_id' => $homestay->homestay_id,
                                'kamar_id' => $firstKamar->kamar_id,
                                'check_in' => request('check_in'),
                                'check_out' => request('check_out'),
                                'dewasa' => request('dewasa'),
                                'anak' => request('anak')
                            ])); ?>" 
                            class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-cart-plus me-1"></i> Book
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

       
<?php
    // Gunakan accessor yang sudah ada di model
    $averageRating = $homestay->rating_rata_rata;
    $totalReviews = $homestay->jumlah_ulasan;
    
    // Ambil ulasan terbaru untuk ditampilkan
    $recentReviews = $homestay->ulasans()
        ->with('pelanggan')
        ->where('disembunyikan', false)
        ->whereNotNull('komentar')
        ->where('komentar', '!=', '')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
?>

<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
    <div class="card-header bg-light">
        <h4 class="fw-semibold mb-0 d-flex align-items-center">
            <i class="fas fa-comments text-success me-2"></i> Ulasan Tamu
            <?php if($totalReviews > 0): ?>
                <span class="badge bg-success ms-2"><?php echo e($totalReviews); ?></span>
            <?php endif; ?>
        </h4>
    </div>
    <div class="card-body">
        <?php if($totalReviews > 0): ?>
            <!-- Overall Rating -->
            <div class="text-center mb-4 p-4 bg-light rounded-3">
                <div class="display-4 fw-bold text-success mb-2"><?php echo e(number_format($averageRating, 1)); ?>/5.0</div>
                <div class="mb-3">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php if($i <= $averageRating): ?>
                            <i class="fas fa-star text-warning fa-lg"></i>
                        <?php elseif($i - 0.5 <= $averageRating): ?>
                            <i class="fas fa-star-half-alt text-warning fa-lg"></i>
                        <?php else: ?>
                            <i class="far fa-star text-warning fa-lg"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div class="text-muted">Berdasarkan <?php echo e($totalReviews); ?> ulasan tamu</div>
            </div>

            <!-- Recent Reviews -->
            <div class="row">
                <?php $__currentLoopData = $recentReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-3">
                    <div class="border rounded-3 p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-user text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-medium text-dark"><?php echo e($review->pelanggan->name ?? 'Tamu'); ?></div>
                                    <small class="text-muted"><?php echo e($review->created_at->format('d M Y')); ?></small>
                                </div>
                            </div>
                            <div class="text-warning">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($i <= $review->rating): ?>
                                        <i class="fas fa-star"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p class="text-muted mb-0 mt-2">
                            "<?php echo e($review->komentar); ?>"
                        </p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($totalReviews > 3): ?>
            <div class="text-center mt-4">
                <a href="<?php echo e(route('homestay.reviews', $homestay->homestay_id)); ?>" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-arrow-down me-2"></i> Tampilkan Lebih Banyak Ulasan
                </a>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum Ada Ulasan</h5>
                <p class="text-muted">Jadilah yang pertama berbagi pengalaman menginap Anda</p>
            </div>
        <?php endif; ?>
    </div>
</div>

        
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-geo-alt text-success me-2"></i> Location & Surroundings
            </h4>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-geo-alt-fill me-2 text-success"></i>
              <span class="fw-medium"><?php echo e($homestay->alamat_homestay ?? 'Not provided'); ?></span>
            </div>
            
            <?php if($homestay->link_google_maps): ?>
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm mb-3">
              <iframe src="https://maps.google.com/maps?q=<?php echo e(urlencode($homestay->alamat_homestay)); ?>&output=embed" 
                      style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
            <a href="<?php echo e($homestay->link_google_maps); ?>" target="_blank" class="btn btn-outline-success mb-4">
              <i class="bi bi-map me-1"></i> Open in Google Maps
            </a>
            
            <div class="row">
              <div class="col-md-6">
                <h6 class="fw-semibold d-flex align-items-center mb-3">
                  <i class="bi bi-camera text-success me-2"></i> Nearby Attractions
                </h6>
                <ul class="list-unstyled small">
                  <?php $__currentLoopData = [
                    ['name' => 'Taman Nasional Gunung Leuser', 'distance' => '5.4 km'],
                    ['name' => 'Air Terjun Sikulikap', 'distance' => '3.2 km'],
                    ['name' => 'City Center', 'distance' => '1.8 km']
                  ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attraction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-geo text-muted me-2"></i>
                    <div>
                      <div><?php echo e($attraction['name']); ?></div>
                      <div class="text-muted"><?php echo e($attraction['distance']); ?></div>
                    </div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              
              <div class="col-md-6">
                <h6 class="fw-semibold d-flex align-items-center mb-3">
                  <i class="bi bi-cup-hot text-success me-2"></i> Restaurants & Cafes
                </h6>
                <ul class="list-unstyled small">
                  <?php $__currentLoopData = [
                    ['name' => 'Warung Kopi Sedap', 'distance' => '0.8 km'],
                    ['name' => 'Resto Padang Raya', 'distance' => '1.2 km'],
                    ['name' => 'RM Sederhana', 'distance' => '2.1 km']
                  ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-geo text-muted me-2"></i>
                    <div>
                      <div><?php echo e($restaurant['name']); ?></div>
                      <div class="text-muted"><?php echo e($restaurant['distance']); ?></div>
                    </div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
            <?php else: ?>
            <div class="alert alert-warning">
              Location map not available
            </div>
            <?php endif; ?>
          </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-house-check text-success me-2"></i> Homestay Facilities
            </h4>
          </div>
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-md-4 p-4 border-end">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-success bg-opacity-10 p-2 rounded-3 me-2">
                    <i class="bi bi-wifi text-success"></i>
                  </div>
                  <h6 class="fw-semibold mb-0">General Facilities</h6>
                </div>
                <ul class="list-unstyled small facility-list">
                  <?php $__currentLoopData = ['Wi-Fi', 'Parking area', '24-hour security']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <?php echo e($facility); ?>

                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              
              <div class="col-md-4 p-4 border-end">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-info bg-opacity-10 p-2 rounded-3 me-2">
                    <i class="bi bi-door-closed text-info"></i>
                  </div>
                  <h6 class="fw-semibold mb-0">Room Facilities</h6>
                </div>
                <ul class="list-unstyled small facility-list">
                  <?php $__currentLoopData = ['Private bathroom', 'Air conditioning', 'TV']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <?php echo e($facility); ?>

                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              
              <div class="col-md-4 p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-2">
                    <i class="bi bi-three-dots text-warning"></i>
                  </div>
                  <h6 class="fw-semibold mb-0">Other Facilities</h6>
                </div>
                <ul class="list-unstyled small facility-list">
                  <?php $__currentLoopData = ['Daily cleaning', 'Drinks available']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <?php echo e($facility); ?>

                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-clipboard-check text-success me-2"></i> Homestay Rules
            </h4>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <?php $__currentLoopData = [
                ['icon' => 'clock', 'color' => 'success', 'title' => 'Check-in/Check-out', 
                 'content' => 'Check-in from 14:00<br>Check-out before 12:00'],
                ['icon' => 'card-text', 'color' => 'info', 'title' => 'Required Documents', 
                 'content' => 'Guests must show ID card/driver license/passport at check-in.'],
                ['icon' => 'x-circle', 'color' => 'danger', 'title' => 'Cancellation & Refund', 
                 'content' => 'Cancellation policy follows homestay terms.']
              ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
                <div class="rule-card h-100">
                  <div class="rule-icon bg-<?php echo e($rule['color']); ?> text-white">
                    <i class="bi bi-<?php echo e($rule['icon']); ?>"></i>
                  </div>
                  <h6 class="fw-semibold"><?php echo e($rule['title']); ?></h6>
                  <div class="small text-muted"><?php echo $rule['content']; ?></div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="row g-3 mt-3">
              <?php $__currentLoopData = [
                ['icon' => 'smoking-ban', 'color' => 'warning', 'title' => 'Smoking', 
                 'content' => 'Smoking is prohibited in all accommodation areas.'],
                ['icon' => 'paw', 'color' => 'secondary', 'title' => 'Pets', 
                 'content' => 'Pets are not allowed.'],
                ['icon' => 'people', 'color' => 'success', 'title' => 'Parties/Events', 
                 'content' => 'Parties or events are not allowed.']
              ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
                <div class="rule-card h-100">
                  <div class="rule-icon bg-<?php echo e($rule['color']); ?> text-white">
                    <i class="bi bi-<?php echo e($rule['icon']); ?>"></i>
                  </div>
                  <h6 class="fw-semibold"><?php echo e($rule['title']); ?></h6>
                  <div class="small text-muted"><?php echo $rule['content']; ?></div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>

      </div>
      
      
      <div class="col-lg-4">
        
<div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px;">
    <div class="card-header bg-light">
        <h5 class="fw-semibold mb-0 d-flex align-items-center">
            <i class="bi bi-person-lines-fill text-success me-2"></i> Contact Owner
        </h5>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="position-relative me-3">
                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($homestay->pemilikProfile->nama_lengkap ?? 'Owner')); ?>&background=random" 
                     class="rounded-circle" width="50" height="50" alt="Owner profile picture">
                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-2 border-white"></span>
            </div>
            <div>
                <div class="fw-bold"><?php echo e($homestay->pemilikProfile->nama_lengkap ?? 'Homestay Owner'); ?></div>
                <div class="small text-muted">Owner since <?php echo e(date('Y') - 2); ?></div>
            </div>
        </div>

        <?php
            $nomorTelepon = $homestay->pemilikProfile->nomor_telepon ?? null;

            if ($nomorTelepon) {
                // Bersihkan nomor telepon dari karakter non-angka
                $cleanNumber = preg_replace('/[^0-9]/', '', $nomorTelepon);

                // Ubah 08xxxx menjadi 628xxxx
                if (Str::startsWith($cleanNumber, '0')) {
                    $cleanNumber = '62' . substr($cleanNumber, 1);
                }

                // Siapkan pesan WhatsApp
                $homestayName = $homestay->nama_homestay ?? 'Homestay';
                $whatsappMessage = rawurlencode("Halo, saya tertarik memesan " . $homestayName . ". Bisakah memberikan informasi tentang ketersediaan?");
                $whatsappLink = "https://api.whatsapp.com/send?phone=$cleanNumber&text=$whatsappMessage";
            }
        ?>

        <div class="d-flex flex-column gap-2">
            <?php if($nomorTelepon): ?>
                <a href="<?php echo e($whatsappLink); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="btn btn-success d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-whatsapp me-2"></i> WhatsApp Owner
                </a>

                <a href="tel:<?php echo e($cleanNumber); ?>" 
                   class="btn btn-outline-success d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-telephone me-2"></i> Call Owner
                </a>
            <?php else: ?>
                <div class="alert alert-warning small">Nomor telepon pemilik belum tersedia.</div>
            <?php endif; ?>
        </div>

        <hr class="my-3">

        <div class="small text-muted">
            <div class="d-flex mb-2">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                <span>Quick response - usually within 1 hour</span>
            </div>
            <div class="d-flex">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                <span>90% of guests recommend</span>
            </div>
        </div>
    </div>
</div>
        
        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-light">
           
          </div>
        </div>
      </div>
    </div>

    
    <div class="text-center mt-5 pt-4" data-aos="zoom-in">
      <div class="cta-wrapper bg-success p-5 rounded-4 shadow position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0 opacity-10">
          <i class="bi bi-house-heart" style="font-size: 10rem"></i>
        </div>
        <h4 class="fw-bold mb-3 text-white position-relative">Ready to Stay at <?php echo e($homestay->nama_homestay); ?>?</h4>
        <p class="text-white-50 mb-4 position-relative">Book now for an unforgettable stay experience</p>
        <a href="#" class="btn btn-light px-5 py-3 fw-bold rounded-pill btn-hover position-relative">
          <i class="bi bi-calendar-check me-2"></i> Book Now
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  /* General Styles */
  body {
    scroll-behavior: smooth;
  }
  
  /* Image Gallery */
  .gallery-thumb {
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }
  
  .gallery-thumb:hover {
    border-color: var(--bs-success);
    transform: scale(1.02);
  }
  
  .active-thumb {
    border-color: var(--bs-success) !important;
  }
  
  .cursor-pointer {
    cursor: pointer;
  }
  
  /* Room Cards */
  .room-card {
    transition: all 0.3s ease;
  }
  
  .room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  
  /* Facilities List */
  .facility-list li {
    padding: 6px 0;
    border-bottom: 1px dashed #eee;
  }
  
  /* Rules Section */
  .rule-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border: 1px solid #eee;
  }
  
  .rule-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }
  
  .rule-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    font-size: 1.25rem;
  }
  
  /* CTA Section */
  .cta-wrapper {
    max-width: 800px;
    margin: 0 auto;
    background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
  }
  
  .btn-hover {
    transition: all 0.3s ease;
  }
  
  .btn-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }
  
  /* Animation */
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }
  
  .btn-hover:hover {
    animation: pulse 1.5s infinite;
  }
</style>

<script>
  // Simple script to handle image gallery thumbnails
  document.querySelectorAll('.gallery-thumb img').forEach(img => {
    img.addEventListener('click', function() {
      document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        thumb.classList.remove('active-thumb', 'border-success', 'border-2');
      });
      this.parentElement.classList.add('active-thumb', 'border-success', 'border-2');
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/page/homestay_detail.blade.php ENDPATH**/ ?>