<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Real Estate') }}</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/jquery-ui.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/font-awesome.min.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/aos2.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/maps.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/colors/pink.css') }}">
</head>

<body class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        {{-- MAIN NAVIGATION BAR --}}
        @include('frontend.partials.navbar')

        {{-- SLIDER SECTION --}}
        {{-- @if (Request::is('/'))
        @include('frontend.partials.slider')
    @endif --}}

        {{-- SEARCH BAR --}}
        @include('frontend.partials.search')

        {{-- MAIN CONTENT --}}
        @yield('content')

        {{-- FOOTER --}}
        @include('frontend.partials.footer')

        @include('frontend.partials.app-script')

        {{-- {!! toastr::message() !!} --}}


        {{-- @yield('scripts') --}}
    </div>
</body>

</html>
