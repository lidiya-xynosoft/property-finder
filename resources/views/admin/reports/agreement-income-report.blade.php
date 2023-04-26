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
                <h2>PROPERTY AGREEMENT INCOME</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form action="{{ route('admin.agreement-income-report') }}" method="POST" name="propertyAgreementIncomeForm">
                        @csrf
                       <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="agreement_id" class="form-control select2">
                                        <option value="">-- select agreement --</option>
                                        @foreach ($agreements as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->agreement_id }} (
                                                {{ str_limit($value->property->title, 30) }}) </option>
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
                                <th>Tenant</th>
                                <th>Income Amount</th>
                                <th>Ledger Type</th>
                                <th>name</th>
                                <th>date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($incomes as $key => $income)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $income['property']['product_code'] }}<br />{{ str_limit($income['property']['title'], 30) }}
                                </td>
                                <td>{{ $income['property']['property_customer'][0]['customer']['first_name'] . ' ' . $income['property']['property_customer'][0]['customer']['last_name'] }}<br />
                                    {{ $income['property']['property_customer'][0]['customer']['phone'] }}<br />
                                    {{ $income['property']['property_customer'][0]['customer']['email'] }}
                                </td>
                                <td>{{ $income['amount'] }}</td>
                                <td>{{ $income['ledger']['title'] }}</td>
                                <td>{{ $income['name'] }}</td>

                                <td>
                                    {{ $income['date'] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div>{{ $total_income }}</div> --}}
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
        function deleteValue(id) {

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
                    document.getElementById('del-value-' + id).submit();
                    swal(
                        'Deleted!',
                        'Value has been deleted.',
                        'success'
                    )
                }
            })
        }
        $('.select2').select2();

        $(function() {
                $("form[name='propertyAgreementIncomeForm']").validate({
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