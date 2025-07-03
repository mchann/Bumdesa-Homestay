@extends('layout.main')

@section('content')
    {{-- Carousel Start --}}
    <div id="myCarousel" class="carousel slide pointer-event" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active bg-dark">
                <img src="{{ asset('img/car-ijen.jpeg') }}" class="d-block w-100" alt="Slide Image" style="opacity: 0.5;">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Ijen Crater</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg-dark">
                <img src="{{ asset('img/car-terakota.jpg') }}" class="d-block w-100" alt="Slide Image" style="opacity: 0.5;">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Taman Gandrung Terakota</h1>
                        <p>Some representative placeholder content for the second slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg-dark">
                <img src="{{ asset('img/car-seruni.png') }}" class="d-block w-100" alt="Slide Image" style="opacity: 0.5;">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Sendang Seruni</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- Carousel End --}}

    {{-- Tour Packages Start --}}
    <div class="container-fluid pt-4 pb-5 px-5">
        <div class="container">
            <div class="text-center mb-3">
                <h3 class="text-primary text-uppercase mb-4" style="letter-spacing: 3px;">Tour Packages</h3>
            </div>

            <div class="row justify-content-center gap-3">
                {{-- Tour Package Card 1 --}}
                <div class="card card-hover col-12 col-lg-5 col-xl-6 pt-1 px-1" style="max-width: 500px">
                    <img class="card-img-top rounded" src="https://dewitari.com/storage/img/01JCAV8BBMJG1NX6XEBGA3H1SJ.webp" alt="Study to Tamansari 1">
                    <div class="card-body">
                        <h4>Study to Tamansari 1</h4>
                        <p class="text-secondary" style="min-height: 75px">Learn to make <strong>traditional food</strong> and explore the wonders of <strong>Seruni tourism</strong>.</p>
                        <hr>
                        <div class="row align-items-center px-2">
                            <div class="col-6">
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Meal 1x</span><br>
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Snack 2x</span><br>
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Merchandise</span><br>
                            </div>
                            <div class="text-center col-6">
                                <p class="price-text mb-1 fw-bold">1 Days</p>
                                <div class="btn-book rounded p-2" style="background-color: #95D2B3">
                                    <span class="price-text fw-bold d-block">Rp 220.000/Pax</span>
                                    <span class="price-text-2 fw-bold text-muted d-block">Min book 20 pax</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tour Package Card 2 --}}
                <div class="card card-hover col-12 col-lg-5 col-xl-6 pt-1 px-1" style="max-width: 500px">
                    <img class="card-img-top rounded" src="https://dewitari.com/storage/img/01JCAV8BBMJG1NX6XEBGA3H1SJ.webp" alt="Study to Tamansari 1">
                    <div class="card-body">
                        <h4>Study to Tamansari 1</h4>
                        <p class="text-secondary" style="min-height: 75px">Learn to make <strong>traditional food</strong> and explore the wonders of <strong>Seruni tourism</strong>.</p>
                        <hr>
                        <div class="row align-items-center px-2">
                            <div class="col-6">
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Meal 1x</span><br>
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Snack 2x</span><br>
                                <span class="fac-text"><i class="fa-solid fa-circle-check fa-lg me-1 me-sm-3 mt-2" style="color: #9ad3ff;"></i>Merchandise</span><br>
                            </div>
                            <div class="text-center col-6">
                                <p class="price-text mb-1 fw-bold">1 Days</p>
                                <div class="btn-book rounded p-2" style="background-color: #95D2B3">
                                    <span class="price-text fw-bold d-block">Rp 220.000/Pax</span>
                                    <span class="price-text-2 fw-bold text-muted d-block">Min book 20 pax</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Tour Packages End --}}

    {{-- Homestays and Villas Start --}}
    <div class="container-fluid py-5 px-5">
        <div class="container pb-5">
            <div class="text-center mb-3">
                <h3 class="text-primary text-uppercase mb-4" style="letter-spacing: 3px;">Homestays & Villas</h3>
            </div>

            <div class="row justify-content-center gap-2">
                {{-- Homestay Card 1 --}}
                <div class="card card-hover col-12 col-sm-6 col-lg-4 border border-2 px-0" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none">
                        <img class="card-img-top" src="{{ asset('img/hv-gabriel.jpg') }}">
                        <div class="card-body mx-3">
                            <h4 class="card-title">Vivi Homestay</h4>
                            <h6 class="m-0 text-secondary"><i class="fa fa-star me-1" style="color: #FFD43B;"></i>4.4<small> (747)</small></h6>
                        </div>
                    </a>
                </div>

                {{-- Homestay Card 2 --}}
                <div class="card card-hover col-12 col-sm-6 col-lg-4 border border-2 px-0" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none">
                        <img class="card-img-top" src="{{ asset('img/hv-gabriel.jpg') }}">
                        <div class="card-body mx-3">
                            <h4 class="card-title">Java Ijen Homestay</h4>
                            <h6 class="m-0 text-secondary"><i class="fa fa-star me-1" style="color: #FFD43B;"></i>4.4<small> (747)</small></h6>
                        </div>
                    </a>
                </div>

                {{-- Homestay Card 3 --}}
                <div class="card card-hover col-12 col-sm-6 col-lg-4 border border-2 px-0" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none">
                        <img class="card-img-top" src="{{ asset('img/hv-gabriel.jpg') }}">
                        <div class="card-body mx-3">
                            <h4 class="card-title">Hadi Homestay</h4>
                            <h6 class="m-0 text-secondary"><i class="fa fa-star me-1" style="color: #FFD43B;"></i>4.4<small> (747)</small></h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Homestays and Villas End --}}
@endsection