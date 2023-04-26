@extends('backend.layouts.app')

@section('title', 'Tenant Service Report')
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
                    <h2>TENANT SERVICE REPORT</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{ route('admin.tenant-service-report') }}" method="POST" id="tenantForm"
                            name="propertyExpenseForm">
                            @csrf


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="customer_id" class="form-control select2">
                                        <option value="">-- select Tenants --</option>
                                        @foreach ($tenants as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->first_name }}
                                                {{ $value->last_name }}
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
                       @if (count($complaints) > 0)

                    <div class="row clearfix">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/tenant-service-report') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">TOTAL COMPLAINTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $total_services }}"
                                            data-speed="15" data-fresh-interval="20">{{ $total_services }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">NEW REQUESTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $new_request }}"
                                            data-speed="15" data-fresh-interval="20">{{ $new_request }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">ACCEPTED REQUESTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $accepted_request }}"
                                            data-speed="15" data-fresh-interval="20">{{ $accepted_request }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">REJECTED REQUESTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $rejected_request }}"
                                            data-speed="15" data-fresh-interval="20">{{ $rejected_request }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">PROCESSED REQUESTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $processed_request }}"
                                            data-speed="15" data-fresh-interval="20">{{ $processed_request }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">RESSOLVED REQUESTS</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $ressolved_request }}"
                                            data-speed="15" data-fresh-interval="20">{{ $ressolved_request }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Property</th>
                                    <th>Tenant</th>
                                    <th>Complaint number</th>
                                    <th>Service Type</th>
                                    <th>date</th>

                                    <th width="150px">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                    @foreach ($complaints as $key => $message)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $message['property']['product_code'] }}<br />{{ str_limit($message['property']['title'], 30) }}
                                            </td>
                                            <td>{{ $message['customer']['first_name'] . ' ' . $message['customer']['last_name'] }}<br />
                                                {{ $message['customer']['phone'] }}<br />
                                                {{ $message['customer']['email'] }}
                                            </td>
                                            <td>{{ $message['complaint_number'] }}</td>
                                            <td>{{ $message['service_list']['name'] }}</td>
                                            <td>
                                                @if ($message['status'] == 0)
                                                    <span class="badge bg-green"> New </span>
                                                @elseif($message['status'] == 1)
                                                    <span class="badge bg-green"> Approved </span>
                                                @elseif($message['status'] == 2)
                                                    <span class="badge bg-red"> Rejected </span>
                                                @elseif($message['status'] == 3)
                                                    <span class="badge bg-blue"> Assigned to handyman </span>
                                                @elseif($message['status'] == 4)
                                                    <span class="badge bg-pink"> Ressolved </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($message['status'] == 0)
                                                    {{ $message['created_at'] }}
                                                @elseif($message['status'] == 1)
                                                    {{ $message['approved_time'] }}
                                                @elseif($message['status'] == 2)
                                                    {{ $message['rejected_time'] }}
                                                @elseif($message['status'] == 3)
                                                    {{ $message['assigned_time'] }}
                                                @elseif($message['status'] == 4)
                                                    {{ $message['resolved_time'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p>No result found</p>
                    @endif
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
                    customer_id: {
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
