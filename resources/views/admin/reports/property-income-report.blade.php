@extends('backend.layouts.app')

@section('title', 'Incomes')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
            integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    @endpush

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>PROPERTY INCOME</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{ route('admin.property-income-report') }}" method="POST">
                            @csrf
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="property_id" class="form-control">
                                        <option value="">-- select property --</option>
                                        @foreach ($properties as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->product_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="ledger_id" class="form-control">
                                        <option value="">-- select Ledger --</option>
                                        @foreach ($ledger as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="date" class="form-control">
                                            <option value="0">Current Date </option>
                                            <option value="1">Date Period</option>
                                            <option value="2">Specify Date </option>
                                    </select>
                                </div>
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
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
@push('script')
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
    <script>
        function deleteIncome(id) {

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
                    document.getElementById('del-income-' + id).submit();
                    swal(
                        'Deleted!',
                        'Income has been deleted.',
                        'success'
                    )
                }
            })
        }
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
@endpush