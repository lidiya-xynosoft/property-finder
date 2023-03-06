@extends('frontend.layouts.app')
@section('title', 'Property')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-5-all.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">

        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet-gesture-handling.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.default.css') }}">
    @endpush

    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-right featured portfolio blog pt-5">
        <div class="container">
            <section class="headings-2 pt-0 pb-55">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="pb-2"><a href="index.html">Home </a> &nbsp;/&nbsp; <span>Agent</span></p>
                            </div>
                            <div class="sec-title">
                                <h4>Agents List</h4>
                                {{-- <p>{{ count($properties) }} results</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <section class="headings-2 pt-0">
                        <div class="pro-wrapper">
                            <div class="detail-wrapper-body">
                                <div class="listing-title-bar">
                                    <div class="text-heading text-left">
                                        <div class="input-group border rounded input-group-lg w-auto mr-4">
                                            <label
                                                class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                                for="inputGroupSelect01"><i
                                                    class="fas fa-align-left fs-16 pr-2"></i>Sortby</label>

                                        </div>
                                        <select
                                            class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"
                                            data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3"
                                            id="inputGroupSelect01" name="sortby">
                                            <option selected>Top Selling</option>
                                            <option value="1">Most Viewed</option>
                                            <option value="2">Price(low to high)</option>
                                            <option value="3">Price(high to low)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                    <div class="row">
                        @foreach ($agents as $agent)
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ route('agents.show', $agent->id) }}" class="homes-img">

                                                @if ($agent->property && isset($agent->property))
                                                    @if (count($agent->property) > 0)
                                                        <div class="homes-tag button alt featured">
                                                            {{ count($agent->property) }} Listing
                                                        </div>
                                                    @endif
                                                @endif

                                                @if (Storage::disk('public')->exists('users/' . $agent->image) && $agent->image)
                                                    <img src="{{ Storage::url('users/' . $agent->image) }}" alt="home-1"
                                                        class="img-responsive">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <div class="the-agents">
                                            <h3><a href="{{ route('agents.show', $agent->id) }}">{{ $agent->name }}</a>
                                            </h3>
                                            <ul class="the-agents-details">
                                                <li><a href="#">Office: (234) 0200 17813</a></li>
                                                <li><a href="#">Mobile: {{ $agent->contact_no }}</a></li>
                                                <li><a href="#">Email: {{ $agent->email }}</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer">
                                            <span class="view-my-listing">
                                                <a href="{{ route('agents.show', $agent->id) }}">View My Listings</a>
                                            </span>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">

                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Recent Properties</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @foreach ($recent_properties as $key => $property)
                                                <div class="recent-main my-4">
                                                    <div class="recent-img">
                                                        <a
                                                            href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                                            @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                                                    alt="{{ $property->title }}" class="img-responsive">
                                                            @else
                                                            @endif

                                                    </div>
                                                    <div class="info-img">
                                                        <a
                                                            href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                                            <h6>{{ str_limit($property->title, 22) }}</h6>
                                                        </a>
                                                        <p>{{ $currency }} {{ number_format($property->price, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- <div class="recent-main my-4">
                          <div class="recent-img">
                              <a href="blog-details.html"><img src="images/feature-properties/fp-2.jpg"
                                      alt=""></a>
                          </div>
                          <div class="info-img">
                              <a href="blog-details.html">
                                  <h6>Luxury Villa House</h6>
                              </a>
                              <p>$120,000</p>
                          </div>
                      </div>
                      <div class="recent-main">
                          <div class="recent-img">
                              <a href="blog-details.html"><img src="images/feature-properties/fp-3.jpg"
                                      alt=""></a>
                          </div>
                          <div class="info-img">
                              <a href="blog-details.html">
                                  <h6>Luxury Family Home</h6>
                              </a>
                              <p>$150,000</p>
                          </div>
                      </div> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <nav aria-label="..." class="pt-55">
                {{ $agents->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('frontend/findhouse/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/range-slider.js') }}"></script>

        <script src="{{ asset('frontend/findhouse/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/slick4.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/inner.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jqueryadd-count.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-gesture-handling.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-providers.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet.markercluster.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/map-single.js') }}"></script>

        <!-- Date Dropper Script-->
        <script>
            $('#reservation-date').dateDropper();
        </script>
        <!-- Time Dropper Script-->
        <script>
            this.$('#reservation-time').timeDropper({
                setCurrentTime: false,
                meridians: true,
                primaryColor: "#e8212a",
                borderColor: "#e8212a",
                minutesInterval: '15'
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            });
        </script>

        <script>
            $('.slick-carousel').each(function() {
                var slider = $(this);
                $(this).slick({
                    infinite: true,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0'
                });

                $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function() {
                    slider.slick('slickPrev');
                });
                $(this).closest('.slick-slider-area').find('.slick-next').on("click", function() {
                    slider.slick('slickNext');
                });
            });
        </script>
    @endpush
@endsection
