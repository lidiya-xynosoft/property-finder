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
                                        @if ($properties_count && isset($properties_count))
                                            @if ($properties_count > 0)
                                                <div class="homes-tag button alt featured">{{ $properties_count }} Listing
                                                </div>
                                            @endif
                                        @endif

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
                                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
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
                                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                            class="btn"><i class="fa fa-link"></i></a>
                                                        <a href="{{ $property->video }}"
                                                            class="btn popup-video popup-youtube"><i
                                                                class="fas fa-video"></i></a>
                                                        <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
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
                                    @endforeach
                                </div>

                            </div>
                        </section>
                        <!-- END SIMILAR PROPERTIES -->

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

                                            <input type="text" id="fname" name="name" placeholder="Full Name" />
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
