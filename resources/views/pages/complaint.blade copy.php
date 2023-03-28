@extends('frontend.layouts.app')
@section('title', 'Complaint')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
    @endpush
    <section class="headings-7">
        <div class="text-heading text-center">
            <form action="{{ route('tenant.complaint') }}" method="POST" class="bloq-email form-inline"
                @if (isset($tenant_properties) && !empty($tenant_properties)) id="complaint-us" @endif>
                @csrf
                <div class="container">

                    <h1>Register Complaint</h1>

                    <input type="hidden" name="customer_id" value="{{ isset($customer_data) ? $customer_data->id : '' }}">
                    <label for="subscribeEmail" class="error"></label>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="email">
                                <input id="email" name="email" type="email"
                                    value="{{ isset($customer_data) ? $customer_data->email : '' }}"
                                    placeholder="Enter Your registered Email address">
                                @if (isset($tenant_properties) && !empty($tenant_properties))
                                    <button type="submit" id="msgsubmitbtn" class="btn btn-primary btn-lg">Submit</button>
                                @else
                                    <button type="submit" class="btn btn-primary btn-lg">Search</button>
                                @endif

                                <p class="subscription-success"></p>
                            </div>
                        </div>
                        <p class="sorry mt-5">Sorry.... We are improving and fixing problems of our website. We will be back
                            very
                            soon....</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="notification notice closeable">
                                    <p>Tenant Details</p>
                                </div>
                                <div class="header">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb70 formelements">

                                            <input type="text" name="first_name" id="name"
                                                value="{{ isset($customer_data) ? $customer_data->first_name : '' }}"
                                                readonly />

                                            <input type="text" name="last_name" id="last_name"
                                                value="{{ isset($customer_data) ? $customer_data->last_name : '' }}" />
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <input id="phone" name="phone" type="text"
                                                value="{{ isset($customer_data) ? $customer_data->phone : '' }}"
                                                class="form-control input-custom input-full validate">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    @if (isset($tenant_properties) && !empty($tenant_properties))
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="notification notice closeable">
                                        <p>Property Details</p>
                                        {{-- <a class="close" href="#"></a> --}}
                                    </div>
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-6 mb70 formelements">
                                                @foreach ($tenant_properties as $key => $value)
                                                    <div class="card card-widget widget-user">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header text-white">
                                                            <input type="checkbox" name="agreement_id"
                                                                value="{{ $value['agreement_id'] }}">
                                                            <h3 class="widget-user-username text-right">
                                                                {{ $value['property_code'] }}</h3>
                                                            <h5 class="widget-user-desc text-right">
                                                                {{ $value['agreement_number'] }}</h5>
                                                        </div>

                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 border-right">
                                                                    <div class="description-block">
                                                                        <p class="description-header">
                                                                            {{ $value['customer_name'] }}</p>
                                                                        {{-- <span class="description-text">SALES</span> --}}
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-sm-6">
                                                                    <div class="description-block">
                                                                        <p class="description-header">
                                                                            {{ $value['contract_period'] }}</p>
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-sm-12">
                                                                    <div class="description-block">
                                                                        <p class="description-header">
                                                                            {{ $value['property_address'] }}</p>
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>
                                                            <!-- /.row -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                                {{-- <label class="form-label">Choose your Complaint</label>

                                            <div class="select-option">
                                                <i class="ti-angle-down"></i>
                                                <select name="service_list_id">
                                                    <option value="">-- Please select --</option>
                                                    {{-- @foreach ($service_list as $key => $list)
                                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div> --}}

                                            {{-- <textarea placeholder="Textarea" rows="3" id="complaint" name="complaint"></textarea> --}}

                                            <!--end of form elements-->
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <h5 class="uppercase mb40">Form Elements (Options Inputs)</h5>
                                            <div class="select-option">
                                                <i class="ti-angle-down"></i>
                                                <select>
                                                    <option selected value="Default">Select An Option</option>
                                                    <option value="Small">Small</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Larger">Large</option>
                                                </select>
                                            </div>
                                            <!--end select-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                <br />

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="notification notice closeable">
                                <p>Complaint</p>
                                {{-- <a class="close" href="#"></a> --}}
                            </div>
                            <div class="header">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb70 formelements">
                                        <h5 class="uppercase mb40">Form Elements (Tex Inputs)</h5>
                                        <input type="text" placeholder="Input with Placeholder" />
                                        <input type="password" placeholder="Password Input" />

                                        <!--end of form elements-->
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <h5 class="uppercase mb40">Form Elements (Options Inputs)</h5>
                                        <div class="select-option">
                                            <i class="ti-angle-down"></i>
                                            <select>
                                                <option selected value="Default">Select An Option</option>
                                                <option value="Small">Small</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Larger">Large</option>
                                            </select>
                                        </div>
                                        <!--end select-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
        </form>

        </div>
    </section>


    @push('script')
        <script>
            $(function() {
                $(document).on('submit', '#complaint-us', function(e) {
                    e.preventDefault();
                    var data = $(this).serialize();
                    var url = "{{ route('tenant.complaint') }}";
                    var btn = $('#msgsubmitbtn');
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        beforeSend: function() {
                            $(btn).addClass('disabled');
                            $(btn).empty().append(
                                '<span>Submit...</span><i class="fa fa-send" aria-hidden="true"></i>'
                            );
                        },
                        success: function(data) {
                            console.log(data);
                            toastr.success(data.message);
                            window.location.href = data.url;
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            Object.keys(xhr.responseJSON.errors).forEach(key => {
                                let msg = xhr.responseJSON.errors[key];
                                toastr.error(msg);
                            });

                        },
                        complete: function() {
                            $('#complaint-us')[0].reset();
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
