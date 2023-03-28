<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title', '') | Laravel Real Estate</title>
    @include('frontend.partials.head')
</head>

@if (Request::is('contact'))

    <body class="inner-pages hd-white">
    @elseif(Request::path() === 'tenant/complaint')

<body class="inner-pages maxw1600 m0a dashboard-bd">
        @else

            <body
                class="{{ Request::is('/') ? 'homepage-9 hp-6 homepage-1 mh' : 'inner-pages listing homepage-4 agents hd-white' }}">
@endif
<div id="wrapper">
    {{-- MAIN NAVIGATION BAR --}}
    @if (Request::path() != 'tenant/complaint')
        @include('frontend.partials.navbar')
    @endif
    @if (Request::is('/'))
        {{-- SEARCH BAR --}}
        @include('frontend.partials.search')
    @else
    @endif


    {{-- MAIN CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    @if (Request::path() != 'tenant/complaint')
        @include('frontend.partials.footer')
    @endif

    @include('frontend.partials.app-script')

    {{-- {!! toastr::message() !!} --}}


    {{-- @yield('scripts') --}}
</div>
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
