<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
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
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/toastr.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('frontend/css/materialize.min.css') }}" rel="stylesheet">
</head>

<body class="inner-pages maxw1600 m0a dashboard-bd">

    <div id="wrapper" class="int_main_wraapper">
        <div class="preloader">
            <div class="loading" id="loading"><span></span><span></span><span></span><span></span></div>
        </div>

        @include('frontend.partials.profile-header')

        @yield('content')

    </div>
    @include('frontend.partials.property-script')

    {{-- {!! Toastr::message() !!} --}}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButtor: true,
                    progressBar: true
                });
            @endforeach
        @endif
    </script>
</body>

</html>
