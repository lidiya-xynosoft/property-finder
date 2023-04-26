<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Real Estate - @yield('title')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/findhouse/css/toastr.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />


    <!-- Stack array for including inline js or scripts -->
    @stack('head')

    <!-- Custom Css -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes -->
    <link href="{{ asset('backend/css/themes/theme-indigo.css') }}" rel="stylesheet" />


</head>

<body class="theme-indigo">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>


    {{-- MAIN NAVIGATION BAR --}}
    @include('backend.partials.navbar')

    {{-- SIDEBAR LEFT --}}
    <section>
        @include('backend.partials.sidebar')
    </section>

    {{-- MAIN CONTENT SECTION --}}
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>

   {{-- SCRIPTS --}}
        @include('backend.partials.app-script')
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
