@extends('frontend.layouts.app')
@section('title', 'Agent')
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

    <!-- START SECTION AGENTS DETAILS -->
    <section class="blog blog-section portfolio single-proper details mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <section class="headings-2 pt-0 hee">
                                <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <div class="text-heading text-left">
                                                <p><a href="index.html">Home </a> &nbsp;/&nbsp; <span>Agent Single</span>
                                                </p>
                                            </div>
                                            <h3>{{ $agent->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="news-item news-item-sm">
                                <a href="agent-details.html" class="news-img-link">
                                    <div class="news-item-img homes">
                                        <div class="homes-tag button alt featured">{{ $properties_count }} Listings</div>
                                        <img class="resp-img" src="{{ Storage::url('users/' . $agent->image) }}"
                                            alt="{{ $agent->username }}">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="agent-details.html">
                                        <h3>{{ $agent->name }}</h3>
                                    </a>
                                    <div class="the-agents">
                                        <ul class="the-agents-details">
                                            <li><a href="#">Office: (234) 0200 17813</a></li>
                                            <li><a href="#">Mobile: {{ $agent->contact_no }}</a></li>
                                            <li><a href="#">Email: {{ $agent->email }}</a></li>
                                        </ul>
                                    </div>
                                    {{-- <div class="news-item-bottom">
                                        <a href="properties-full-grid-2.html" class="news-link">View My Listings</a>
                                        <div class="admin">
                                            <p>Company Name</p>
                                            <img src="images/partners/1.png" alt="">
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-pots py-0">
                        <div class="blog-info details mb-30">
                            <h5 class="mb-4">Description</h5>
                            <p class="mb-3">{{ $agent->about }}</p>
                        </div>
                        <!-- START SIMILAR PROPERTIES -->
                        <section class="similar-property featured portfolio bshd p-0 bg-white">
                            <div class="container">
                                <h5>Listing By {{ $agent->name }}</h5>
                                <div class="row">
                                    @foreach ($properties as $property)
                                        <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                            <div class="project-single">
                                                <div class="project-inner project-head">
                                                    <div class="homes">
                                                        <!-- homes img -->
                                                        <a href="{{ route('property.show', $property->slug) }}"
                                                            class="homes-img">
                                                            {{-- <div class="homes-tag button alt featured">Featured</div> --}}
                                                            <div class="homes-tag button alt sale">For
                                                                {{ $property->purpose }}</div>
                                                            <div class="homes-price">${{ number_format($property->price) }}
                                                            </div>
                                                            <img src="{{ Storage::url('property/' . $property->image) }}"
                                                                alt="{{ $property->title }}" class="img-responsive">
                                                        </a>
                                                    </div>
                                                    <div class="button-effect">
                                                        <a href="{{ route('property.show', $property->slug) }}"
                                                            class="btn"><i class="fa fa-link"></i></a>
                                                        <a href="{{ $property->video }}"
                                                            class="btn popup-video popup-youtube"><i
                                                                class="fas fa-video"></i></a>
                                                        <a href="{{ route('property.show', $property->slug) }}"
                                                            class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                                    </div>
                                                </div>
                                                <!-- homes content -->
                                                <div class="homes-content">
                                                    <!-- homes address -->
                                                    <h3><a
                                                            href="single-property-1.html">{{ str_limit($property->title, 25) }}</a>
                                                    </h3>
                                                    <p class="homes-address mb-3">
                                                        <a href="single-property-1.html">
                                                            <i
                                                                class="fa fa-map-marker"></i><span>{{ $property->address }}</span>
                                                        </a>
                                                    </p>
                                                    <!-- homes List -->
                                                    <ul class="homes-list clearfix">
                                                        <li>
                                                            <span>{{ $property->bedroom }} Beds</span>
                                                        </li>
                                                        <li>
                                                            <span>{{ $property->bathroom }} Baths</span>
                                                        </li>
                                                        <li>
                                                            <span>{{ $property->area }} sq ft</span>
                                                        </li>
                                                        <li>
                                                            <span>{{ $property->garage }} Garages</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item col-lg-6 col-md-6 col-xs-12 people rent">
                                            <div class="project-single">
                                                <div class="project-inner project-head">
                                                    <div class="homes">
                                                        <!-- homes img -->
                                                        <a href="single-property-1.html" class="homes-img">
                                                            <div class="homes-tag button sale rent">For Rent</div>
                                                            <div class="homes-price">$3,000</div>
                                                            <img src="images/blog/b-12.jpg" alt="home-1"
                                                                class="img-responsive">
                                                        </a>
                                                    </div>
                                                    <div class="button-effect">
                                                        <a href="single-property-1.html" class="btn"><i
                                                                class="fa fa-link"></i></a>
                                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                                            class="btn popup-video popup-youtube"><i
                                                                class="fas fa-video"></i></a>
                                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                                class="fa fa-photo"></i></a>
                                                    </div>
                                                </div>
                                                <!-- homes content -->
                                                <div class="homes-content">
                                                    <!-- homes address -->
                                                    <h3><a href="single-property-1.html">Luxury House</a></h3>
                                                    <p class="homes-address mb-3">
                                                        <a href="single-property-1.html">
                                                            <i class="fa fa-map-marker"></i><span>Est St, 77 - Central
                                                                Park, NYC</span>
                                                        </a>
                                                    </p>
                                                    <!-- homes List -->
                                                    <ul class="homes-list clearfix">
                                                        <li>
                                                            <span>6 Beds</span>
                                                        </li>
                                                        <li>
                                                            <span>3 Baths</span>
                                                        </li>
                                                        <li>
                                                            <span>720 sq ft</span>
                                                        </li>
                                                        <li>
                                                            <span>2 Garages</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </section>
                        <!-- END SIMILAR PROPERTIES -->
                        <!-- Star Reviews -->
                        <section class="reviews comments">
                            <h3 class="mb-5">3 Reviews</h3>
                            <div class="row mb-5">
                                <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-5.jpg" class="img-fluid" alt="">
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
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                            <div class="rest"><img src="images/single-property/s-1.jpg"
                                                    class="img-fluid" alt=""></div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="row">
                                <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-2.jpg" class="img-fluid" alt="">
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
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="row mt-5">
                                <ul class="col-12 commented mb-0 pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-3.jpg" class="img-fluid" alt="">
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
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                            <div class="resti">
                                                <div class="rest"><img src="images/single-property/s-2.jpg"
                                                        class="img-fluid" alt=""></div>
                                                <div class="rest"><img src="images/single-property/s-3.jpg"
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
                                <h3 class="listing-desc-headline margin-bottom-20 mb-4">Leave A Review For Carls Jhons</h3>
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
                                            <button type="submit" class="btn btn-primary btn-lg mt-2">Submit
                                                Review</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Add Review -->
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">

                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33 mt-5">
                                <div class="sidebar-widget author-widget2">
                                    <div class="agent-contact-form-sidebar border-0 pt-0">
                                        <h4>Contact {{ $agent->name }} </h4>
                                        <form class="agent-message-box" action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="agent_id" value="{{ $agent->id }}">
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
                                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                                            @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                                                    alt="{{ $property->title }}" class="img-responsive">
                                                            @else
                                                            @endif

                                                    </div>
                                                    <div class="info-img">
                                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
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
                                                            <span class="listing-compact-title">House Luxury <i>Miami
                                                                    FL</i></span>
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
                                </div> --}}
                                <!-- Start: Specials offer -->
                                {{-- <div class="widget-boxed popular mt-5">
                                        <div class="widget-boxed-header">
                                            <h4>Specials of the day</h4>
                                        </div>
                                        <div class="widget-boxed-body">
                                            <div class="banner"><img src="images/single-property/banner.jpg" alt=""></div>
                                        </div>
                                    </div> --}}
                                <!-- End: Specials offer -->
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- END SECTION AGENTS DETAILS -->
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
    @endpush
@endsection
