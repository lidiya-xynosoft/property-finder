<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title', '') | Laravel Real Estate</title>
    @include('frontend.partials.head')
</head>
@if(Request::is('contact'))
<body class="inner-pages hd-white">
@else
<body class="{{ Request::is('/') ? 'homepage-9 hp-6 homepage-1 mh' : 'inner-pages listing homepage-4 agents hd-white' }}">
@endif
    <div id="wrapper">
        {{-- MAIN NAVIGATION BAR --}}
        @include('frontend.partials.navbar')

        {{-- SLIDER SECTION --}}
        {{-- @if (Request::is('/'))
        @include('frontend.partials.slider')
    @endif --}}
        @if (Request::is('/'))
         {{-- SEARCH BAR --}}
            @include('frontend.partials.search')
        @else
           
        @endif


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
