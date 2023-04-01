@extends('frontend.layouts.app')
@section('title', 'Complaint')

@section('content')
    @push('head')
        <style>
            .error {
                color: red;
            }
        </style>
    @endpush
    <section class="user-page section-padding pt-5">

        <div class="container">
            <form action="{{ route('tenant.complaint') }}" method="POST" class="contact-form" enctype="multipart/form-data"
                @if (isset($tenant_properties) && !empty($tenant_properties)) id="complaint-us" @endif>
                @csrf

                <input type="hidden" name="customer_id" value="{{ isset($customer_data) ? $customer_data->id : '' }}">

                @if (isset($tenant_properties) && !empty($tenant_properties))
                    <div class="single-add-property">
                        <h3>Tenant details</h3>
                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <label for="title">First Name</label>
                                        <input type="text" name="first_name" id="name" readonly
                                            value="{{ isset($customer_data) ? $customer_data->first_name : '' }}">
                                    </p>
                                    <p>
                                        <label for="title">Last Name</label>
                                        <input type="text" name="last_name" id="name" readonly
                                            value="{{ isset($customer_data) ? $customer_data->last_name : '' }}">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label for="title">Email</label>
                                        <input type="text" name="email" id="email" readonly
                                            value="{{ isset($customer_data) ? $customer_data->email : '' }}">
                                    </p>
                                    <p>
                                        <label for="title">Contact number</label>
                                        <input type="text" id="phone" name="phone" type="text" readonly
                                            value="{{ isset($customer_data) ? $customer_data->phone : '' }}">
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>Property Information</h3>
                        <div class="property-form-group">
                            <div id="agreement_error" class="error">
                                <p>Please select property</p>
                            </div>
                            <div class="row">
                                @foreach ($tenant_properties as $key => $value)
                                    <div class="col-lg-6">


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
                                                            <p class="description-header">{{ $value['customer_name'] }}
                                                            </p>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>Complaints</h3>
                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">

                                    <div class="input-with-label text-left">
                                        <span id="service_error" class="">Select Service</span>

                                        <select name="service_list_id">
                                            <option value="">-- select--</option>
                                            @foreach ($service_list as $key => $list)
                                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-with-label text-left">
                                        <span id="complaint_error" class="">Enter Complaint</span>
                                        <textarea class="form-control textarea-custom input-full" id="complaint" name="complaint" rows="8"
                                            placeholder="Message"></textarea>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="input-with-label text-left">
                                        <input type="file" name="complaintimage[]" id="complaintimage" multiple>
                                        <span class="helper-text" data-error="wrong" data-success="right">Upload one
                                            or more images</span>
                                    </div>

                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-with-label text-right">
                                        @if (isset($tenant_properties) && !empty($tenant_properties))
                                            <button type="submit" id="msgsubmitbtn"
                                                class="btn btn-primary btn-lg">Submit</button>
                                        @else
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="single-add-property">
                        <h3>Register Complaints</h3>


                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">

                                    <div class="input-with-label text-left">
                                        <input type="hidden" name="mailto"
                                            value="{{ $contactsettings[0]['email'] ?? 'support@findhouses.com' }}">

                                    </div>
                                    <div class="input-with-label text-left">
                                        <label class="form-label">Email ( Enter registered email address)</label>

                                        <input id="email" name="email" type="email"
                                            value="{{ isset($customer_data) ? $customer_data->email : '' }}"
                                            class="form-control input-custom input-full validate">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input-with-label text-left">
                                        <span>&nbsp;</span>
                                        {{-- <input type="text" id="phone" name="phone" type="text"
                                    value="{{ isset($customer_data) ? $customer_data->phone : '' }}" /> --}}
                                    </div>
                                    <div class="input-with-label text-left">

                                        @if (isset($tenant_properties) && !empty($tenant_properties))
                                            {{-- <button type="submit" id="msgsubmitbtn"
                                            class="btn btn-primary btn-lg">Submit</button> --}}
                                        @else
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </form>
        </div>


        </div>

        </div>
    </section>

    @push('script')
        <script>
            $(function() {
                $('#agreement_error').hide();
                // $(document).on('submit', '#complaint-us', function(e) {
                $("#complaint-us").on('submit', (function(e) {
                    e.preventDefault();
                    console.log(new FormData(this));
                    var customer_id = $("#customer_id").val();
                    if (customer_id != '') {
                        var agreement_id = $("#agreement_id").val();
                        if (!agreement_id) {
                            $('#agreement_error').show();
                        }
                        if (!$("#service_list_id").val()) {
                            var element = document.getElementById("service_error");
                            element.classList.add("error");
                        }
                        if (!$("#complaint").val()) {
                            document.getElementById("complaint_error").classList.add("error");
                        }
                    }
                    var formData = new FormData(this);
                    console.log(formData);
                    var url = "{{ route('tenant.complaint') }}";
                    var btn = $('#msgsubmitbtn');
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $(btn).addClass('disabled');
                            $(btn).empty().append(
                                '<span>Submit...</span><i class="fa fa-send" aria-hidden="true"></i>'
                            );
                        },
                        success: function(data) {
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

                }));
            })
        </script>
    @endpush
@endsection
