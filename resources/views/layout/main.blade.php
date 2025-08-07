<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tamansari | @yield('title', 'Default')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/logo-tamansari.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Google Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- AOS (Animate On Scroll) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Animate.css --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card-hover:hover {
            background-color: #EEEEEE;
            box-shadow: 0px 0px 6px 8px rgba(0, 0, 0, 0.3);
            transform: scale(1.01);
            transition: 0.3s;
        }
        .card-hover:hover img {
            transform: scale(1.08);
            transition: 0.5s;
        }
        .nav-item:hover {
            background-color: green;
            transition: background-color 0.3s;
        }
        .nav-active {
            border-bottom: 3px solid green;
        }
        .btn-floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .btn-wa-hover:hover {
            box-shadow: 0px 0px 6px 8px rgba(0, 160, 61, 0.3);
            transform: scale(1.1);
            transition: 0.3s;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('component.navbar')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('component.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            once: true,
            duration: 1000
        });
    </script>
</body>

</html>