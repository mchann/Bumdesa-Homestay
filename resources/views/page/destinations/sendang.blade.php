@extends('layouts.app')

@section('title', 'Sendang Seruni')

@section('content')
<div class="container-fluid pt-4 pb-5 px-1">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center">
            <h1 class="text-primary text-uppercase" id="txt-dest-judul" style="letter-spacing: 2px;">
                Sendang Seruni
            </h1>
        </div>

        <!-- Subtitle -->
        <div class="text-center mb-4">
            <h5 class="subtitle-text">
                Discover the tranquil beauty and cultural richness of Sendang Seruni, <br>
                where crystal-clear <strong>natural springs</strong> and <strong>lush greenery</strong> 
                offer a serene escape into nature's embrace.
            </h5>
        </div>

        <!-- Gallery Section -->
        <div class="row g-2 px-1 px-sm-5" id="gallery-dest">
            <!-- Main Image -->
            <div class="col-12 mb-2">
                <a href="https://dewitari.com/storage/img/01JCAWKP1QP6MTWQRF9BWEW66N.webp" 
                   data-sub-html="<h4>Sendang Seruni</h4><p>Discover Sendang Seruni, a serene mountain spring surrounded by lush greenery, offering a tranquil escape and a refreshing retreat for hikers and nature lovers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWKP1QP6MTWQRF9BWEW66N.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Panoramic view of Sendang Seruni">
                </a>
            </div>
            
            <!-- Thumbnail Images -->
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWM37QBEKCWXFG5C312RA8.webp" 
                   data-sub-html="<h4>Sendang Seruni</h4><p>Discover Sendang Seruni, a serene mountain spring surrounded by lush greenery, offering a tranquil escape and a refreshing retreat for hikers and nature lovers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWM37QBEKCWXFG5C312RA8.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Close-up of the natural spring">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWMFCS1H44113EW92C2MH3.webp" 
                   data-sub-html="<h4>Sendang Seruni</h4><p>Discover Sendang Seruni, a serene mountain spring surrounded by lush greenery, offering a tranquil escape and a refreshing retreat for hikers and nature lovers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWMFCS1H44113EW92C2MH3.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Lush greenery surrounding the spring">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWMWQ9FVJPBC7K2GY4RHB3.webp" 
                   data-sub-html="<h4>Sendang Seruni</h4><p>Discover Sendang Seruni, a serene mountain spring surrounded by lush greenery, offering a tranquil escape and a refreshing retreat for hikers and nature lovers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWMWQ9FVJPBC7K2GY4RHB3.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Peaceful atmosphere at Sendang Seruni">
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="mt-4 px-lg-5 mx-lg-5 text-muted">
            <section class="mb-4">
                <h4 class="text-dark">Natural Springs</h4>
                <p>Uncover the hidden gem of Banyuwangi at Sendang Seruni, a tranquil haven known for its crystal-clear natural springs and lush, verdant surroundings. Nestled in the heart of East Java, this serene destination offers a refreshing escape into nature's pure embrace, making it a must-visit spot for those seeking peace and relaxation.</p>
            </section>
            
            <section class="mb-4">
                <h4 class="text-dark">A Sacred Place</h4>
                <p>More than just a beautiful natural site, Sendang Seruni holds deep cultural and spiritual significance for the local community. The spring is revered as a sacred place, steeped in local legends and traditions. Visitors often partake in quiet moments of reflection or local rituals, connecting with the profound cultural heritage of Banyuwangi.</p>
            </section>
            
            <hr>
            
            <p class="lead">Don't miss the opportunity to experience the unique charm of Sendang Seruni. Plan your visit today and immerse yourself in the natural beauty and cultural richness of Banyuwangi's serene oasis. Whether you're seeking adventure or tranquility, Sendang Seruni promises an unforgettable journey into the heart of East Java.</p>
        </div>
    </div>
</div>
@endsection