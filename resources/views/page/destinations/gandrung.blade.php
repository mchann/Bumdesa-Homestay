@extends('layouts.app')

@section('title', 'Gandrung Terracotta Park')

@section('content')
<div class="container-fluid pt-4 pb-5 px-1">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center">
            <h1 class="text-primary text-uppercase" id="txt-dest-judul" style="letter-spacing: 2px;">
                Gandrung Terracotta Park
            </h1>
        </div>

        <!-- Subtitle -->
        <div class="text-center mb-4">
            <h5 class="subtitle-text">
                Enchanting cultural heritage of Banyuwangi <br>
                featuring <strong>1.000 Statues of Gandrung Dancer</strong> and 
                <strong>Live Performance of Gandrung Dance</strong>.
            </h5>
        </div>

        <!-- Gallery Section -->
        <div class="row g-2 px-1 px-sm-5" id="gallery-dest">
            <!-- Main Image -->
            <div class="col-12 mb-2">
                <a href="https://dewitari.com/storage/img/01JCAWH1FQHQCXQ00YWNFJZ8R3.webp" 
                   data-sub-html="<h4>Gandrung Terracotta Park</h4><p>Experience Taman Gandrung Terakota, an enchanting cultural park featuring terracotta statues and traditional Banyuwangi dance performances, providing a captivating glimpse into local heritage.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWH1FQHQCXQ00YWNFJZ8R3.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Gandrung Terracotta Park overview">
                </a>
            </div>
            
            <!-- Thumbnail Images -->
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWHZJ307M6VJM24ZDBE591.webp" 
                   data-sub-html="<h4>Gandrung Terracotta Park</h4><p>Experience Taman Gandrung Terakota, an enchanting cultural park featuring terracotta statues and traditional Banyuwangi dance performances, providing a captivating glimpse into local heritage.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWHZJ307M6VJM24ZDBE591.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Gandrung statues close-up">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWJD5JQENR2SP48AMXGNCF.webp" 
                   data-sub-html="<h4>Gandrung Terracotta Park</h4><p>Experience Taman Gandrung Terakota, an enchanting cultural park featuring terracotta statues and traditional Banyuwangi dance performances, providing a captivating glimpse into local heritage.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWJD5JQENR2SP48AMXGNCF.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Gandrung dance performance">
                </a>
            </div>
            
            <div class="col-md-4 col-6">
                <a href="https://dewitari.com/storage/img/01JCAWJSZ140AXJQXZ9JAR1634.webp" 
                   data-sub-html="<h4>Gandrung Terracotta Park</h4><p>Experience Taman Gandrung Terakota, an enchanting cultural park featuring terracotta statues and traditional Banyuwangi dance performances, providing a captivating glimpse into local heritage.</p>">
                    <img src="https://dewitari.com/storage/img/01JCAWJSZ140AXJQXZ9JAR1634.webp" 
                         class="rounded w-100 img-gallery" 
                         alt="Park landscape with statues">
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="mt-4 px-lg-5 mx-lg-5 text-muted">
            <section class="mb-4">
                <h4 class="text-dark">1.000 Statues of Gandrung Dancer</h4>
                <p>Step into the heart of Banyuwangi's rich cultural heritage at Taman Gandrung Terakota. This captivating park is home to a stunning display of 1,000 statues of Gandrung dancers, each capturing the grace and elegance of this traditional dance form. As you wander through the park, you'll be transported into a world where art and culture come alive in the most beautiful way.</p>
            </section>
            
            <section class="mb-4">
                <h4 class="text-dark">Live Performance of Gandrung Dance</h4>
                <p>At Taman Gandrung Terakota, you can witness the mesmerizing live performances of the Gandrung dance. These performances offer a unique and authentic glimpse into the traditions of Banyuwangi, showcasing the vibrant costumes, intricate movements, and enchanting music that define this beloved dance. It's an experience that will leave you spellbound and deeply connected to the local culture.</p>
            </section>
            
            <section class="mb-4">
                <h4 class="text-dark">Natural Landscapes</h4>
                <p>Set against a backdrop of lush greenery and breathtaking landscapes, the park provides a serene and picturesque environment. Whether you're a culture enthusiast, a photographer, or simply looking for a peaceful retreat, Taman Gandrung Terakota offers a perfect blend of natural beauty and cultural richness.</p>
            </section>
            
            <hr>
            
            <p class="lead">Don't miss the opportunity to immerse yourself in the enchanting world of Gandrung Terracotta Park. Plan your visit today and discover why this unique cultural destination is a must-see for travelers from around the world. Experience the magic of Banyuwangi's heritage and create memories that will last a lifetime.</p>
        </div>
    </div>
</div>
@endsection