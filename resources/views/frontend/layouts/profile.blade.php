<!DOCTYPE html>
<html lang="en">

<head>

	<title>@yield('title','') | Laravel Real Estate</title>

    @include('frontend.partials.head')

</head>

    <body  class="{{ Request::is('search') ? 'inner-pages listing homepage-4 agents hd-white' : 'inner-pages maxw1600 m0a dashboard-bd' }}">

    <div id="wrapper" class="int_main_wraapper">
        <div class="preloader">
            <div class="loading" id="loading"><span></span><span></span><span></span><span></span></div>
        </div>

        @include('frontend.partials.profile-header')

        @yield('content')

    </div>
    @include('frontend.partials.profile-script')

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
