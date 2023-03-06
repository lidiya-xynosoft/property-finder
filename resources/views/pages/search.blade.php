@extends('frontend.layouts.app')
@section('title', 'Search')

@section('content')

    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/fontawesome-5-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/lightcase.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
    @endpush


    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-right featured portfolio blog pt-5">
        <div class="container">
            <section class="headings-2 pt-0 pb-55">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="pb-2"><a href="index.html">Home </a> &nbsp;/&nbsp; <span>Listings</span></p>
                            </div>
                            <h3>Grid View</h3>
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
                                        <p class="font-weight-bold mb-0 mt-3">{{ count($properties) }} Search results</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                                <div class="input-group border rounded input-group-lg w-auto mr-4">
                                    <label
                                        class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                        for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"
                                        data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3"
                                        id="inputGroupSelect01" name="sortby">
                                        <option selected>Top Selling</option>
                                        <option value="1">Most Viewed</option>
                                        <option value="2">Price(low to high)</option>
                                        <option value="3">Price(high to low)</option>
                                    </select>
                                </div>
                                <div class="sorting-options">
                                    <a href="properties-list-1.html" class="change-view-btn lde"><i
                                            class="fa fa-th-list"></i></a>
                                    <a href="#" class="change-view-btn active-view-btn"><i
                                            class="fa fa-th-large"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="row">
                        @foreach ($properties as $property)
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}" class="homes-img">
                                                <div class="homes-tag button alt featured">Featured</div>
                                                <div class="homes-tag button alt sale">For {{ $property->purpose }}</div>
                                                <div class="homes-price">${{ number_format($property->price) }}</div>
                                                @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                    <img src="{{ Storage::url('property/' . $property->image) }}"
                                                        alt="{{ $property->title }}" class="img-responsive">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}" class="btn"><i
                                                    class="fa fa-link"></i></a>
                                            <a href="{{ $property->viddeo }}" class="btn popup-video popup-youtube"><i
                                                    class="fas fa-video"></i></a>
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                title="{{ $property->title }}">{{ $property->title }}</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                                <i class="fa fa-map-marker"></i><span>{{ ucfirst($property->address) }}
                                                </span>
                                                <i class="fa fa-map-marker"></i><span>{{ ucfirst($property->city) }}
                                                </span>
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
                                                <span>{{ $property->city }}</span>
                                            </li>
                                        </ul>
                                        <div class="price-properties footer pt-3 pb-0">
                                            <h3 class="title mt-3">
                                                <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">$
                                                    {{ $property->price }}</a>
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
                        @endforeach
                    </div>

                </div>
                 @include('pages.properties.sidebar')
            </div>
            <nav aria-label="..." class="pt-55">
                <ul class="pagination disabled">
                    {{ $properties->appends([
                            'city' => Request::get('city'),
                            'type' => Request::get('type'),
                            'purpose' => Request::get('purpose'),
                            'bedroom' => Request::get('bedroom'),
                            'bathroom' => Request::get('bathroom'),
                            'minprice' => Request::get('minprice'),
                            'maxprice' => Request::get('maxprice'),
                            'minarea' => Request::get('minarea'),
                            'maxarea' => Request::get('maxarea'),
                            'featured' => Request::get('featured'),
                        ])->links() }}
                </ul>
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->

@endsection

@section('scripts')

@endsection
