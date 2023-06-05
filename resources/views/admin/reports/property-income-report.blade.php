@extends('backend.layouts.app')

@section('title', 'Incomes')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
            integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <style>
            .select2-container .select2-selection--single {
                height: 34px !important;
            }

            .select2-container--default .select2-selection--single {
                border: 1px solid #ccc !important;
                border-radius: 0px !important;
            }
        </style>
    @endpush

    <div class="block-header">
        <a href="{{ route('admin.reports') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>PROPERTY INCOME</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{ route('admin.property-income-report') }}" method="POST" name="propertyIncomeForm">
                            @csrf
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="property_id" class="form-control select2">
                                        <option value="">-- select property --</option>
                                        @foreach ($properties as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->product_code }} (
                                                {{ str_limit($value->title, 30) }}) </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="ledger_id" class="form-control select2">
                                        <option value="">-- select Ledger --</option>
                                        @foreach ($ledger as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input id="startDate" type="text" class="form-control" name="start_date"
                                    placeholder="select start date">
                            </div>
                            <div class="col-sm-2">
                                <input id="endDate" type="text" class="form-control" name="end_date"
                                    placeholder="select End date">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-indigo btn-s m-t-15 waves-effect">
                                        <i class="material-icons">search</i>
                                        <span>Search</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Property</th>
                                    @if (!empty($value['property']['property_customer']))
                                        <th>Tenant</th>
                                    @endif
                                    <th>date</th>
                                    <th>Ledger</th>
                                    <th>Name</th>
                                    <th>Income Amount</th>

                                </tr>
                            </thead>

                            <tbody>
                                @if (count($incomes) > 0)
                                    @foreach ($incomes as $key => $income)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $income['property']['product_code'] }}<br />{{ str_limit($income['property']['title'], 30) }}
                                            </td>
                                            @if (!empty($value['property']['property_customer']))
                                                <td>{{ $income['property']['property_customer'][0]['customer']['first_name'] . ' ' . $income['property']['property_customer'][0]['customer']['last_name'] }}<br />
                                                    {{ $income['property']['property_customer'][0]['customer']['phone'] }}<br />
                                                    {{ $income['property']['property_customer'][0]['customer']['email'] }}
                                                </td>
                                            @endif
                                            <td>
                                                {{ $income['date'] }}
                                            </td>
                                            <td>{{ $income['ledger']['title'] }}</td>
                                            <td>{{ $income['name'] }}</td>

                                            <td>{{ $income['amount'] }}</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row text-right">
                        <b>Total Property Income - {{ $total_income }}</b>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('frontend/findhouse/js/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('.select2').select2();

        $(function() {
            $("form[name='propertyIncomeForm']").validate({
                // Define validation rules
                rules: {

                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },

                },
                // Specify validation error messages
                messages: {
                    start_date: "Please select start date",
                    end_date: "Please select end date",
                },

                submitHandler: function(form) {
                    console.log(form);
                    form.submit();
                }
            });
        });
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            endDate: "today",
            format: 'yyyy-mm-dd',
            maxDate: today
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            endDate: "today",
            maxDate: today,
            format: 'yyyy-mm-dd',

            minDate: function() {
                return $('#startDate').val();
            }
        });
    </script>
@endpush
