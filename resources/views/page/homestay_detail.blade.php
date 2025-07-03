@extends('layout.main')

{{-- @section('title, 'home') --}}

@section('content')
<title>Tamansari | {{ $title ?? 'Default Title' }}</title>

<div class="bg-light pt-4 pb-5">
  <div class="container-lg">

    {{-- === HERO SECTION ========================================== --}}
    <div class="row g-3 align-items-start mb-5" data-aos="fade-down">
      {{-- Main image gallery --}}
      <div class="col-xl-9 col-lg-8">
        <div class="row g-2">
          <div class="col-8">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm border">
              <img src="{{ asset('storage/' . $homestay->foto_homestay) }}" class="w-100 h-100 object-fit-cover" id="mainImage">
            </div>
          </div>
          <div class="col-4 d-flex flex-column gap-2">
            @php
              $allImages = [$homestay->foto_homestay];
              foreach($homestay->kamar as $kamar) {
                  if($kamar->foto_kamar) $allImages[] = $kamar->foto_kamar;
              }
              $allImages = array_slice($allImages, 0, 4);
            @endphp
            
            @foreach($allImages as $index => $image)
              <div class="ratio ratio-4x3 rounded-4 overflow-hidden cursor-pointer gallery-thumb border {{ $index === 0 ? 'active-thumb border-success border-2' : '' }}">
                <img src="{{ asset('storage/' . $image) }}" 
                     class="w-100 h-100 object-fit-cover"
                     onclick="document.getElementById('mainImage').src = this.src">
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Action buttons --}}
      <div class="col-xl-3 col-lg-4">
        <div class="d-flex gap-2 mb-3" data-aos="zoom-in">
          <button class="btn btn-light border flex-grow-1 d-flex align-items-center justify-content-center">
            <i class="bi bi-share-fill me-2"></i> Share
          </button>
          <button class="btn btn-light border d-flex align-items-center justify-content-center" style="width: 44px">
            <i class="bi bi-bookmark"></i>
          </button>
        </div>
        
        {{-- Quick info box --}}
        <div class="bg-white rounded-4 p-3 shadow-sm border" data-aos="fade-left">
          <div class="d-flex align-items-center mb-3">
            <div class="bg-warning bg-opacity-10 rounded-3 p-2 me-3">
              <i class="bi bi-star-fill text-warning"></i>
            </div>
            <div>
              <div class="fw-bold">4.8 (120 reviews)</div>
              <div class="small text-muted">Excellent</div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
              <i class="bi bi-geo-alt-fill text-success"></i>
            </div>
            <div>
              <div class="fw-bold">Location</div>
              <div class="small text-muted">{{ Str::limit($homestay->alamat_homestay, 30) }}</div>
            </div>
          </div>
        </div>

        {{-- Price box --}}
        <div class="bg-white rounded-4 p-3 shadow-sm border mt-3">
          <div class="text-end mb-2">
            <span class="text-decoration-line-through text-muted small me-2">Rp 1.200.000</span>
            <span class="badge bg-danger">20% OFF</span>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted">Starting from</span>
            <span class="fs-4 fw-bold text-success">Rp {{ number_format($homestay->kamar->min('harga'),0,',','.') }}</span>
          </div>
          <small class="text-muted d-block mb-3">per night (including tax)</small>
          <a href="#availability" class="btn btn-success w-100 py-2 fw-bold">
            <i class="bi bi-calendar-check me-2"></i> Book Now
          </a>
        </div>
      </div>
    </div>

    {{-- === MAIN CONTENT ========================================== --}}
    <div class="row g-4">
      {{-- Left content --}}
      <div class="col-lg-8">
        {{-- Title and description --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-right">
          <div class="card-header bg-light">
            <h2 class="fw-bold mb-0">{{ $homestay->nama_homestay }}</h2>
          </div>
          <div class="card-body">
            <div class="text-muted mb-4">
              {!! nl2br(e($homestay->deskripsi ?: 'Description not available.')) !!}
            </div>
            
            <h5 class="fw-semibold mb-3 d-flex align-items-center">
              <i class="bi bi-list-check text-success me-2"></i> Featured Facilities
            </h5>
            <div class="d-flex flex-wrap gap-2">
              @foreach($homestay->fasilitas as $f)
                <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2 border">
                  @php
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
                  @endphp
                  <i class="bi bi-{{ $icon }} text-success me-2"></i>
                  <span class="small">{{ $f->nama_fasilitas }}</span>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        {{-- Room availability form --}}
        @if(isset($homestay) && $homestay)
        <form method="GET" action="{{ route('homestay.details', ['id' => $homestay->homestay_id]) }}">
        @endif

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
                            <input type="date" name="check_in" class="form-control" value="{{ $checkIn ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-1 fw-semibold">Check-out</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="check_out" class="form-control" value="{{ $checkOut ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small mb-1 fw-semibold">Adults</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="number" name="dewasa" min="1" value="{{ $dewasa ?? 2 }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small mb-1 fw-semibold">Children</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="number" name="anak" min="0" value="{{ $anak ?? 0 }}" class="form-control">
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

        {{-- Room list --}}
        <div class="mb-5" data-aos="fade-up">
            <h4 class="fw-semibold mb-4 d-flex align-items-center">
                <i class="bi bi-door-open text-success me-2"></i> Room Options
            </h4>
            
            @if(count($kamarGrouped) === 0)
                <div class="alert alert-warning">
                    No rooms available for your search criteria
                </div>
            @endif

            @foreach($kamarGrouped as $jenis => $kamarList)
                @php
                    $firstKamar = $kamarList->first();
                    $stok = $kamarList->count();
                @endphp

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3 room-card">
                    <div class="row g-0">
                        <div class="col-md-4 position-relative">
                            @if($firstKamar->foto_kamar)
                                <img src="{{ asset('storage/'.$firstKamar->foto_kamar) }}" class="w-100 h-100 object-fit-cover" style="min-height: 220px">
                            @else
                                <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 220px">
                                    <i class="bi bi-image text-muted" style="font-size: 2rem"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                               @if($firstKamar->status == 'tersedia')
                                <span class="badge bg-success">Available ({{ $stok }})</span>
                                @else
                                <span class="bagde bg-danger">Not Available</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-3 h-100 d-flex flex-column">
                             
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="fw-bold">
                                        {{ $firstKamar->nama_kamar }}
                                        <span class="badge bg-light text-dark border ms-2">{{ $firstKamar->jenis_kamar }}</span>
                                    </h5>
                                    <div class="text-end">
                                        <div class="text-decoration-line-through small text-muted">Rp {{ number_format($firstKamar->harga * 1.2,0,',','.') }}</div>
                                        <div class="text-success fw-bold fs-5">Rp {{ number_format($firstKamar->harga,0,',','.') }}<span class="fs-6">/night</span></div>
                                    </div>
                                </div>

                                <div class="d-flex gap-4 mb-3 small text-muted">
                                    <div><i class="bi bi-people-fill text-success me-1"></i> {{ $firstKamar->kapasitas ?? 2 }} persons</div>
                                    <div><i class="bi bi-door-open text-success me-1"></i> {{ $firstKamar->tipe_tempat_tidur ?? 'Double Bed' }}</div>
                                    @if($firstKamar->ukuran_kamar)
                                        <div><i class="bi bi-arrows-angle-expand text-success me-1"></i> {{ $firstKamar->ukuran_kamar }} m²</div>
                                    @endif
                                </div>

                                @if($firstKamar->deskripsi_kamar)
                                    <p class="text-muted small flex-grow-1">{{ $firstKamar->deskripsi_kamar }}</p>
                                @endif

                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <div class="text-muted small mb-1">*Price excluding tax</div>
                                        <div class="d-flex gap-2">
                                            @php
                                                $facilities = [];
                                                $deskripsi = strtolower($firstKamar->deskripsi_kamar ?? '');
                                                
                                                if(str_contains($deskripsi, 'ac')) $facilities[] = 'ac';
                                                if(str_contains($deskripsi, 'wifi')) $facilities[] = 'wifi';
                                                if(str_contains($deskripsi, 'televisi') || str_contains($deskripsi, 'tv')) $facilities[] = 'tv';
                                                if(str_contains($deskripsi, 'kamar mandi') || str_contains($deskripsi, 'shower')) $facilities[] = 'shower';
                                                if(str_contains($deskripsi, 'breakfast') || str_contains($deskripsi, 'sarapan')) $facilities[] = 'breakfast';
                                            @endphp

                                            @foreach($facilities as $facility)
                                                @php
                                                    $icon = match($facility) {
                                                        'ac' => 'snow',
                                                        'wifi' => 'wifi',
                                                        'tv' => 'tv',
                                                        'shower' => 'droplet',
                                                        'breakfast' => 'cup-hot',
                                                        default => 'check'
                                                    };
                                                @endphp
                                                <span class="badge bg-light text-dark border small d-flex align-items-center">
                                                    <i class="bi bi-{{ $icon }} text-success me-1"></i>{{ ucfirst($facility) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a href="{{ route('pelanggan.pemesanan.create', [
    'homestay_id' => $homestay->homestay_id,
    'kamar_id' => $firstKamar->kamar_id,
    'check_in' => request('check_in'),
    'check_out' => request('check_out'),
    'dewasa' => request('dewasa'),
    'anak' => request('anak')
]) }}" 
class="btn btn-success rounded-pill px-4">
    <i class="bi bi-cart-plus me-1"></i> Book
</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- === REVIEWS SECTION ========================================== --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-chat-square-text text-success me-2"></i> Guest Reviews
            </h4>
          </div>
          <div class="card-body">
            <div class="row text-center mb-4">
              <div class="col">
                <div class="display-5 fw-bold text-success">4.8</div>
                <div class="small text-muted">Overall Rating</div>
                <div class="mt-2">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-half text-warning"></i>
                </div>
              </div>
              <div class="col border-start">
                <div class="fw-bold">5.0</div>
                <div class="small text-muted">Cleanliness</div>
                <div class="progress mt-2" style="height: 6px;">
                  <div class="progress-bar bg-success" style="width: 100%"></div>
                </div>
              </div>
              <div class="col border-start">
                <div class="fw-bold">4.9</div>
                <div class="small text-muted">Comfort</div>
                <div class="progress mt-2" style="height: 6px;">
                  <div class="progress-bar bg-success" style="width: 98%"></div>
                </div>
              </div>
              <div class="col border-start">
                <div class="fw-bold">4.7</div>
                <div class="small text-muted">Location</div>
                <div class="progress mt-2" style="height: 6px;">
                  <div class="progress-bar bg-success" style="width: 94%"></div>
                </div>
              </div>
            </div>
            
            <div class="row mt-4">
              @foreach([
                ['rating' => 5, 'title' => 'Amazing experience', 'comment' => 'The homestay was extremely clean and comfortable.', 'author' => 'Fitriani Salim'],
                ['rating' => 5, 'title' => 'Will definitely come back', 'comment' => 'Location was perfect and host was very helpful.', 'author' => 'Rizki Agung Wicaksono'],
                ['rating' => 4, 'title' => 'Highly recommend', 'comment' => 'Beautiful scenery and very cozy place to stay.', 'author' => 'Dwi Cahyo Kusuma']
              ] as $review)
              <div class="col-md-4 mb-3">
                <div class="border rounded-4 p-3 h-100">
                  <div class="d-flex align-items-center mb-2">
                    <div class="me-2">
                      @for($i = 0; $i < 5; $i++)
                        @if($i < $review['rating'])
                          <i class="bi bi-star-fill text-warning"></i>
                        @else
                          <i class="bi bi-star text-warning"></i>
                        @endif
                      @endfor
                    </div>
                    <span class="fw-bold">{{ $review['title'] }}</span>
                  </div>
                  <p class="small mb-2 text-muted">{{ $review['comment'] }}</p>
                  <div class="small text-muted d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                      <i class="bi bi-person text-success"></i>
                    </div>
                    {{ $review['author'] }}
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            
            <div class="text-center mt-4">
              <a href="#" class="btn btn-outline-success">
                <i class="bi bi-chat-left-text me-2"></i> View All Reviews
              </a>
            </div>
          </div>
        </div>

        {{-- === LOCATION DETAILS ========================================== --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-geo-alt text-success me-2"></i> Location & Surroundings
            </h4>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-geo-alt-fill me-2 text-success"></i>
              <span class="fw-medium">{{ $homestay->alamat_homestay ?? 'Not provided' }}</span>
            </div>
            
            @if ($homestay->link_google_maps)
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm mb-3">
              <iframe src="https://maps.google.com/maps?q={{ urlencode($homestay->alamat_homestay) }}&output=embed" 
                      style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
            <a href="{{ $homestay->link_google_maps }}" target="_blank" class="btn btn-outline-success mb-4">
              <i class="bi bi-map me-1"></i> Open in Google Maps
            </a>
            
            <div class="row">
              <div class="col-md-6">
                <h6 class="fw-semibold d-flex align-items-center mb-3">
                  <i class="bi bi-camera text-success me-2"></i> Nearby Attractions
                </h6>
                <ul class="list-unstyled small">
                  @foreach([
                    ['name' => 'Taman Nasional Gunung Leuser', 'distance' => '5.4 km'],
                    ['name' => 'Air Terjun Sikulikap', 'distance' => '3.2 km'],
                    ['name' => 'City Center', 'distance' => '1.8 km']
                  ] as $attraction)
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-geo text-muted me-2"></i>
                    <div>
                      <div>{{ $attraction['name'] }}</div>
                      <div class="text-muted">{{ $attraction['distance'] }}</div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              
              <div class="col-md-6">
                <h6 class="fw-semibold d-flex align-items-center mb-3">
                  <i class="bi bi-cup-hot text-success me-2"></i> Restaurants & Cafes
                </h6>
                <ul class="list-unstyled small">
                  @foreach([
                    ['name' => 'Warung Kopi Sedap', 'distance' => '0.8 km'],
                    ['name' => 'Resto Padang Raya', 'distance' => '1.2 km'],
                    ['name' => 'RM Sederhana', 'distance' => '2.1 km']
                  ] as $restaurant)
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-geo text-muted me-2"></i>
                    <div>
                      <div>{{ $restaurant['name'] }}</div>
                      <div class="text-muted">{{ $restaurant['distance'] }}</div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @else
            <div class="alert alert-warning">
              Location map not available
            </div>
            @endif
          </div>
        </div>

        {{-- === FACILITIES LIST ========================================== --}}
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
                  @foreach(['Wi-Fi', 'Parking area', '24-hour security'] as $facility)
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    {{ $facility }}
                  </li>
                  @endforeach
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
                  @foreach(['Private bathroom', 'Air conditioning', 'TV'] as $facility)
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    {{ $facility }}
                  </li>
                  @endforeach
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
                  @foreach(['Daily cleaning', 'Drinks available'] as $facility)
                  <li class="mb-2 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    {{ $facility }}
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        {{-- === ACCOMMODATION RULES ========================================== --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
          <div class="card-header bg-light">
            <h4 class="fw-semibold mb-0 d-flex align-items-center">
              <i class="bi bi-clipboard-check text-success me-2"></i> Homestay Rules
            </h4>
          </div>
          <div class="card-body">
            <div class="row g-3">
              @foreach([
                ['icon' => 'clock', 'color' => 'success', 'title' => 'Check-in/Check-out', 
                 'content' => 'Check-in from 14:00<br>Check-out before 12:00'],
                ['icon' => 'card-text', 'color' => 'info', 'title' => 'Required Documents', 
                 'content' => 'Guests must show ID card/driver license/passport at check-in.'],
                ['icon' => 'x-circle', 'color' => 'danger', 'title' => 'Cancellation & Refund', 
                 'content' => 'Cancellation policy follows homestay terms.']
              ] as $rule)
              <div class="col-md-4">
                <div class="rule-card h-100">
                  <div class="rule-icon bg-{{ $rule['color'] }} text-white">
                    <i class="bi bi-{{ $rule['icon'] }}"></i>
                  </div>
                  <h6 class="fw-semibold">{{ $rule['title'] }}</h6>
                  <div class="small text-muted">{!! $rule['content'] !!}</div>
                </div>
              </div>
              @endforeach
            </div>
            
            <div class="row g-3 mt-3">
              @foreach([
                ['icon' => 'smoking-ban', 'color' => 'warning', 'title' => 'Smoking', 
                 'content' => 'Smoking is prohibited in all accommodation areas.'],
                ['icon' => 'paw', 'color' => 'secondary', 'title' => 'Pets', 
                 'content' => 'Pets are not allowed.'],
                ['icon' => 'people', 'color' => 'success', 'title' => 'Parties/Events', 
                 'content' => 'Parties or events are not allowed.']
              ] as $rule)
              <div class="col-md-4">
                <div class="rule-card h-100">
                  <div class="rule-icon bg-{{ $rule['color'] }} text-white">
                    <i class="bi bi-{{ $rule['icon'] }}"></i>
                  </div>
                  <h6 class="fw-semibold">{{ $rule['title'] }}</h6>
                  <div class="small text-muted">{!! $rule['content'] !!}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>

      </div>
      
      {{-- Right sidebar --}}
      <div class="col-lg-4">
        {{-- Contact host --}}
<div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px;">
    <div class="card-header bg-light">
        <h5 class="fw-semibold mb-0 d-flex align-items-center">
            <i class="bi bi-person-lines-fill text-success me-2"></i> Contact Owner
        </h5>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="position-relative me-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($homestay->pemilik->nama_pemilik ?? 'Owner') }}&background=random" 
                     class="rounded-circle" width="50" height="50" alt="Owner profile picture">
                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-2 border-white"></span>
            </div>
            <div>
                <div class="fw-bold">{{ $homestay->pemilik->nama_pemilik ?? 'Homestay Owner' }}</div>
                <div class="small text-muted">Owner since {{ date('Y') - 2 }}</div>
            </div>
        </div>
        
        <div class="d-flex flex-column gap-2">
            @php
                // 1. Format nomor WhatsApp (pastikan tanpa +, 0, atau spasi)
                $whatsappNumber = $homestay->pemilik->no_telepon ?? '+62 857-3821-1550';
                $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                
                // 2. Konversi nomor 0xxx ke 62xxx
                if (strlen($cleanNumber) > 0 && $cleanNumber[0] === '0') {
                    $cleanNumber = '62' . substr($cleanNumber, 1);
                }
                
                // 3. Siapkan pesan dengan encoding khusus
                $homestayName = $homestay->nama_homestay ?? 'Homestay';
                $whatsappMessage = rawurlencode("Halo, saya tertarik memesan " . $homestayName . ". Bisakah memberikan informasi tentang ketersediaan?");
                
                // 4. Buat link WhatsApp dengan parameter yang benar
                $whatsappLink = "https://api.whatsapp.com/send?phone=$cleanNumber&text=$whatsappMessage";
            @endphp
            
            <!-- Tampilkan link debug (opsional) -->
            <!-- <div class="small text-muted mb-2">Debug: {{ $whatsappLink }}</div> -->
            
            <a href="{{ $whatsappLink }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="btn btn-success d-flex align-items-center justify-content-center py-2">
                <i class="bi bi-whatsapp me-2"></i> WhatsApp Owner
            </a>
            
            <a href="tel:{{ $whatsappNumber }}" 
               class="btn btn-outline-success d-flex align-items-center justify-content-center py-2">
                <i class="bi bi-telephone me-2"></i> Call Owner
            </a>
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
        
        {{-- Safety info --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-light">
           
          </div>
        </div>
      </div>
    </div>

    {{-- CTA --}}
    <div class="text-center mt-5 pt-4" data-aos="zoom-in">
      <div class="cta-wrapper bg-success p-5 rounded-4 shadow position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0 opacity-10">
          <i class="bi bi-house-heart" style="font-size: 10rem"></i>
        </div>
        <h4 class="fw-bold mb-3 text-white position-relative">Ready to Stay at {{ $homestay->nama_homestay }}?</h4>
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
@endsection