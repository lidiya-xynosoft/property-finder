@extends('backend.layouts.app')
<?php
use App\Property;
use App\ShareHolder;
?>
@section('title', 'Values')
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
                    <h2>SHARE HOLDER REPORTS</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{ route('admin.share-holder-report') }}" method="POST" id="propertyExpenseForm"
                            name="propertyExpenseForm">
                            @csrf
                              <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="share_holder_id" class="form-control select2">
                                        <option value="">-- select share holders --</option>
                                        @foreach ($share_holder_names as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->first_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
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

                            <div class="col-sm-2">
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
                                    <th>Name</th>
                                    <th>Main Unit</th>
                                    <th>Sub Unit</th>

                                    <th>date</th>
                                    <th>Reference</th>
                                    <th>Ledger</th>
                                    <th>Applied Percentage (%)</th>
                                    <th>Ledger Amount ( {{ $currency }})</th>
                                    <th>Applied Amount ( {{ $currency }})</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($dividends))
                                    @if (count($dividends) > 0)
                                        @foreach ($dividends as $key => $income)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $income['share_holder']['first_name'] }}
                                                </td>
                                                <td><?php echo Property::find($income['parent_property_id'])->title;
                                                echo ' ( ' . Property::find($income['parent_property_id'])->product_code . ' ) '; ?>
                                                </td>
                                                <td>{{ $income['property']['title'] }} (
                                                    {{ $income['property']['product_code'] }} )
                                                </td>
                                                <td>
                                                    {{ $income['date'] }}
                                                </td>
                                                <td>
                                                    @if ($income['reference'] == 1)
                                                        <span class="badge bg-red"> Expense </span>
                                                    @else
                                                        <span class="badge bg-green"> Income </span>
                                                    @endif
                                                </td>
                                                <td>{{ $income['ledger']['title'] }}</td>
                                                <td>{{ $income['applied_percentage'] }} %</td>
                                                <td>{{ $income['reference_amount'] }}</td>

                                                <td>{{ $income['applied_amount'] }}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        @foreach ($share_holders as $key => $total)
                            <div class="text-right"> <b><?php echo ShareHolder::find($key)->first_name; ?> - {{ $total }} {{ $currency }} </b>
                            </div>
                        @endforeach

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

        // $(document).ready(function() {
        $(function() {
            $("form[name='propertyExpenseForm']").validate({
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
        // });
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
