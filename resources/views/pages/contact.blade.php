@extends('frontend.layouts.app')
@section('title', 'Contact')

@section('content')
    @push('head')
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet-gesture-handling.min.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/leaflet.markercluster.default.css') }}">
    @endpush

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Contact Us</h1>
                <h2><a href="{{ route('home') }}">Home </a> &nbsp;/&nbsp; Contact Us</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION CONTACT US -->
    <section class="contact-us">
        <div class="container">
            <div class="property-location mb-5">
                <h3>Our Location</h3>
                <div class="divider-fade"></div>
                <div id="map-contact" class="contact-map"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h3 class="mb-4">Contact Us</h3>
                    <form id="contact-us" action="" method="POST">
                        @csrf
                        <input type="hidden" name="mailto"
                            value="{{ $contactsettings[0]['email'] ?? 'support@findhouses.com' }}">
                        @auth
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        @endauth
                        <div id="success" class="successform">
                            <p class="alert alert-success font-weight-bold" role="alert">Your message was sent
                                successfully!</p>
                        </div>
                        <div id="error" class="errorform">
                            <p>Something went wrong, try refreshing and submitting the form again.</p>
                        </div>
                        @auth
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->name }}" readonly
                                    class="form-control input-custom input-full validate" name="name" id="name"
                                    placeholder="person">
                            </div>
                        @endauth
                        @guest
                            <div class="form-group">
                                <input type="text" class="form-control input-custom input-full validate" name="name"
                                    id="name" placeholder="person">
                            </div>
                        @endguest


                        @auth
                            <div class="form-group">
                                <input id="email" name="email" type="email"
                                    class="form-control input-custom input-full validate" placeholder="Email"
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>

                        @endauth
                        @guest
                            <div class="form-group">
                                <input id="email" name="email" type="email"
                                    class="form-control input-custom input-full validate" placeholder="Email">
                            </div>
                        @endguest

                        <div class="form-group">
                            <input id="phone" name="phone" type="text"
                                class="form-control input-custom input-full validate" placeholder="Contact number">
                        </div>


                        <div class="form-group">
                            <textarea class="form-control textarea-custom input-full" id="message" name="message" rows="8"
                                placeholder="Message"></textarea>
                        </div>
                        <button type="submit" id="msgsubmitbtn" class="btn btn-primary btn-lg">Submit</button>
                    </form>
                </div>
                <div class="col-lg-4 col-md-12 bgc">
                    <div class="call-info">
                        <h3>Contact Details</h3>
                        <p class="mb-5">Please find below contact details and contact us today!</p>
                        <ul>
                            <li>
                                <div class="info">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    @if (isset($contactsettings[0]) && $contactsettings[0]['address'])
                                        <p class="in-p">{!! $contactsettings[0]['address'] !!}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    @if (isset($contactsettings[0]) && $contactsettings[0]['phone'])
                                        <p class="in-p">{{ $contactsettings[0]['phone'] }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    @if (isset($contactsettings[0]) && $contactsettings[0]['email'])
                                        <p class="in-p ti">{{ $contactsettings[0]['email'] }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="info cll">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <p class="in-p ti">8:00 a.m - 9:00 p.m</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION CONTACT US -->

    @push('script')
        <script src="{{ asset('frontend/findhouse/js/inner.js') }}"></script>
        {{-- <script type="text/javascript" src="{{ asset('frontend/js/materialize.min.js') }}"></script> --}}

        <script src="{{ asset('frontend/findhouse/js/leaflet.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-gesture-handling.min.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet-providers.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/leaflet.markercluster.js') }}"></script>
        <script src="{{ asset('frontend/findhouse/js/map-single.js') }}"></script>

        {{-- {!! Toastr::render() !!} --}}

        <script>
            // $('textarea#message').characterCounter();

            $(function() {
                $(document).on('submit', '#contact-us', function(e) {
                    e.preventDefault();

                    var data = $(this).serialize();
                    var url = "{{ route('contact.message') }}";
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
                               let msg= xhr.responseJSON.errors[key];
                                toastr.error(msg);
                            });

                            // M.toast({
                            //     html: 'ERROR: Failed to send message!',
                            //     classes: 'red darken-4'
                            // })
                        },
                        complete: function() {
                            $('form#contact-us')[0].reset();
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
