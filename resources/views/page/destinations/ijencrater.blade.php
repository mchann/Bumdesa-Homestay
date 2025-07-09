@extends('layouts.app')

@section('title', 'Ijen Crater')

@section('content')
<div class="container-fluid pt-4 pb-5 px-1">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center">
            <h1 class="text-primary text-uppercase" id="txt-dest-judul" style="letter-spacing: 2px;">Ijen Crater</h1>
        </div>

        <!-- Subtitle -->
        <div class="text-center mb-4">
            <h5 class="subtitle-text">
                Experience the breathtaking <strong>Blue Flames</strong> and <strong>Tosca Lake of Ijen</strong>, 
                East Java's hidden gem, <br> where adventure meets nature's raw beauty.
            </h5>
        </div>

        <!-- Gallery Section -->
        <div class="row g-2 px-1 px-sm-5" id="gallery-dest">
            <!-- Main Image -->
            <div class="col-12 mb-2">
                <a href="https://dewitari.com/storage/img/01JCAWD4TKQ3D4W2A9NHEQET53.webp" 
                   data-sub-html="<h4>Tosca Lake of Ijen</h4><p>Explore Tosca Lake in Ijen Crater, where stunning turquoise waters set amidst volcanic landscapes create a breathtaking adventure for nature enthusiasts.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWD4TKQ3D4W2A9NHEQET53.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Tosca Lake of Ijen">
                </a>
            </div>
            
            <!-- Thumbnail Images -->
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWDMAR62WFHMFM631R26J2.webp" 
                   data-sub-html="<h4>Tosca Lake of Ijen</h4><p>Explore Tosca Lake in Ijen Crater, where stunning turquoise waters set amidst volcanic landscapes create a breathtaking adventure for nature enthusiasts.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWDMAR62WFHMFM631R26J2.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Tosca Lake view">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWECSDRHRT0S855PZZ41C7.webp" 
                   data-sub-html="<h4>Blue Fire</h4><p>Witness the rare and captivating blue flames of Ijen, a natural wonder caused by igniting sulfur gases, offering a truly unique and otherworldly experience for adventurers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWECSDRHRT0S855PZZ41C7.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Blue Fire at Ijen">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWEWJDTSX5VTNXT7PVNDWV.webp" 
                   data-sub-html="<h4>Blue Fire</h4><p>Witness the rare and captivating blue flames of Ijen, a natural wonder caused by igniting sulfur gases, offering a truly unique and otherworldly experience for adventurers.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWEWJDTSX5VTNXT7PVNDWV.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Blue Fire close-up">
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="mt-4 px-lg-5 mx-lg-5 text-muted">
            <section class="mb-4">
                <h4 class="text-dark">Blue Flame</h4>
                <p>Immerse yourself in the awe-inspiring beauty of Ijen Crater, a destination like no other in East Java, Indonesia. Known for its mesmerizing blue flames that dance in the night, Ijen offers a once-in-a-lifetime experience for those seeking adventure and natural splendor.</p>
            </section>
            
            <section class="mb-4">
                <h4 class="text-dark">Tosca Lake</h4>
                <p>Embark on a thrilling hike to the crater's edge, where you'll be rewarded with the sight of the world's largest highly acidic crater lake, a stunning turquoise gem set against the rugged volcanic landscape. Witness the incredible sight of sulfur miners at work, extracting vibrant yellow sulfur amidst billowing clouds of volcanic gas.</p>
            </section>
            
            <section class="mb-4">
                <h4 class="text-dark">Sunrise over Ijen</h4>
                <p>As dawn breaks, the views from Ijen are nothing short of spectacular. The sunrise paints the sky in hues of pink and orange, casting a magical glow over the serene lake and surrounding peaks. Whether you're an avid adventurer, a nature enthusiast, or a photographer looking for that perfect shot, Ijen Crater promises an unforgettable journey into the heart of nature's raw beauty.</p>
            </section>
            
            <hr>
            
            <p class="lead">Join us at Ijen Crater and create memories that will last a lifetime. Book your adventure now and discover why this hidden gem of East Java is a must-visit destination for travelers from around the world.</p>
        </div>
    </div>
</div>
@endsection