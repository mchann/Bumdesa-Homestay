@extends('layout.main')

@section('content')
    {{-- Expeditions Packets start --}}
    <div class="container-fluid pt-4 pb-5 px-5">
        <div class="container">
            {{-- Teks --}}
            <div class="text-center mb-3">
                <h3 class="text-primary text-uppercase mb-4" style="letter-spacing: 3px;">Destinations</h3>
            </div>

            <div class="row justify-content-center gap-3">

                <div class="card card-hover col-12 col-sm-6 col-lg-4 pt-1 px-1" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none;">
                        <img class="card-img-top" src="{{ asset('img/card-package-01.png') }}">
                        <div class="card-body">
                            <h5>Package 1</h5>
                            <p class="text-secondary">Trip to Ijen Crater</p>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                1</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                2</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                3</span> <br>
                        </div>
                    </a>
                </div>

                <div class="card card-hover col-12 col-sm-6 col-lg-4 pt-1 px-1" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none;">
                        <img class="card-img-top rounded" src="{{ asset('img/card-package-01.png') }}">
                        <div class="card-body">
                            <h5>Package 1</h5>
                            <p class="text-secondary">Trip to Ijen Crater</p>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                1</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                2</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                3</span> <br>
                        </div>
                    </a>
                </div>

                <div class="card card-hover col-12 col-sm-6 col-lg-4 pt-1 px-1" style="max-width: 350px">
                    <a href="" target="_blank" class="text-dark" style="text-decoration: none;">
                        <img class="card-img-top rounded" src="{{ asset('img/card-package-01.png') }}">
                        <div class="card-body">
                            <h5>Package 1</h5>
                            <p class="text-secondary">Trip to Ijen Crater</p>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                1</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                2</span> <br>
                            <span><i class="fa-solid fa-check fa-xl me-3 mt-3" style="color: #77dd77;"></i>Fasilitas
                                3</span> <br>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    {{-- Expeditions Packets end --}}
@endsection
