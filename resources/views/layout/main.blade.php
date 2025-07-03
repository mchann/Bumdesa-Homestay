<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tamansari | @yield('title', 'Default')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/logo-tamansari.png') }}" type="image/x-icon">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- Google Web Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    {{-- Customized Bootstrap Stylesheet --}}
    {{-- <link href="css/style.css" rel="stylesheet"> --}}

    <style>
        .card {
            position: relative;
            overflow: hidden;
        }

        .card-hover:hover {
            background-color: #EEEEEE;
            box-shadow: 0px 0px 6px 8px rgba(0, 0, 0, 0.3);
            transform: scale(1.01);
            transition: box-shadow 0.3s ease-in-out;
            transition: transform 0.3s ease-in-out;
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
            transition: box-shadow 0.3s ease-in-out;
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('component.navbar')
    {{-- Navbar --}}

    {{-- Content --}}
    @yield('content')
    {{-- Content --}}

    {{-- Footer --}}
    @include('component.footer')
    {{-- Footer --}}

    {{-- Floating Button start --}}
    
    {{-- Floating Button end --}}

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
