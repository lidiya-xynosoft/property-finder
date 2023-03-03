@extends('frontend.layouts.app')
@section('title', 'Home')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/search.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/aos.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/aos2.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/maps.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/colors/pink.css') }}">
    @endpush
    <!-- START SECTION POPULAR PLACES -->
    <section class="feature-categories bg-white rec-pro">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Popular </span>Places</h2>
                <p>Properties In Most Popular Places.</p>
            </div>
            <div class="row">
                <!-- Single category -->

                @foreach ($processed_cities as $key => $city)
                    <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="small-category-2">
                            <div class="small-category-2-thumb img-1">
                                <a href="{{ route('property.city', $city['city_slug']) }}">
                                    <img src="{{ Storage::url('city/' . $city['image']) }}"
                                        alt="{{ $city['city_name'] }}"></a>
                            </div>
                            <div class="sc-2-detail">
                                <h4 class="sc-jb-title"><a href="properties-full-grid-1.html">{{ $city['city_name'] }}</a>
                                </h4>
                                <span>{{ $city['total_property'] }} Properties</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Single category -->

            </div>
            <!-- /row -->
        </div>
    </section>
    <!-- END SECTION POPULAR PLACES -->

    <!-- START SECTION FEATURED PROPERTIES -->
    <section class="featured portfolio bg-white-2 rec-pro full-l">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Featured </span>Properties</h2>
                <p>These are our featured properties</p>
            </div>
            <div class="row portfolio-items">
                @foreach ($properties as $property)
                    <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 people sale">
                        <div class="project-single" data-aos="fade-left">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                        class="homes-img">
                                        @if ($property->featured == 1)
                                            <div class="homes-tag button alt featured">Featured</div>
                                        @endif
                                        <div class="homes-tag button sale">For {{ ucfirst($property->purpose) }}
                                        </div>
                                        <img src="{{ Storage::url('property/' . $property->image) }}"
                                            alt="{{ $property->title }}" class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                        class="btn"><i class="fa fa-link"></i></a>
                                    <a href="{{ $property->video }}" class="btn popup-video popup-youtube"><i
                                            class="fas fa-video"></i></a>
                                    <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                        class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a
                                        href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">{{ str_limit($property->title, 25) }}</a>
                                </h3>
                                <p class="homes-address mb-3">
                                    <a href="{{ route('property.city', $property->city) }}">
                                        <i
                                            class="fa fa-map-marker"></i><span>{{ str_limit($property->address, 30) }}</span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix pb-3">
                                    <li class="the-icons">
                                        <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                        <span>{{ $property->bedroom }} Bedrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                        <span>{{ $property->bathroom }} Bathrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                        <span>{{ $property->area }} sq ft</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                        <span>2 Garages</span>
                                    </li>
                                </ul>
                                <div class="price-properties footer pt-3 pb-0">
                                    <h3 class="title mt-3">
                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                            {{ $currency }}
                                            {{ number_format($property->price) }}</a>
                                    </h3>
                                    <div class="compare">
                                        <a href="#" title="Compare">
                                            <i class="flaticon-compare"></i>
                                        </a>
                                        <a href="#" title="Share">
                                            <i class="flaticon-share"></i>
                                        </a>
                                        <a href="#" title="Favorites">
                                            <i class="flaticon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
            <div class="bg-all">
                <a href="{{ route('property') }}" class="btn btn-outline-light">View More</a>
            </div>
        </div>
    </section>
    <!-- END SECTION FEATURED PROPERTIES -->

    <!-- START SECTION WHY CHOOSE US -->
    <section class="how-it-works bg-white rec-pro">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Why </span>Choose Us</h2>
                <p>We provide full service at every step.</p>
            </div>
            <div class="row service-1">
                @foreach ($services as $service)
                    <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                        <div class="serv-flex">
                            <div class="art-1 img-13">
                                <img src="{{ Storage::url('service/' . $service->icon) }}" alt="{{ $service->title }}">

                                <h3>{{ $service->title }}</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">{{ $service->description }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <!-- END SECTION WHY CHOOSE US -->

    <!-- START SECTION RECENTLY PROPERTIES -->
    <section class="featured portfolio rec-pro disc">
        <div class="container-fluid">
            <div class="sec-title discover">
                <h2><span>Discover </span>Popular Properties</h2>
                <p>We provide full service at every step.</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers">

                    @foreach ($properties as $property)
                        <div class="agents-grid" data-aos="fade-up">
                            <div class="people">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                class="homes-img">
                                                <div class="homes-tag button sale rent">For {{ $property->purpose }}</div>
                                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                                    alt="{{ $property->title }}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                class="btn"><i class="fa fa-link"></i></a>
                                            <a href="{{ $property->video }}" class="btn popup-video popup-youtube"><i
                                                    class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i
                                                    class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a
                                                href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">{{ str_limit($property->title, 20) }}</a>
                                        </h3>
                                        <p class="homes-address mb-3">
                                            <a
                                                href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                                <i
                                                    class="fa fa-map-marker"></i><span>{{ str_limit($property->address, 30) }}</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->bedroom }} Bedrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->bathroom }} Bathrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->area }} sq ft</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>2 Garages</span>
                                            </li>
                                        </ul>
                                        <div class="price-properties footer pt-3 pb-0">
                                            <h3 class="title mt-3">
                                                <a
                                                    href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">{{ $currency }}
                                                    {{ number_format($property->price) }}</a>
                                            </h3>
                                            <div class="compare">
                                                {{-- <a href="#" title="Compare">
                                                    <i class="flaticon-compare"></i>
                                                </a>
                                                <a href="#" title="Share">
                                                    <i class="flaticon-share"></i>
                                                </a> --}}
                                                <a href="#" title="Favorites">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION RECENTLY PROPERTIES -->

    <!-- START SECTION AGENTS -->
    <section class="team bg-white rec-pro">
        <div class="container-fluid">
            <div class="sec-title">
                <h2><span>Meet Our </span>Agents</h2>
                <p>Our Agents are here to help you</p>
            </div>
            <div class="row team-all">
                @foreach ($agents as $agent)
                    <!--Team Block-->
                    <div class="team-block col-sm-6 col-md-4 col-lg-4 col-xl-2" data-aos="fade-up" data-aos-delay="150">
                        <div class="inner-box team-details">
                            <div class="image team-head">
                                @if (Storage::disk('public')->exists('users/' . $agent->image) && $agent->image)
                                    <a href="agents-listing-grid.html"><img
                                            src="{{ Storage::url('users/' . $agent->image) }}" alt="" /></a>
                                @endif

                                <div class="team-hover">
                                    <ul class="team-social">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="lower-box">
                                <h3><a href="agents-listing-grid.html">{{ $agent->name . ' ' . $agent->username }}</a>
                                </h3>
                                <div class="designation">Real Estate Agent</div>
                            </div>
                        </div>
                    </div>
                    <!--Team Block-->
                @endforeach
            </div>
        </div>
    </section>
    <!-- END SECTION AGENTS -->

    <!-- START SECTION TESTIMONIALS -->
    @if (isset($testimonials))
        <section class="testimonials bg-white-2 rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Clients </span>Testimonials</h2>
                    <p>We collect reviews from our customers.</p>
                </div>
                <div class="owl-carousel job_clientSlide">
                    @foreach ($testimonials as $testimonial)
                        <div class="singleJobClinet">
                            <p>
                                {{ $testimonial->testimonial }}
                            </p>
                            <div class="detailJC">
                                <span><img src="{{ Storage::url('testimonial/' . $testimonial->image) }}"
                                        alt="" /></span>
                                <h5>{{ $testimonial->name }}</h5>
                                <p>{{ $testimonial->place }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!-- END SECTION TESTIMONIALS -->
    @push('script')
        <script src="{{ asset('frontend/findhouse/js/rangeSlider.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/moment.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/aos.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/aos2.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/animate.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/typed.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jquery.form.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/searched.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/forms-2.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/map-style2.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/range.js') }}"></script>

        <script>
            $(window).on('scroll load', function() {
                $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
            });
        </script>

        <script>
            var typed = new Typed('.typed', {
                strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
                smartBackspace: false,
                loop: true,
                showCursor: true,
                cursorChar: "|",
                typeSpeed: 50,
                backSpeed: 30,
                startDelay: 800
            });
        </script>

        <script>
            $('.slick-lancers').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1292,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }]
            });
        </script>

        <script>
            $('.job_clientSlide').owlCarousel({
                items: 2,
                loop: true,
                margin: 30,
                autoplay: false,
                nav: true,
                smartSpeed: 1000,
                slideSpeed: 1000,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    991: {
                        items: 3
                    }
                }
            });
        </script>

        <script>
            $('.style2').owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                autoWidth: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2,
                        margin: 20
                    },
                    400: {
                        items: 2,
                        margin: 20
                    },
                    500: {
                        items: 3,
                        margin: 20
                    },
                    768: {
                        items: 4,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 20
                    },
                    1000: {
                        items: 7,
                        margin: 20
                    }
                }
            });
        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });
            //  $("#area-range-rent").on('change', function() {

            //    document.getElementById('sliderVal').innerHTML = val;
            //    alert("jee");
            // });
        </script>
    @endpush
@endsection
