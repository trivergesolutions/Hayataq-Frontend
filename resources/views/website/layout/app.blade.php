<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Hayateq</title> --}}
    <title>@yield('title', 'HAYA TEQ')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    {{-- @section('canonical') --}}
    {{-- <link rel="canonical" href="{{ request()->url() }}"> --}}
    <meta name="description" content="@yield('meta_description', '')">

    <meta name="keywords" content="@yield('meta_keywords', '')">
    <link rel="canonical" href="{{ url()->current() }}">
    {{-- @endsection --}}
    <!-- ===============Google fonts=============== -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- ===============CSS links=============== -->
    <link rel="stylesheet" href="{{ asset('assests/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assests/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('website/assests/css/stylemy1.css') }}"> --}}
    <script src="{{ asset('website/assests/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/swiper-bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    @include('website.layout.header')

    @yield('content')
    @include('website.partials.floating-contact')
    @include('website.layout.footer')
    <!-- ===============JS links=============== -->
    <script src="{{ asset('website/assests/js/jquery.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('website/assests/js/aos.js') }}"></script>
    <script src="{{ asset('website/assests/js/edit-js.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
