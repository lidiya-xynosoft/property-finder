@extends('frontend.layouts.app')
@section('title', 'Properties')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-5-all.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/search.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/magnific-popup.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet-gesture-handling.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.default.css') }}">
    @endpush

    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-right list featured portfolio blog pt-5">
        <div class="container">
            
            <section class="content">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="pb-2"><a href="index.html">Home </a> &nbsp;/&nbsp; <span>Property</span></p>
                            </div>
                            <div class="sec-title">
                                <h4>Properties List</h4>
                                <p>{{ count($properties) }} results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="widget-boxed popular mt-5">

                <div class="widget-boxed-body">
                    <section class="feature-categories bg-white rec-pro">

                        <div class="row">

                            @foreach ($types as $type)
                                <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                                    <div class="small-category-2">

                                        <div class="sc-2-detail">
                                            <h4 class="sc-jb-title">
                                                <div class="text-heading text-left">
                                                    <p class="pb-2"><a
                                                            href="{{ route('property.type', $type->type) }}">{{ ucfirst($type->type) }}
                                                        </a>

                                                        <span>(203)</span>
                                                    </p>
                                                </div>

                                            </h4>

                                        </div>
                                        <span style="display:none;">eee</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </section>
                </div>
            </div>
            <br />
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
                    @php
                        $counter = 1;
                    @endphp
                    <div class="row featured portfolio-items">
                        <!-- homes img1 -->
                        <div class="item col-lg-5 col-md-12 col-xs-12 landscapes sale pr-0 pb-0">
                            @foreach ($properties as $property)
                                <div class="project-single mb-0 bb-0" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <a href="single-property-1.html" class="homes-img">
                                                @if ($property->featured == 1)
                                                    <div class="homes-tag button alt featured">Featured</div>
                                                @endif
                                                <div class="homes-tag button alt sale">For {{ $property->purpose }}</div>
                                                <div class="homes-price">${{ number_format($property->price) }}</div>
                                                @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                    <img src="{{ Storage::url('property/' . $property->image) }}"
                                                        alt="{{ $property->title }}" class="img-responsive">
                                                @else
                                                @endif

                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ route('property.show', $property->slug) }}" class="btn"><i
                                                    class="fa fa-link"></i></a>
                                            <a href="{{ $property->video }}" class="btn popup-video popup-youtube"><i
                                                    class="fas fa-video"></i></a>
                                            <a href="{{ route('property.show', $property->slug) }}"
                                                class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- homes content -->
                        @if ($counter % 2 === 0)
                            <div class="col-lg-7 col-md-12 homes-content pb-0 my-44 ft mb-44" data-aos="fade-up">
                            @else
                                <div class="col-lg-7 col-md-12 homes-content pb-0 mb-44" data-aos="fade-up">
                        @endif

                        <h3><a
                                href="{{ route('property.show', $property->slug) }}">{{ str_limit($property->title, 20) }}</a>
                        </h3>
                        <p class="homes-address mb-3">
                            <a href="{{ route('property.show', $property->slug) }}">
                                <i class="fa fa-map-marker"></i><span>{{ ucfirst($property->address) }}</span>
                            </a>
                            
                        </p>
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
                           
                        </ul>
                        <div class="footer">

                            <a href="agent-details.html">
                                @if (Storage::disk('public')->exists('users/' . $property->user->image) && $property->user->image)
                                    <img src="{{ Storage::url('users/' . $property->user->image) }}"
                                        alt="{{ $property->user->name }}" class="mr-2">
                                @endif
                                {{ ucfirst($property->user->name) .' '.$property->user->username }}
                            </a>
                            <span>{{ $property->created_at->diffForHumans() }}</span>
                        </div>
                        @if ($counter % 2 === 0)
                    </div>
                    <div class="item col-lg-5 col-md-12 col-xs-12 landscapes sale pr-0 pb-0">
                    @else
                    </div>
                    <div class="item col-lg-5 col-md-12 col-xs-12 landscapes sale pr-0 pb-0 my-44 ft">
                        @endif
                        @php
                            $counter++;
                        @endphp
                        @endforeach

                    </div>
                </div>
            </div>
            @include('pages.properties.sidebar')
        </div>
        <nav aria-label="..." class="agents pt-55">
            {{ $properties->links('pagination::bootstrap-4') }}

        </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('frontend/findhouse/js/jquery-ui.js') }}"></script>
        <script src="js/range-slider.js"></script>

        <script src="{{ asset('frontend/findhouse/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/slick4.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/inner.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/jqueryadd-count.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-gesture-handling.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-providers.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet.markercluster.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/map-single.js') }}"></script>
    @endpush
@endsection
