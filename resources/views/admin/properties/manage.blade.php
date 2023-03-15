@extends('backend.layouts.app')
@section('title', 'Agreement Management')
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
                    <h2> {{ $property->title }}</h2>
                    <small>Posted By <strong>{{ $property->user->name }}</strong> on
                        {{ $property->created_at->toFormattedDateString() }}</small>
                </div>

                <div class="header">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Price : </strong>
                            <span class="right"> &dollar;{{ $property->price }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Bedroom : </strong>
                            <span class="right">{{ $property->bedroom }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Bathroom : </strong>
                            <span class="right">{{ $property->bathroom }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>City : </strong>
                            <span class="right">{{ $property->city }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Address : </strong>
                            <span class="right">{{ $property->address }}</span>
                        </li>
                    </ul>
                </div>


            </div>


            <div class="card">

                <div class="header">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#manage_property">Manage Property</a></li>
                        <li><a data-toggle="tab" href="#sign_agreement">Sign Agreement</a></li>
                        <li><a data-toggle="tab" href="#fixed_expenses">Fixed Expenses</a></li>
                        <li><a data-toggle="tab" href="#income">Income</a></li>
                        <li><a data-toggle="tab" href="#rent">Recursive rentals</a></li>
                        <li><a data-toggle="tab" href="#document">Property Documents</a></li>
                        <li><a data-toggle="tab" href="#history">History</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="manage_property" class="tab-pane fade in active">
                            @include('admin.properties.partials.agreement-tab')

                        </div>
                        <div id="sign_agreement" class="tab-pane fade">
                            @include('admin.properties.partials.agreement-sign')
                        </div>
                        <div id="fixed_expenses" class="tab-pane fade">
                            @include('admin.properties.partials.fixed_expenses')
                        </div>
                        <div id="income" class="tab-pane fade">
                            @include('admin.properties.partials.income')
                        </div>
                        <div id="rent" class="tab-pane fade">
                            @include('admin.properties.partials.rentals')
                        </div>
                        <div id="document" class="tab-pane fade">
                            @include('admin.properties.partials.documents')
                        </div>
                        <div id="history" class="tab-pane fade">
                            @include('admin.properties.partials.history')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('script')
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
            $('#utilities_arabic').hide();
            $('#result_of_dated_check').hide();

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
                // document.getElementById("result_of_dated_check").classList.remove('d-none');
            }
            'use strict';
            $("#unit_no").click(function() {
                var utility_mode = $("input[name='utility_case']:checked").val();
                var utilities = $('#utilities').val();
                $('#premises_utilities').val(utilities);

                if (utility_mode == 'included') {
                    $('#utilities').val(utilities);
                    var input_id = '#utilities_arabic';
                    var utilities_arabic = translateText(utilities, input_id);
                    $('#utilities_arabic').val(utilities_arabic);
                }

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
                // document.getElementById("lease-section").classList.remove('d-none');
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
                // document.getElementById('utilities_arabic').classList.remove('d-none');
                $('#utilities_arabic').show();


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
                    // document.getElementById("result_of_dated_check").classList.remove('d-none');
                    $('#result_of_dated_check').show();

                }

            });
            $("#no_of_dated_check").change(function() {
                // document.getElementById("result_of_dated_check").classList.remove('d-none');
                $('#result_of_dated_check').show();

                // document.getElementById("result_of_dated_check").classList.add('d-block');
                $('#result_of_dated_check').hide();

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
