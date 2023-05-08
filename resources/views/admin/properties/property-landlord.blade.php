@extends('backend.layouts.app')
@section('title', 'Landlord Management')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
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
    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">

                <div class="header bg-indigo">
                    <input id="property_id" value="{{ $property->id }}" hidden>
                    <h2> {{ $property->title }}</h2>
                    <small>Posted By <strong>{{ $property->user->name }}</strong> on
                        {{ $property->created_at->toFormattedDateString() }}</small>

                    <h2 class="text-right"> UNITS - {{ $units }}</h2>
                  
                </div>

                <div class="header">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (!empty($rows['landlord']))
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Landlord Name : </strong>
                                        <span class="right" id="customer_name">
                                            {{ $rows['landlord']['first_name'] }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Lease period : </strong>
                                        <span class="right" id="lease_duration">{{ $rows['lease_period'] }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Lease expiry : </strong>
                                        <span class="right" id="expiry_date">{{ $rows['lease_expiry'] }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Monthly rent amount : </strong>
                                        <span class="right" id="rent_date">{{ $currency }}
                                            {{ $rows['monthly_rent'] }} /-</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email : </strong>
                                        <span class="right">{{ $rows['landlord']['email'] }}</span>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>


            <div class="card">

                <div class="header">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#manage_property">Landlord Contract</a></li>
                        @if (!empty($rows['landlord']))
                            <li><a data-toggle="tab" href="#rent">Recursive Rentals</a></li>
                            <li><a data-toggle="tab" href="#fixed_expenses">Landlord Expenses</a></li>
                            <li><a data-toggle="tab" href="#income">Landlord Income</a></li>
                            <li><a data-toggle="tab" href="#dividend_rule">Dividend Rule</a></li>
                            <li><a data-toggle="tab" href="#dividend">Dividend</a></li>
                        @endif
                    </ul>

                    <div class="tab-content">

                        <div id="manage_property" class="tab-pane fade in active">
                            @include('admin.properties.partials-landlord.contract-tab')
                        </div>

                        @include('admin.properties.partials-landlord.fixed_expenses')

                        @include('admin.properties.partials-landlord.income')

                        @include('admin.properties.partials-landlord.rentals')
                        @include('admin.properties.partials-landlord.dividend_rule')
                        @include('admin.properties.partials-landlord.dividend')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>


    <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $('.repeater').repeater({
            defaultValues: {
                'this_id': '1',
                'this_name': 'foo'
            }
        });
        (function($) {
            $('#lease-section').hide();
            $('#expense_category_id').hide();
            $('#income_category_id').hide();
            var sourceText = $('#location_english').val();
            var arabicText = translateText(sourceText, '#location_arabic');

            var sourceText = $('#building_name_english').val();
            var arabicText = translateText(sourceText, '#building_name_arabic');

            // e.preventDefault();
            var updateId = $('#update_id').val();
            if ($.isNumeric(updateId) == true) {
                // document.getElementById("lease-section").classList.remove('d-none');
                // document.getElementById("utilities_arabic").classList.remove('d-none');
                $('#lease-section').show();
                $('#utilities_arabic').show();
                $('#result_of_dated_check').show();
                // document.getElementById("result_of_dated_check").classList.remove('d-none');
            }
            'use strict';

            $(".withdrow").click(function() {
                var agreement_id = $(this).data("id");
                var token = $(this).data("token");
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, proceed it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/contract/withdrow/",
                            type: 'get',
                            dataType: "JSON",
                            data: {
                                "id": agreement_id,
                            },
                            success: function(res) {
                                if (res['success'] == 1) {
                                    swal(
                                        'Contract withdrawed!',
                                        'Agreement has been withdrawed.',
                                        'success'
                                    )
                                    location.reload(); // show response from the php script.
                                } else {
                                    swal(
                                        'Something wrong!',
                                        'contract not withdrawed',
                                        'warning'
                                    )
                                }
                            },
                            error: function() {
                                swal(
                                    'Something wrong!',
                                    'Payment not completed',
                                    'warning'
                                )
                            }
                        });

                    }
                })
            });

            $(".payRent").click(function() {
                var id = $(this).data("id");
                var token = $(this).data("token");

                $('#rent_id').val(id);
            });

            $("#landlordRentForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/landlord-rent/save-update-landlord-rent'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.reload(); // show response from the php script.
                    }
                });

            });
            $("#landlord_id").change(function() {
                var id = $('#landlord_id').val()
                $.ajax({
                    url: "/admin/landlords/" + id,
                    type: 'get',
                    data: {
                        //    id:$('#customer_id').val(),
                    },
                    success: function(res) {
                        $('#landlord_name').val(res['first_name'] + ' ' + res['last_name']);
                        $('#email').val(res['email']);
                        $('#address').val(res['address']);
                        $('#phone').val(res['phone']);
                    },
                    error: function() {

                    }
                });
            });
            $("#landlordExpenseForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/landlord-expense/save-update-expense'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.reload(); // show response from the php script.
                    }
                });

            });
            $("#landlordIncomeForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/landlord-expense/save-update-expense'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.reload(); // show response from the php script.
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
                $('#lease-section').show();
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

            function translateText(sourceText, input_id) {
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
                    $(input_id).val(translatedText);
                });

            }
        })(jQuery);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
