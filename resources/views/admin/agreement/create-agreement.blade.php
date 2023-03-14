@extends('layouts.main')
@section('title', 'Agreement Management')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <style>
            .table td,
            .table th {
                padding-left: 17px !important;
            }

            .text-right {
                float: right;
                direction: rtl;
                font-weight: bold;
            }
        </style>
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ isset($update_data) ? 'Update Lease Agrement Details' : 'Generate Lease Agreement' }}
                            </h5>
                            <span>{{ isset($update_data) ? 'Form for updating the Agrement' : 'Form for Generate Lease Agrement' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Forms') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Components') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Generate Lease Agreement') }}</h3>
                    </div>
                    <form action="{{ url('/agreement/save-update-agreement') }}" enctype="multipart/form-data"
                        method="POST" id="agreementForm">
                        @csrf
                        <div class="card-body">



                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="form-radio mb-30">
                                        <label>&nbsp;</label>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="agrement_type" value="new_agreement" checked>
                                                <i class="helper"></i>{{ __('New Agrement') }}
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-radio mb-30">
                                        <label>&nbsp;</label>

                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="agrement_type" value="renew_agreement">
                                                <i class="helper"></i>{{ __('Renew Agrement') }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3">&nbsp;</div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name">Agreement Number<span class="text-red">*</span></label>
                                        <input id="agreement_number" type="text" class="form-control"
                                            name="agreement_number"
                                            value="{{ isset($update_data) ? $update_data->agreement_id : '' }}"
                                            placeholder="Enter agreement number">
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3>{{ __('1.Landlord Details') }}</h3>
                            </div>

                            <div class="row">

                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Al Jazi Real Estate Investment</th>
                                            <th class="text-center">الجازي للاستثمار العقاري</th>
                                        </tr>
                                        <tr>
                                            <th>PO Box</th>
                                            <th class="text-center">22880</th>
                                            <th class="text-center">صندوق بريد</th>
                                        </tr>
                                        <tr>
                                            <th>Telephone</th>
                                            <th class="text-center">+974 4483 3706/8786</th>
                                            <th class="text-center">+974 4483 3706/8786</th>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="right">&nbsp;</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <div class="card-header">
                                <h3>{{ __('2. Tenant Details') }}</h3>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name">Tenant Name:<span class="text-red">*</span></label>
                                        <input id="tenant_name" type="text" class="form-control " name="tenant_name"
                                            value="{{ isset($update_data) ? $update_data->tenant_name : '' }}"
                                            placeholder="Enter tenant name" required="">
                                        <input id="tenant_name_arabic" type="hidden" class="form-control "
                                            name="tenant_name_arabic"
                                            value="{{ isset($update_data) ? $update_data->tenant_name_arabic : '' }}">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">Tenant QID/CR. No.: <span class="text-red">*</span></label>
                                        <input id="tenant_no" type="text" class="form-control " name="tenant_no"
                                            value="{{ isset($update_data) ? $update_data->tenant_no : '' }}"
                                            placeholder="Enter user name" required="">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">P.O Box: <span class="text-red">*</span></label>
                                        <input id="po_box" type="text" class="form-control " name="po_box"
                                            value="{{ isset($update_data) ? $update_data->po_box : '' }}"
                                            placeholder="Enter Box no" required="">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">Telephone<span class="text-red">*</span></label>
                                        <input id="phone" type="text" class="form-control " name="phone"
                                            value="{{ isset($update_data) ? $update_data->phone : '' }}"
                                            placeholder="Enter Telephone" required="">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name">Email address<span class="text-red">*</span></label>
                                        <input id="email" type="text" class="form-control " name="email"
                                            value="{{ isset($update_data) ? $update_data->email : '' }}"
                                            placeholder="Enter Email" required="">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3>{{ __('3. Premises Details') }}</h3>
                            </div>
                            <br />
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Select Unit No:') }}<span class="text-red">*</span>
                                        </label>
                                        <select class="form-control" id="unit_no" name="unit_no" required>
                                            <option value=''>{{ __('--Select Unit No--') }}</option>
                                            @foreach ($premises as $item)
                                                @php
                                                    if (isset($update_data)) {
                                                        if ($item->unit_no == $update_data->unit_no) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    } else {
                                                        $selected = '';
                                                    }
                                                @endphp
                                                <option value="{{ $item->unit_no }}" {{ $selected }}>
                                                    {{ $item->unit_no }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="unit_no_arabic"
                                            value="{{ isset($update_data) ? $update_data->unit_no_arabic : '' }}">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Building Name:<span class="text-red">*</span></label>
                                        <input id="building_name_english" type="text" class="form-control"
                                            name="building_name_english"
                                            value="{{ isset($update_data) ? $update_data->building_name_english : '' }}"
                                            placeholder="Enter Building Name:" readonly>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <input name="building_name_arabic" id="building_name_arabic" type="hidden"
                                    value="{{ isset($update_data) ? $update_data->building_name_arabic : '' }}">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Unit Type:') }}<span class="text-red">*</span>
                                        </label>
                                        <textarea class="form-control h-205" name="unit_type_english" readonly id="unit_type_english" rows="2">
                                                            {{ isset($update_data) ? $update_data->unit_type_english : '' }}
                                                        </textarea>
                                        <input type="hidden" name="unit_type_arabic"
                                            value="{{ isset($update_data) ? $update_data->unit_type_arabic : '' }}">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Electricity No:<span class="text-red">*</span></label>
                                        <input id="electricity_no" type="text" class="form-control "
                                            name="electricity_no"
                                            value="{{ isset($update_data) ? $update_data->electricity_no : '' }}"
                                            placeholder="Enter Electricity no" readonly>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Water No<span class="text-red">*</span></label>
                                        <input id="water_no" type="text" class="form-control " name="water_no"
                                            value="{{ isset($update_data) ? $update_data->water_no : '' }}"
                                            placeholder="Enter Water No" readonly>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Location:<span class="text-red">*</span></label>
                                        <input id="location_english" type="text" class="form-control "
                                            name="location_english"
                                            value="{{ isset($update_data) ? $update_data->location_english : '' }}"
                                            placeholder="Enter Location" readonly>
                                        <div class="help-block with-errors"></div>
                                        {{-- <input type="hidden" name="location_arabic" value="{{ isset($update_data) ? $update_data->location_arabic : ''  }}"> --}}
                                        <input id="premises_utilities" type="hidden" name="premises_utilities"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3>{{ __('3. Lease Terms') }}</h3>
                            </div>

                            <br />
                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="form-radio">

                                        <div class="radio radio-inline">
                                            <br />
                                            <label>
                                                <input type="radio" id="lease_mode" name="lease_mode" value="day">
                                                <i class="helper"></i>{{ __('Day') }}
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <br />
                                            <label>
                                                <input type="radio" id="lease_mode" checked name="lease_mode"
                                                    value="month">
                                                <i class="helper"></i>{{ __('Month') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">No of days/months<span class="text-red">*</span></label>
                                        <input id="no_of_days" type="text" class="form-control" name="no_of_days"
                                            placeholder="Enter no of days/months">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">select date<span class="text-red">*</span></label>
                                        <input id="lease_date" type="date" class="form-control" name="lease_date">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">&nbsp;</label>
                                        <br />
                                        <span class="btn btn-primary mr-2" id="ok">{{ __('OK') }}</span>
                                        {{-- <button class="btn btn-primary mr-2" id="ok">{{ __('OK') }}</button> --}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name">&nbsp;<span class="text-red"></span></label>
                                        <span class="badge badge-danger mb-1" id="error"></span>
                                    </div>


                                </div>
                                <div class="col-sm-2">&nbsp;</div>
                                <div class="col-sm-2">&nbsp;</div>



                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Lease Period<span class="text-red">*</span></label>
                                        <input id="lease_period" type="text" class="form-control "
                                            name="lease_period"
                                            value="{{ isset($update_data) ? $update_data->lease_period : '' }}"
                                            placeholder="Enter Lease period" readonly>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Lease Commencement<span class="text-red">*</span></label>
                                        <input id="lease_commencement" type="text" class="form-control "
                                            name="lease_commencement"
                                            value="{{ isset($update_data) ? $update_data->lease_commencement : '' }}"
                                            placeholder="lease commencement" readonly>
                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Lease Expiry<span class="text-red">*</span></label>
                                        <input id="lease_expiry" type="text" class="form-control "
                                            name="lease_expiry"
                                            value="{{ isset($update_data) ? $update_data->lease_expiry : '' }}"
                                            placeholder="Enter user name" readonly>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="row d-none" id="lease-section">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {{-- <label for="name">Lease Period<span class="text-red">*</span></label> --}}
                                        <input id="lease_period_arabic" type="text" class="form-control text-right"
                                            name="lease_period_arabic"
                                            value="{{ isset($update_data) ? $update_data->lease_period_arabic : '' }}"
                                            placeholder="Lease period in Arabic">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {{-- <label for="name">Lease Commencement<span class="text-red">*</span></label> --}}
                                        <input id="lease_commencement_arabic" type="text"
                                            class="form-control text-right" placeholder="Lase commencement in arabic"
                                            name="lease_commencement_arabic"
                                            value="{{ isset($update_data) ? $update_data->lease_commencement_arabic : '' }}">
                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {{-- <label for="name">Lease Expiry<span class="text-red">*</span></label> --}}
                                        <input id="lease_expiry_arabic" type="text" class="form-control text-right"
                                            name="lease_expiry_arabic"
                                            value="{{ isset($update_data) ? $update_data->lease_expiry_arabic : '' }}"
                                            placeholder="Lease Expiry in arabic">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="col-sm-3">
                                    <h3>{{ __('4. Financial Terms') }} </h3>
                                </div>

                            </div>
                            <br />
                            {{-- <div class="radio radio-inline">
                               
                            </div> --}}
                            <div class=" radio-inline">
                                <label>
                                    <input type="radio" name="utility_case" class="utility_case" value="excluded"
                                        id="utility_case_excluded">
                                    <i class="helper"></i> Excluded
                                </label>
                                <label>
                                    <input type="radio" name="utility_case" class="utility_case" value="included"
                                        id="utility_case_included">
                                    <i class="helper"></i>Included
                                </label>
                            </div>
                            <div class="row">


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Mode of Payment:') }}<span class="text-red">*</span>
                                        </label>
                                        <select class="form-control" name="payment_mode" id="payment_mode" required>

                                            <option value="bank_transfer">Bank transfer</option>
                                            <option value="post_dated_check">Post dated Check</option>
                                        </select>
                                        <input type="hidden" id="post_dated_check_value" name="post_dated_check_value">
                                        <input type="hidden" id="post_dated_check_value_arabic"
                                            name="post_dated_check_value_arabic"
                                            value={{ isset($update_data) ? $update_data->payment_mode_arabic : '' }}>
                                    </div>
                                    <div class="badge badge-secondary d-none" id="result_of_dated_check">

                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group" id="no_of_dated_check_area">
                                        <label for="">{{ __(' Number of check:') }}<span
                                                class="text-red">*</span>
                                        </label>

                                        <input type="number" class="form-control" name="no_of_dated_check"
                                            id="no_of_dated_check" min="1" max="10" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">{{ __('Monthly rent') }}<span class="text-red">*</span>
                                        </label>
                                        <input id="monthly_rent" type="text" class="form-control" name="monthly_rent"
                                            value="{{ isset($update_data) ? $update_data->monthly_rent : '' }}"
                                            placeholder="enter monthly rent" required="">
                                        <input type="hidden" id="monthly_rent_arabic" name="monthly_rent_arabic"
                                            value="{{ isset($update_data) ? $update_data->monthly_rent_arabic : '' }}">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Utilities<span class="text-red">*</span></label>
                                        <input id="utilities" type="text" class="form-control" name="utilities"
                                            value="{{ isset($update_data) ? $update_data->utilities : '' }}"
                                            placeholder="Enter Utilities" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <input type="text" name="utilities_arabic" class="form-control text-right d-none"
                                        id="utilities_arabic"
                                        value="{{ isset($update_data) ? $update_data->utilities_arabic : '' }}">
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Security Deposit<span class="text-red">*</span></label>
                                        <input id="security_deposit" type="text" class="form-control "
                                            name="security_deposit"
                                            value="{{ isset($update_data) ? $update_data->security_deposit : '' }}"
                                            placeholder="Enter Security Deposit" required="">
                                        <div class="help-block with-errors"></div>
                                        <input type="hidden" id="security_deposit_arabic" name="security_deposit_arabic"
                                            value="{{ isset($update_data) ? $update_data->security_deposit_arabic : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Rent payment commencement<span
                                                class="text-red">*</span></label>
                                        <input id="payment_commencement" type="text" class="form-control "
                                            name="payment_commencement"
                                            value="{{ isset($update_data) ? $update_data->rent_payment_commencement : '' }}"
                                            placeholder="Enter Rent payment commencement" required="">
                                        <div class="help-block with-errors"></div>
                                        <input type="hidden" id="payment_commencement_arabic"
                                            name="payment_commencement_arabic"
                                            value="{{ isset($update_data) ? $update_data->rent_payment_commencement_arabic : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Rent Free:<span class="text-red">*</span></label>
                                        <input id="rent_free" type="text" class="form-control " name="rent_free"
                                            value="{{ isset($update_data) ? $update_data->rent_free : '' }}"
                                            placeholder="Enter rent free" required="">
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (isset($update_data))
                            <input type="hidden" value="{{ $update_id }}" id="update_id" name="update_id">
                        @endif
                        <div class="card-footer" align="right">
                            @if (isset($update_data))
                                <input type="submit" class="btn btn-primary mr-2" value="Update Agreement"
                                    name="update_form">
                            @else
                                <input type="submit" name="save_draft" value="Save as Draft"
                                    class="btn btn-primary mr-2">
                            @endif
                            <input type="reset" value="Clear Form" class="btn btn-light" />
                        </div>

                    </form>
                </div>

            </div>
        </div>


    </div>

    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script>
            $(".select2").select2();
            $('#garageListTable').DataTable();
        </script>
        <script>
            (function($) {
                // e.preventDefault();
                var updateId = $('#update_id').val();
                if ($.isNumeric(updateId) == true) {
                    document.getElementById("lease-section").classList.remove('d-none');
                    document.getElementById("utilities_arabic").classList.remove('d-none');
                    // document.getElementById("result_of_dated_check").classList.remove('d-none');
                }
                'use strict';
                $("#unit_no").change(function() {
                    $.ajax({
                        url: "/get-premise-details",
                        type: 'get',
                        data: {
                            premise_id: $(this).val(),
                        },
                        success: function(res) {
                            console.log(res);
                            if (res['success'] == 1) {
                                $('#building_name_english').val(res['building_name_english']);
                                $('#building_name_arabic').val(res['building_name_arabic']);
                                $('#unit_type_english').val(res['unit_type_english']);
                                $('#electricity_no').val(res['electricity_no']);
                                $('#water_no').val(res['water_no']);
                                $('#location_english').val(res['location_english']);
                                $('#premises_utilities').val(res['utilities']);
                                var utility_mode = $("input[name='utility_case']:checked").val();
                                if (utility_mode == 'included') {
                                    $('#utilities').val(res['utilities']);
                                    var input_id = '#utilities_arabic';
                                    var utilities_arabic = translateText(res['utilities'], input_id);
                                    $('#utilities_arabic').val(utilities_arabic);
                                }
                            }
                        },
                        error: function() {
                            alert('failed...');

                        }
                    });
                });

                $("#ok").click(function() {
                    var no_of_days = $("#no_of_days").val();
                    var lease_date = $("#lease_date").val();
                    $('#error').hide();

                    if ($.isNumeric(no_of_days) == false) {
                        $('#error').show();
                        document.getElementById("no_of_days").focus();
                        $('#error').html("Enter number of months / days");
                        return;
                    }
                    if (!lease_date) {
                        $('#error').show();
                        $('#error').html("Select lease date!");
                        return;
                    }
                    var currentDate = moment(lease_date);
                    var commencement = currentDate.format('LL');

                    console.log(commencement);

                    var lease_mode = $("input[name='lease_mode']:checked").val();
                    if (lease_mode == 'month') {

                        var futureMonth = moment(currentDate).add(no_of_days, 'M');
                        var futureMonthEnd = moment(futureMonth).endOf('month');

                        if (currentDate.date() != futureMonth.date() && futureMonth.isSame(futureMonthEnd.format(
                                'YYYY-MM-DD'))) {
                            futureMonth = futureMonth.add(1, 'd');
                        }

                        var expiryDate = futureMonth.format('LL');


                    } else {
                        var futureMonth = moment(currentDate, "DD-MM-YYYY").add(no_of_days, 'days');
                        var expiryDate = futureMonth.format('LL');

                    }
                    var diffDuration = moment.duration(futureMonth.diff(currentDate));
                    var diffYear = diffDuration.years();
                    var diffMonths = diffDuration.months();
                    var diffDays = diffDuration.days();
                    if (diffYear > 0) {
                        var year = diffYear + ' Year ';
                    } else {
                        var year = '';
                    }
                    if (diffMonths > 0) {
                        var month = diffMonths + ' Months ';
                    } else {
                        var month = '';
                    }
                    if (diffDays > 0) {
                        var day = diffDays + ' days ';
                    } else {
                        var day = '';
                    }
                    var period = year + month + day;
                    $('#lease_expiry').val(expiryDate);
                    $('#lease_period').val(period);
                    $('#lease_commencement').val(commencement);
                    document.getElementById("lease-section").classList.remove('d-none');
                    var input_id = '#lease_expiry_arabic';
                    var lease_expiry_arabic = translateText(expiryDate, input_id);
                    $('#lease_expiry_arabic').val(lease_expiry_arabic);

                    var input_id2 = '#lease_period_arabic';
                    var lease_period_arabic = translateText(period, input_id2);
                    $('#lease_period_arabic').val(lease_period_arabic);

                    var input_id3 = '#lease_commencement_arabic';
                    var lease_commencement_arabic = translateText(commencement, input_id3);
                    $('#lease_commencement_arabic').val(lease_commencement_arabic);
                });

                $(".utility_case").change(function() {
                    var utility_mode = $("input[name='utility_case']:checked").val();
                    console.log(utility_mode);
                    $('#utilities').val('');
                    if (utility_mode == 'excluded') {
                        $('#utilities').val('Excluded');
                        $('#utilities_arabic').val('مستبعد');
                    } else if (utility_mode == 'included') {
                        var utilities = $('#premises_utilities').val();
                        $('#utilities').val(utilities);
                        var input_id = '#utilities_arabic';
                        var utilities_arabic = translateText(utilities, input_id);
                        $('#utilities_arabic').val();
                    }
                    document.getElementById('utilities_arabic').classList.remove('d-none');


                });

                $("#payment_mode").change(function() {
                    var payment_mode = $('#payment_mode').val();
                    console.log(payment_mode);
                    if (payment_mode == 'post_dated_check') {

                        $('#no_of_dated_check').removeAttr("disabled");
                        var no_of_check = $('#no_of_dated_check').val();
                        if (no_of_check > 0) {
                            $("#payment_mode option[value=post_dated_check]").val(no_of_check + 'Post dated check');
                            $("#post_dated_check_value").val(no_of_check + 'Post dated check');
                            $("#post_dated_check_value_arabic").val('تفتيش مؤرخة' + no_of_check);
                        }
                    } else {
                        $("#no_of_dated_check").attr("disabled", true);
                        $("#post_dated_check_value").val('');
                        $('#no_of_dated_check').val('');
                        $("#post_dated_check_value_arabic").val('التحويل المصرفي');
                        var displayText = 'التحويل المصرفي';
                        $('#result_of_dated_check').html(displayText);
                        document.getElementById("result_of_dated_check").classList.remove('d-none');
                        // document.getElementById("result_of_dated_check").classList.add('d-none');
                    }

                });
                $("#no_of_dated_check").change(function() {
                    document.getElementById("result_of_dated_check").classList.remove('d-none');
                    document.getElementById("result_of_dated_check").classList.add('d-block');
                    var no_of_check = $('#no_of_dated_check').val();
                    var displayText = no_of_check + ' Post dated check / ' + 'تفتيش مؤرخة ' + no_of_check;
                    $('#result_of_dated_check').html(displayText);
                });

                $("#monthly_rent").change(function() {
                    var sourceText = $(this).val();
                    var input_id = '#monthly_rent_arabic';
                    var arabicText = translateText(sourceText, input_id);
                });
                $("#payment_commencement").change(function() {
                    var sourceText = $(this).val();
                    var input_id = '#payment_commencement_arabic';
                    var arabicText = translateText(sourceText, input_id);
                });
                $("#security_deposit").change(function() {
                    var sourceText = $(this).val();
                    var input_id = '#security_deposit_arabic';
                    var arabicText = translateText(sourceText, input_id);
                });
                $("#tenant_name").change(function() {
                    var sourceText = $(this).val();
                    var input_id = '#tenant_name_arabic';
                    var arabicText = translateText(sourceText, input_id);
                });

                function translateText(sourceText, input_id) {
                    console.log(sourceText, input_id);
                    var sourceLang = "en";
                    var targetLang = "ar";

                    var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" + sourceLang + "&tl=" +
                        targetLang + "&dt=t&q=" + encodeURI(sourceText);

                    $.get(url, function(result, status) {
                        var translatedText = result[0][0][0];
                        var json = {
                            'sourceText': sourceText,
                            'translatedText': translatedText
                        };
                        console.log(json);
                        $(input_id).val(translatedText);
                    });

                }
            })(jQuery);
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush

@endsection
