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
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-5-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/font-awesome.min.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/menu.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/toastr.min.css') }}">
    {{-- @yield('styles') --}}

    <link href="{{ asset('frontend/findhouse/css/styles.css') }}" rel="stylesheet">
</head>
<body class="inner-pages hd-white">
    <!-- Wrapper -->
    <div id="wrapper">
        <div class="preloader">
            <div class="loading" id="loading"><span></span><span></span><span></span><span></span></div>
        </div>
        {{-- MAIN NAVIGATION BAR --}}
        @include('frontend.partials.navbar')

        {{-- MAIN CONTENT --}}
        <div class="main">
            @yield('content')
        </div>

        {{-- FOOTER --}}
        @include('frontend.partials.footer')
    </div>

    @include('frontend.partials.auth-script')

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

    {{-- @yield('scripts') --}}

</body>

</html>
