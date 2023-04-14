@extends('backend.layouts.app')
@section('title', 'Landloard Management')
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
                </div>

                <div class="header">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (!empty($rows['property_landloard']))
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Landloard Name : </strong>
                                        <span class="right" id="customer_name"> {{ $rows['tenant_name'] }}</span>
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
                                        <span class="right" id="rent_date">{{ $rows['rent_payment_commencement'] }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Address : </strong>
                                        <span class="right">{{ $property->type }}</span>
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
                        <li class="active"><a data-toggle="tab" href="#manage_property">Landloard Contract</a></li>
                        <li><a data-toggle="tab" href="#rent">Recursive Rentals</a></li>
                        <li><a data-toggle="tab" href="#fixed_expenses">Landloard Expenses</a></li>
                        <li><a data-toggle="tab" href="#income">Landloard Income</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="manage_property" class="tab-pane fade in active">
                            @include('admin.properties.partials-landloard.contract-tab')
                        </div>

                        @include('admin.properties.partials-landloard.fixed_expenses')

                        @include('admin.properties.partials-landloard.income')

                        @include('admin.properties.partials-landloard.rentals')
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
            $("#deleteDocument").click(function() {
                var id = $(this).data("id");
                var token = $(this).data("token");
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/document/delete/" + id,
                            type: 'DELETE',
                            dataType: "JSON",
                            data: {
                                "id": id,
                                "_method": 'DELETE',
                                "_token": token,
                            },
                            success: function(res) {
                                if (res['success'] == 1) {
                                    swal(
                                        'Deleted!',
                                        'Document has been deleted.',
                                        'success'
                                    )
                                    location.reload(); // show response from the php script.
                                } else {
                                    swal(
                                        'Something wrong!',
                                        'document has not deleted.',
                                        'warning'
                                    )
                                }
                            },
                            error: function() {
                                swal(
                                    'Something wrong!',
                                    'document has not deleted.',
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
            $("#sign_agreement").click(function() {
                var agree_box = $("input[name='agrement_type']:checked").val();
                if (!agree_box) {
                    alert("please agree the checkbox");
                    return;
                }
                swal({
                    title: 'Property Agreement confirmation?',
                    text: "this will assign to customer!",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Agree it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/agreement/sign-agreement",
                            type: 'get',
                            data: {
                                property_id: $("#property_id").val(),
                                agreement_id: $('#agreement_row_id').val(),
                            },
                            success: function(res) {

                                if (res['success'] == 1) {
                                    swal(
                                        'Assigned!',
                                        'Agreement has been confirmed.',
                                        'success'
                                    )
                                    // $("#customer_details").show();
                                    location.reload(); // show response from the php script.

                                    // $("#sign_area").hide();
                                    // $('#customer_name').text(res['customer']);
                                    // $('#lease_duration').text(res['duration']);
                                    // $('#expiry_date').text(res['expiry']);
                                    // $('#rent_date').text(res['rent_date']);

                                } else {
                                    swal(
                                        'Something wrong!',
                                        'Agreement has not assigned.',
                                        'warning'
                                    )
                                }
                            },
                            error: function() {
                                swal(
                                    'Something wrong!',
                                    'Agreement has not assigned.',
                                    'warning'
                                )
                            }
                        });

                    }
                })

            });

            $("#documentForm").submit(function(e) {

                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/document/save-update-document'
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        // location.reload(); // show response from the php script.
                    }
                });

            });
            $("#rentForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/rent/save-update-rent'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.reload(); // show response from the php script.
                    }
                });

            });
            $("#landloard_id").change(function() {
                var id = $('#landloard_id').val()
                $.ajax({
                    url: "/admin/landloards/" + id,
                    type: 'get',
                    data: {
                        //    id:$('#customer_id').val(),
                    },
                    success: function(res) {
                        $('#landloard_name').val(res['first_name'] +' ' + res['last_name']);
                        $('#email').val(res['email']);
                        $('#address').val(res['address']);
                        $('#phone').val(res['phone']);
                    },
                    error: function() {

                    }
                });
            });
            $("#expenseForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/expense/save-update-expense'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.reload(); // show response from the php script.
                    }
                });

            });
            $("#incomeForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/expense/save-update-expense'

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
            $("#utilities").change(function() {
                var sourceText = $(this).val();
                var input_id = '#utilities_arabic';
                var arabicText = translateText(sourceText, input_id);
            });

            $("#building_name_english").change(function() {
                var sourceText = $(this).val();
                var input_id = '#building_name_arabic';
                var arabicText = translateText(sourceText, input_id);
            });
            $("#unit_no").change(function() {
                var sourceText = $(this).val();
                var input_id = '#unit_no_arabic';
                var arabicText = translateText(sourceText, input_id);
            });
            $("#unit_type_english").change(function() {
                var sourceText = $(this).val();
                var input_id = '#unit_type_arabic';
                var arabicText = translateText(sourceText, input_id);
            });
            $("#location_english").change(function() {
                var sourceText = $(this).val();
                var input_id = '#location_arabic';
                var arabicText = translateText(sourceText, input_id);
            });

            $(".mode_of_bill_payment").change(function() {
                var mode_of_bill_payment = $("input[name='mode_of_bill_payment']:checked").val();
                if (mode_of_bill_payment == 'expense_type') {
                    $('#expense_category_id').show();
                    $('#income_category_id').hide();
                } else if (mode_of_bill_payment == 'income_type') {
                    $('#expense_category_id').hide();
                    $('#income_category_id').show();

                }


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
