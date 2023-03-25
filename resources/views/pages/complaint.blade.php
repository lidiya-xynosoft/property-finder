@extends('frontend.layouts.app')
@section('title', 'Complaint')

@section('content')
    @push('head')
    @endpush


    <section class="contact-us">
        <div class="container">
            <div class="section-title">
                <h3></h3>
                <h3>Complaints</h3>

            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <form action="{{ route('tenant.complaint') }}" method="POST" class="contact-form"  @if (isset($tenant_properties) && !empty($tenant_properties)) id="complaint-us" @endif>
                        @csrf
                        <input type="hidden" name="mailto"
                            value="{{ $contactsettings[0]['email'] ?? 'support@findhouses.com' }}">

                        <div id="success" class="successform">
                            <p class="alert alert-success font-weight-bold" role="alert">Your message was sent
                                successfully!</p>
                        </div>
                        <div id="error" class="errorform">
                            <p>Something went wrong, try refreshing and submitting the form again.</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control input-custom input-full validate" name="first_name"
                                id="name"  value="{{ isset($customer_data) ? $customer_data->first_name : '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>

                            <input type="text" class="form-control input-custom input-full validate" name="last_name"
                                id="name" value="{{ isset($customer_data) ? $customer_data->last_name : '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email ( Enter registered email address)</label>

                            <input id="email" name="email" type="email" value="{{ isset($customer_data) ? $customer_data->email : '' }}"
                                class="form-control input-custom input-full validate">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Contact Number</label>

                            <input id="phone" name="phone" type="text" value="{{ isset($customer_data) ? $customer_data->phone : '' }}"
                                class="form-control input-custom input-full validate">
                        </div>

                </div>
                @if (isset($tenant_properties) && !empty($tenant_properties))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Choose your Complaint</label>
                            <select name="service_list_id" class="form-control input-custom input-full">
                                <option value="">-- Please select --</option>
                                @foreach ($service_list as $key => $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control textarea-custom input-full" id="message" name="message" rows="8"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @foreach ($tenant_properties as $key => $value)
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-white">
                                    <input type="checkbox" name="agreement_id" value="{{ $value['agreement_number'] }}">
                                    <h3 class="widget-user-username text-right">{{ $value['property_code'] }}</h3>
                                    <h5 class="widget-user-desc text-right">{{ $value['agreement_number'] }}</h5>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-6 border-right">
                                            <div class="description-block">
                                                <p class="description-header">{{ $value['customer_name'] }}</p>
                                                {{-- <span class="description-text">SALES</span> --}}
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="description-block">
                                                <p class="description-header">{{ $value['contract_period'] }}</p>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <p class="description-header">{{ $value['property_address'] }}</p>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif


                <div class="form-group">
                    <br />
                    @if (isset($tenant_properties) && !empty($tenant_properties))
                        <button type="submit" id="msgsubmitbtn" class="btn btn-primary btn-lg">Submit</button>
                    @else
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    @endif
                </div>
                </form>
            </div>

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
                            if (data.message) {
                                toastr.success(data.message);
                               location.reload(); // show response from the php script.

                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            Object.keys(xhr.responseJSON.errors).forEach(key => {
                                let msg = xhr.responseJSON.errors[key];
                                toastr.error(msg);
                            });

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
