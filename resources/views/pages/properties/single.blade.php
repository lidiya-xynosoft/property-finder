@extends('frontend.layouts.app')
@section('title', $property->title)
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
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="headings-2 pt-0">
                                <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <h3>{{ $property->title }} <span class="mrg-l-5 category-tag">For
                                                    {{ $property->purpose }}</span></h3>
                                            <div class="mt-0">
                                                <a href="#listing-location" class="listing-address">
                                                    <i
                                                        class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>{{ $property->address }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single detail-wrapper mr-2">
                                        <div class="detail-wrapper-body">
                                            <div class="listing-title-bar">
                                                <h4>{{ $currency }} {{ number_format($property->price) }}</h4>
                                                {{-- <div class="mt-0">
                                                    <a href="#listing-location" class="listing-address">
                                                        <p>$ 1,200 / sq ft</p>
                                                    </a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @if (!$property->gallery->isEmpty())
                                <div class="single-slider">
                                    @include('pages.properties.slider')
                                </div>
                            @else
                                <div class="single-image">
                                    @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                        <img src="{{ Storage::url('property/' . $property->image) }}"
                                            alt="{{ $property->title }}" class="imgresponsive">
                                    @endif
                                </div>
                            @endif
                            <div class="blog-info details mb-30">
                                <h5 class="mb-4">Description</h5>
                                <p class="mb-3"> {!! $property->description !!}</p>

                            </div>
                        </div>
                    </div>
                    <div class="single homes-content details mb-30">
                        <!-- title -->
                        <h5 class="mb-4">Property Details</h5>
                        <ul class="homes-list clearfix">
                            <li>
                                <span class="font-weight-bold mr-1">Property ID:</span>
                                <span class="det">{{ $property->product_code }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Property Type:</span>
                                <span class="det">{{ $property->type }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Property status:</span>
                                <span class="det">For {{ $property->purpose }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Property Price:</span>
                                <span class="det">{{ $currency }} {{ number_format($property->price) }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Area:</span>
                                <span class="det">{{ $property->area }} Sq Ft</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Bedrooms:</span>
                                <span class="det">{{ $property->bedroom }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Bathrooms:</span>
                                <span class="det">{{ $property->bathroom }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Garages:</span>
                                <span class="det">{{ $property->garage }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Year Built:</span>
                                <span class="det">{{ $property->built_year }}</span>
                            </li>
                        </ul>
                        <!-- title -->
                        @if ($property->features)
                            <h5 class="mt-5">Amenities</h5>
                            <!-- cars List -->
                            <ul class="homes-list clearfix">
                                @foreach ($property->features as $feature)
                                    <li>
                                        <i class="fa fa-check-square" aria-hidden="true"></i>
                                        <span>{{ $feature->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="floor-plan property wprt-image-video w50 pro">
                        <h5>Floor Plans</h5>
                        @if (Storage::disk('public')->exists('property/' . $property->floor_plan) && $property->floor_plan)
                            <img src="{{ Storage::url('property/' . $property->floor_plan) }}"
                                alt="{{ $property->title }}">
                        @endif
                    </div>
                    <div class="floor-plan property wprt-image-video w50 pro">
                        <h5>What's Nearby</h5>
                        <div class="property-nearby">
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach ($processed_nearby as $key => $value)
                                        <div class="nearby-info mb-4">
                                            <span class="nearby-title mb-3 d-block {{ $value['class'] }}">
                                                <i class="{{ $value['icon'] }}"></i><b
                                                    class="title">{{ $value['category'] }}</b>
                                            </span>
                                            <div class="nearby-list">
                                                <ul class="property-list list-unstyled mb-0">
                                                    @foreach ($value['items'] as $row)
                                                        <li class="d-flex">
                                                            <h6 class="mb-3 mr-2">{{ $row['title'] }}</h6>
                                                            <span>({{ $row['distance'] }})</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($property->video)
                        <div class="property wprt-image-video w50 pro">
                            <h5>Property Video</h5>
                            @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                    alt="{{ $property->title }}">
                            @endif
                            <a class="icon-wrap popup-video popup-youtube" href="{{ $property->video }}">
                                <i class="fa fa-play"></i>
                            </a>
                            <div class="iq-waves">
                                <div class="waves wave-1"></div>
                                <div class="waves wave-2"></div>
                                <div class="waves wave-3"></div>
                            </div>
                        </div>
                    @endif
                    <div class="property-location map">
                        <h5>Location</h5>
                        <div class="divider-fade"></div>
                        <div id="map-contact" class="contact-map"></div>
                    </div>
                    <!-- Star Reviews -->
                    <section class="reviews comments">
                        <h3 class="mb-5">3 Reviews</h3>
                        <div class="row mb-5">
                            <ul class="col-12 commented pl-0">
                                <li class="comm-inf">
                                    <div class="col-md-2">
                                        <img src="{{ asset('frontend/findhouse/images/testimonials/ts-5.jpg') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-10 comments-info">
                                        <div class="conra">
                                            <h5 class="mb-2">Mary Smith</h5>
                                            <div class="rating-box">
                                                <div class="detail-list-rating mr-0">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-4">May 30 2020</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                            congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu dolor.
                                            Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.</p>
                                        <div class="rest"><img
                                                src="{{ asset('frontend/findhouse/images/single-property/s-1.jpg') }}"
                                                class="img-fluid" alt=""></div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="row">
                            <ul class="col-12 commented pl-0">
                                <li class="comm-inf">
                                    <div class="col-md-2">
                                        <img src="{{ asset('frontend/findhouse/images/testimonials/ts-4.jpg') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-10 comments-info">
                                        <div class="conra">
                                            <h5 class="mb-2">Abraham Tyron</h5>
                                            <div class="rating-box">
                                                <div class="detail-list-rating mr-0">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-4">june 1 2020</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                            congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu dolor.
                                            Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.</p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="row mb-5">
                            <ul class="col-12 commented mb-0 pl-0">
                                <li class="comm-inf">
                                    <div class="col-md-2">
                                        <img src="{{ asset('frontend/findhouse/images/testimonials/ts-3.jpg') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-10 comments-info">
                                        <div class="conra">
                                            <h5 class="mb-2">Lisa Williams</h5>
                                            <div class="rating-box">
                                                <div class="detail-list-rating mr-0">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-4">jul 12 2020</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                            congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu dolor.
                                            Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.</p>
                                        <div class="resti">
                                            <div class="rest"><img
                                                    src="{{ asset('frontend/findhouse/images/single-property/s-2.jpg') }}"
                                                    class="img-fluid" alt=""></div>
                                            <div class="rest"><img
                                                    src="{{ asset('frontend/findhouse/images/single-property/s-3.jpg') }}"
                                                    class="img-fluid" alt=""></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <!-- End Reviews -->
                    <!-- Star Add Review -->
                    <section class="single reviews leve-comments details">
                        <div id="add-review" class="add-review-box">
                            <!-- Add Review -->
                            <h3 class="listing-desc-headline margin-bottom-20 mb-4">Add Review</h3>
                            <span class="leave-rating-title">Your rating for this listing</span>
                            <!-- Rating / Upload Button -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Leave Rating -->
                                    <div class="clearfix"></div>
                                    <div class="leave-rating margin-bottom-30">
                                        <input type="radio" name="rating" id="rating-1" value="1" />
                                        <label for="rating-1" class="fa fa-star"></label>
                                        <input type="radio" name="rating" id="rating-2" value="2" />
                                        <label for="rating-2" class="fa fa-star"></label>
                                        <input type="radio" name="rating" id="rating-3" value="3" />
                                        <label for="rating-3" class="fa fa-star"></label>
                                        <input type="radio" name="rating" id="rating-4" value="4" />
                                        <label for="rating-4" class="fa fa-star"></label>
                                        <input type="radio" name="rating" id="rating-5" value="5" />
                                        <label for="rating-5" class="fa fa-star"></label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Uplaod Photos -->
                                    <div class="add-review-photos margin-bottom-30">
                                        <div class="photoUpload">
                                            <span><i class="sl sl-icon-arrow-up-circle"></i> Upload Photos</span>
                                            <input type="file" class="upload" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 data">
                                    <form action="#">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" id="exampleTextarea" rows="8" placeholder="Review" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg mt-2">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Add Review -->
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">

                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33 mt-5">
                                <div class="widget-boxed-header">
                                    <h4>Agent Information</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        <div class="author-box clearfix">
                                            <img src="{{ Storage::url('users/' . $agent->image) }}" alt="author-image"
                                                class="author__img">
                                            <h4 class="author__title">{{ $agent->name }}</h4>
                                            <p class="author__meta">Agent of Property</p>
                                        </div>
                                        <ul class="author__contact">
                                            <li><span class="la la-map-marker"><i
                                                        class="fa fa-map-marker"></i></span>{{ $agent->address }}</li>
                                            <li><span class="la la-phone"><i class="fa fa-phone"
                                                        aria-hidden="true"></i></span><a
                                                    href="#">{{ $agent->contact_no }}</a></li>
                                            <li><span class="la la-envelope-o"><i class="fa fa-envelope"
                                                        aria-hidden="true"></i></span><a
                                                    href="#">{{ $agent->email }}</a>
                                            </li>
                                        </ul>
                                        <div class="agent-contact-form-sidebar">
                                            <h4>Request Inquiry</h4>
                                            <form class="agent-message-box" action="" method="POST">
                                                @csrf
                                                <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                                <input type="hidden" name="product_id" value="{{ $property->id }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                <input type="text" id="fname" name="name"
                                                    placeholder="Full Name" />
                                                <input type="number" id="pnumber" name="phone"
                                                    placeholder="Phone Number" />
                                                <input type="email" id="emailid" name="email"
                                                    placeholder="Email Address" />
                                                <textarea placeholder="Message" name="message"></textarea>
                                                <input type="submit" name="sendmessage" class="multiple-send-message"
                                                    value="Submit Request" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Related Properties</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @foreach ($relatedproperty as $key => $property)
                                                <div class="recent-main my-4">
                                                    <div class="recent-img">
                                                        <a href="blog-details.html">
                                                            @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                                                    alt="{{ $property->title }}" class="img-responsive">
                                                            @else
                                                            @endif

                                                    </div>
                                                    <div class="info-img">
                                                        <a href="blog-details.html">
                                                            <h6>{{ str_limit($property->title, 22) }}</h6>
                                                        </a>
                                                        <p>{{ $currency }} {{ number_format($property->price, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <br />
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="widget-boxed mt-5">
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
                                                            <span class="listing-compact-title">House Luxury <i>New
                                                                    York</i></span>
                                                            <ul class="listing-hidden-content">
                                                                <li>Area <span>720 sq ft</span></li>
                                                                <li>Rooms <span>6</span></li>
                                                                <li>Beds <span>2</span></li>
                                                                <li>Baths <span>3</span></li>
                                                            </ul>
                                                        </div>
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-1.jpg') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-2.jpg') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-3.jpg') }}"
                                                            alt="">
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
                                                            <span class="listing-compact-title">House Luxury <i>Miami
                                                                    FL</i></span>
                                                            <ul class="listing-hidden-content">
                                                                <li>Area <span>720 sq ft</span></li>
                                                                <li>Rooms <span>6</span></li>
                                                                <li>Beds <span>2</span></li>
                                                                <li>Baths <span>3</span></li>
                                                            </ul>
                                                        </div>
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-4.jpg') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-5.jpg') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('frontend/findhouse/images/feature-properties/fp-6.jpg') }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- Start: Specials offer -->
                                {{-- <div class="widget-boxed popular mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Specials of the day</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="banner"><img
                                                src="{{ asset('frontend/findhouse/images/single-property/banner.jpg') }}"
                                                alt=""></div>
                                    </div>
                                </div> --}}
                                <!-- End: Specials offer -->
                                <div class="widget-boxed popular mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Popular Tags</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @php
                                                $counter = 1;
                                            @endphp

                                            <div class="tags">

                                                @foreach ($tags as $tag)
                                                    <span><a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                            class="btn btn-outline-primary">{{ $tag->name }}</a></span>

                                                    @if ($counter % 2 === 0)
                                            </div>
                                            <div class="tags">
                                                @endif
                                                @php
                                                    $counter++;
                                                @endphp
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- START SIMILAR PROPERTIES -->
            <section class="similar-property featured portfolio p-0 bg-white-inner">
                <div class="container">
                    <h5>Similar Properties</h5>
                    <div class="row portfolio-items">
                        @foreach ($relatedproperty as $property)
                            <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">
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
                                                <a
                                                    href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
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
                </div>
            </section>
            <!-- END SIMILAR PROPERTIES -->
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
        {{-- <script src="{{ asset('frontend/findhouse/js/map-single.js') }}"></script> --}}
        <script src="{{ asset('frontend/findhouse/js/popup.js') }}"></script>

        <!-- Date Dropper Script-->
        <script>
            $(function() {
                $(document).on('submit', '.agent-message-box', function(e) {
                    e.preventDefault();

                    var data = $(this).serialize();
                    var url = "{{ route('property.message') }}";
                    var btn = $('#msgsubmitbtn');

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        beforeSend: function() {
                            $(btn).addClass('disabled');
                            $(btn).empty().append(
                                '<span>Sending...</span><i class="fa fa-send" aria-hidden="true"></i>'
                            );
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.message) {
                                toastr.success(data.message);
                                // M.toast({
                                //     html: data.message,
                                //     classes: 'green darken-4'
                                // })
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            // console.log(xhr.responseJSON.errors);
                            // toastr.error(xhr.responseJSON.message);

                            Object.keys(xhr.responseJSON.errors).forEach(key => {
                                let msg = xhr.responseJSON.errors[key];
                                toastr.error(msg);
                            });

                            // M.toast({
                            //     html: 'ERROR: Failed to send message!',
                            //     classes: 'red darken-4'
                            // })
                        },
                        complete: function() {
                            $('form.agent-message-box')[0].reset();
                            $(btn).removeClass('disabled');
                            $(btn).empty().append(
                                '<span>Send</span>');
                        },
                        dataType: 'json'
                    });

                })
            })
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
                if ($('#map-contact').length) {
                    var map = L.map('map-contact', {
                        zoom: 5,
                        maxZoom: 20,
                        tap: false,
                        gestureHandling: true,
                        center: [12.818079042852622, 79.69474439948242]
                    });

                    map.scrollWheelZoom.disable();

                    var Hydda_Full = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
                        scrollWheelZoom: false,
                        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    var icon = L.divIcon({
                        html: '<i class="fa fa-building"></i>',
                        iconSize: [50, 50],
                        iconAnchor: [50, 50],
                        popupAnchor: [-20, -42]
                    });

                    var marker = L.marker([12.818079042852622, 79.69474439948242], {
                        icon: icon
                    }).addTo(map);
                }
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
