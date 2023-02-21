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
                                            <a href="{{ route('property.show', $property->slug) }}" class="homes-img">
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
                                            <a href="{{ route('property.show', $property->slug) }}" class="btn"><i
                                                    class="fa fa-link"></i></a>
                                            <a href="{{ $property->viddeo }}" class="btn popup-video popup-youtube"><i
                                                    class="fas fa-video"></i></a>
                                            <a href="{{ route('property.show', $property->slug) }}"
                                                class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="{{ route('property.show', $property->slug) }}"
                                                title="{{ $property->title }}">{{ $property->title }}</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="{{ route('property.show', $property->slug) }}">
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
                                                <a href="{{ route('property.show', $property->slug) }}">$
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
                <aside class="col-lg-4 col-md-12 car">
                    <div class="widget">
                        <!-- Search Fields -->
                        <div class="widget-boxed main-search-field">
                            <div class="widget-boxed-header">
                                <h4>Find Your House</h4>
                            </div>
                            <!-- Search Form -->
                            <div class="trip-search">
                                <form class="sidebar-search" action="{{ route('search') }}" method="POST">
                                    @csrf
                                    <!-- Form Lookin for -->
                                    <div class="form-group looking">
                                        <div class="first-select wide">
                                            <div class="main-search-input-item">
                                                <input type="text" name="city" id="autocomplete-input-sidebar"
                                                    autocomplete="off" placeholder="Enter Keyword..." value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Form Lookin for -->
                                    <!-- Form Location -->
                                    <div class="form-group location">
                                        <div class="nice-select form-control wide" tabindex="0"><span
                                                class="current"><i class="fa fa-map-marker"></i>Location</span>
                                            <ul class="list">
                                                <li data-value="1" class="option selected ">New York</li>
                                                <li data-value="2" class="option">Los Angeles</li>
                                                <li data-value="3" class="option">Chicago</li>
                                                <li data-value="3" class="option">Philadelphia</li>
                                                <li data-value="3" class="option">San Francisco</li>
                                                <li data-value="3" class="option">Miami</li>
                                                <li data-value="3" class="option">Houston</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ End Form Location -->
                                    <!-- Form Categories -->
                                    <div class="form-group categories">
                                        <div class="nice-select form-control wide" tabindex="0"><span
                                                class="current"><i class="fa fa-home" aria-hidden="true"></i>Property
                                                Type</span>
                                            <ul class="list" name="type">
                                                <li data-value="house" class="option selected ">House</li>
                                                <li data-value="appartment" class="option">Apartment</li>
                                                <li data-value="appartment" class="option">Condo</li>
                                                <li data-value="appartment" class="option">Land</li>
                                                <li data-value="appartment" class="option">Bungalow</li>
                                                <li data-value="appartment" class="option">Single Family</li>
                                            </ul>

                                        </div>
                                    </div>
                                    <!--/ End Form Categories -->
                                    <!-- Form Property Status -->
                                    <div class="form-group categories">
                                        <div class="nice-select form-control wide" tabindex="0"><span
                                                class="current"><i class="fa fa-home"></i>Property Status</span>
                                            <ul class="list" name="purpose">
                                                <li data-value="sale" class="option selected ">For Sale</li>
                                                <li data-value="rent" class="option">For Rent</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ End Form Property Status -->
                                    <!-- Form Bedrooms -->
                                    <div class="form-group beds">
                                        <div class="nice-select form-control wide" tabindex="0"><span
                                                class="current"><i class="fa fa-bed" aria-hidden="true"></i>
                                                Bedrooms</span>
                                            <ul class="list" name="bedroom">
                                                <li data-value="1" class="option selected">1</li>
                                                <li data-value="2" class="option">2</li>
                                                <li data-value="3" class="option">3</li>
                                                <li data-value="3" class="option">4</li>
                                                <li data-value="3" class="option">5</li>
                                                <li data-value="3" class="option">6</li>
                                                <li data-value="3" class="option">7</li>
                                                <li data-value="3" class="option">8</li>
                                                <li data-value="3" class="option">9</li>
                                                <li data-value="3" class="option">10</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ End Form Bedrooms -->
                                    <!-- Form Bathrooms -->
                                    <div class="form-group bath">
                                        <div class="nice-select form-control wide" tabindex="0"><span
                                                class="current"><i class="fa fa-bath" aria-hidden="true"></i>
                                                Bathrooms</span>
                                            <ul class="list" name="bathoom">
                                                <li data-value="1" class="option selected">1</li>
                                                <li data-value="2" class="option">2</li>
                                                <li data-value="3" class="option">3</li>
                                                <li data-value="3" class="option">4</li>
                                                <li data-value="3" class="option">5</li>
                                                <li data-value="3" class="option">6</li>
                                                <li data-value="3" class="option">7</li>
                                                <li data-value="3" class="option">8</li>
                                                <li data-value="3" class="option">9</li>
                                                <li data-value="3" class="option">10</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ End Form Bathrooms -->
                                </form>
                            </div>
                            <!--/ End Search Form -->
                            <!-- Price Fields -->
                            <div class="main-search-field-2">
                                <!-- Area Range -->
                                <div class="range-slider">
                                    <label>Area Size</label>
                                    <div id="area-range" data-min="0" data-max="1300" data-unit="sq ft"></div>
                                    <div class="clearfix"></div>
                                </div>
                                <br>
                                <!-- Price Range -->
                                <div class="range-slider">
                                    <label>Price Range</label>
                                    <div id="price-range" data-min="0" data-max="600000" data-unit="$"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- More Search Options -->
                            <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30"
                                data-open-title="Advanced Features" data-close-title="Advanced Features"></a>

                            <div class="more-search-options relative">
                                <!-- Checkboxes -->
                                <div class="checkboxes one-in-row margin-bottom-10">
                                    <input id="check-2" type="checkbox" name="check">
                                    <label for="check-2">Air Conditioning</label>
                                    <input id="check-3" type="checkbox" name="check">
                                    <label for="check-3">Swimming Pool</label>
                                    <input id="check-4" type="checkbox" name="check">
                                    <label for="check-4">Central Heating</label>
                                    <input id="check-5" type="checkbox" name="check">
                                    <label for="check-5">Laundry Room</label>
                                    <input id="check-6" type="checkbox" name="check">
                                    <label for="check-6">Gym</label>
                                    <input id="check-7" type="checkbox" name="check">
                                    <label for="check-7">Alarm</label>
                                    <input id="check-8" type="checkbox" name="check">
                                    <label for="check-8">Window Covering</label>
                                    <input id="check-9" type="checkbox" name="check">
                                    <label for="check-9">WiFi</label>
                                    <input id="check-10" type="checkbox" name="check">
                                    <label for="check-10">TV Cable</label>
                                    <input id="check-11" type="checkbox" name="check">
                                    <label for="check-11">Dryer</label>
                                    <input id="check-12" type="checkbox" name="check">
                                    <label for="check-12">Microwave</label>
                                    <input id="check-13" type="checkbox" name="check">
                                    <label for="check-13">Washer</label>
                                    <input id="check-14" type="checkbox" name="check">
                                    <label for="check-14">Refrigerator</label>
                                    <input id="check-15" type="checkbox" name="check">
                                    <label for="check-15">Outdoor Shower</label>
                                </div>
                                <!-- Checkboxes / End -->
                            </div>
                            <!-- More Search Options / End -->
                            <div class="col-lg-12 no-pds">
                                <div class="at-col-default-mar">
                                    <button class="btn btn-default hvr-bounce-to-right" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-boxed mt-5">
                            <div class="widget-boxed-header mb-5">
                                <h4>Feature Properties</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="slick-lancers">
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 230,000</span>
                                                    <span>For Sale</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>New York</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-1.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 6,500</span>
                                                    <span class="rent">For Rent</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>Los
                                                            Angles</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-2.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 230,000</span>
                                                    <span>For Sale</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>San
                                                            Francisco</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-3.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 6,500</span>
                                                    <span class="rent">For Rent</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>Miami FL</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-4.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 230,000</span>
                                                    <span>For Sale</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>Chicago
                                                            IL</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-5.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="agents-grid mr-0">
                                        <div class="listing-item compact">
                                            <a href="properties-details.html" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">$ 6,500</span>
                                                    <span class="rent">For Rent</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">House Luxury <i>Toronto
                                                            CA</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>720 sq ft</span></li>
                                                        <li>Rooms <span>6</span></li>
                                                        <li>Beds <span>2</span></li>
                                                        <li>Baths <span>3</span></li>
                                                    </ul>
                                                </div>
                                                <img src="images/feature-properties/fp-6.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-boxed mt-5">
                            <div class="widget-boxed-header">
                                <h4>Recent Properties</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="recent-post">
                                    @foreach ($recent_properties as $recent_property)
                                        <div class="recent-main my-4">
                                            <div class="recent-img">
                                                <a href="blog-details.html">
                                                    <img src="{{ Storage::url('property/' . $recent_property->image) }}"
                                                        alt="{{ $recent_property->title }}">
                                                </a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html">
                                                    <h6>{{ str_limit($recent_property->title, 18) }}</h6>
                                                </a>
                                                <p>{{ number_format($recent_property->price) }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="widget-boxed popular mt-5 mb-0">
                            <div class="widget-boxed-header">
                                <h4>Popular Tags</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="recent-post">
                                    <div class="tags">
                                        <span><a href="#" class="btn btn-outline-primary">Houses</a></span>
                                        <span><a href="#" class="btn btn-outline-primary">Real Home</a></span>
                                    </div>
                                    <div class="tags">
                                        <span><a href="#" class="btn btn-outline-primary">Baths</a></span>
                                        <span><a href="#" class="btn btn-outline-primary">Beds</a></span>
                                    </div>
                                    <div class="tags">
                                        <span><a href="#" class="btn btn-outline-primary">Garages</a></span>
                                        <span><a href="#" class="btn btn-outline-primary">Family</a></span>
                                    </div>
                                    <div class="tags">
                                        <span><a href="#" class="btn btn-outline-primary">Real Estates</a></span>
                                        <span><a href="#" class="btn btn-outline-primary">Properties</a></span>
                                    </div>
                                    <div class="tags no-mb">
                                        <span><a href="#" class="btn btn-outline-primary">Location</a></span>
                                        <span><a href="#" class="btn btn-outline-primary">Price</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
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
