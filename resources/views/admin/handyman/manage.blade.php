@extends('backend.layouts.app')
@section('title', 'Handiman Management')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
    @endpush
    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">

                <div class="header bg-indigo">
                    <h2> {{ $handyman->first_name }}</h2>
                </div>
                <div class="header">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#new_complaints">New Complaints</a></li>
                        <li><a data-toggle="tab" href="#accepted_complaints">Accepted Complaints </a></li>
                        <li><a data-toggle="tab" href="#progress">Complaints in Progress</a></li>
                        <li><a data-toggle="tab" href="#ressolved">Ressolved</a></li>

                    </ul>
                </div>
                <div class="tab-content">
                    <div id="new_complaints" class="tab-pane fade in active">
                        <div class="body">
                            @if (!empty($new_complaints))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Property</th>
                                                <th>Tenant</th>
                                                <th>Complaint number</th>
                                                <th>Service Type</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($new_complaints as $key => $message)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $message['property_complaint']['property']['product_code'] }}<br />{{ str_limit($message['property_complaint']['property']['title'], 30) }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['customer']['first_name'] . ' ' . $message['property_complaint']['customer']['last_name'] }}<br />
                                                        {{ $message['property_complaint']['customer']['phone'] }}<br />
                                                        {{ $message['property_complaint']['customer']['email'] }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['complaint_number'] }}</td>
                                                    <td>{{ $message['property_complaint']['service_list']['name'] }}
                                                    </td>

                                                    @if ($message['handyman_status'] == 1)
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect"
                                                                onclick="deleteCom({{ $message['id'] }},2)">
                                                                <i class="material-icons">local_library</i>
                                                            </button>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm waves-effect"
                                                                onclick="deleteCom({{ $message['id'] }},5)">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                {{ __('No records found') }}
                            @endif
                        </div>
                    </div>
                    <div id="accepted_complaints" class="tab-pane fade">
                        <div class="body">
                            @if (!empty($accepted_complaints))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Property</th>
                                                <th>Tenant</th>
                                                <th>Complaint number</th>
                                                <th>Service Type</th>
                                                {{-- <th>status</th> --}}

                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($accepted_complaints as $key => $message)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $message['property_complaint']['property']['product_code'] }}<br />{{ str_limit($message['property_complaint']['property']['title'], 30) }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['customer']['first_name'] . ' ' . $message['property_complaint']['customer']['last_name'] }}<br />
                                                        {{ $message['property_complaint']['customer']['phone'] }}<br />
                                                        {{ $message['property_complaint']['customer']['email'] }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['complaint_number'] }}</td>
                                                    <td>{{ $message['property_complaint']['service_list']['name'] }}
                                                    </td>
                                                    {{-- <td>
                                            @if ($message['handyman_status'] == 0)
                                                <span class="badge bg-green"> New </span>
                                            @elseif($message['handyman_status'] == 1)
                                                <span class="badge bg-green"> Approved </span>
                                            @elseif($message['handyman_status'] == 2)
                                                <span class="badge bg-red"> Rejected </span>
                                            @elseif($message['handyman_status'] == 3)
                                                <span class="badge bg-blue"> Assigned to handyman </span>
                                            @elseif($message['handyman_status'] == 4)
                                                <span class="badge bg-pink"> Ressolved </span>
                                            @endif
                                        </td> --}}
                                                    @if ($message['handyman_status'] == 2)
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect"
                                                                onclick="deleteCom({{ $message['id'] }},3)">
                                                                <i class="material-icons">local_library</i> Work Start
                                                            </button>


                                                            {{--  <form action="{{ route('admin.messages.destroy', $message['id']) }}"
                                                method="POST" id="del-message-{{ $message['id'] }}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                {{ __('No records found') }}
                            @endif
                        </div>
                    </div>
                    <div id="progress" class="tab-pane fade">
                        <div class="body">
                            @if (!empty($process_complaints))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Property</th>
                                                <th>Tenant</th>
                                                <th>Complaint number</th>
                                                <th>Service Type</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($process_complaints as $key => $message)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $message['property_complaint']['property']['product_code'] }}<br />{{ str_limit($message['property_complaint']['property']['title'], 30) }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['customer']['first_name'] . ' ' . $message['property_complaint']['customer']['last_name'] }}<br />
                                                        {{ $message['property_complaint']['customer']['phone'] }}<br />
                                                        {{ $message['property_complaint']['customer']['email'] }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['complaint_number'] }}</td>
                                                    <td>{{ $message['property_complaint']['service_list']['name'] }}
                                                    </td>

                                                    @if ($message['handyman_status'] == 3)
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect"
                                                                onclick="deleteCom({{ $message['id'] }},4)">
                                                                <i class="material-icons">local_library</i> work
                                                                Completed
                                                            </button>

                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                {{ __('No records found') }}
                            @endif
                        </div>
                    </div>
                    <div id="ressolved" class="tab-pane fade">
                        <div class="body">
                            @if (!empty($completed_complaints))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Property</th>
                                                <th>Tenant</th>
                                                <th>Complaint number</th>
                                                <th>Service Type</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($completed_complaints as $key => $message)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $message['property_complaint']['property']['product_code'] }}<br />{{ str_limit($message['property_complaint']['property']['title'], 30) }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['customer']['first_name'] . ' ' . $message['property_complaint']['customer']['last_name'] }}<br />
                                                        {{ $message['property_complaint']['customer']['phone'] }}<br />
                                                        {{ $message['property_complaint']['customer']['email'] }}
                                                    </td>
                                                    <td>{{ $message['property_complaint']['complaint_number'] }}</td>
                                                    <td>{{ $message['property_complaint']['service_list']['name'] }}
                                                    </td>

                                                    @if ($message['handyman_status'] == 4)
                                                        <td>
                                                            <button
                                                                class="waves-effect btn-success btn right m-b-15 addbtn add_invoice_model"
                                                                data-toggle="modal" data-target="#invoiceModal"
                                                                data-whatever="@mdo"> <i
                                                                    class="material-icons">local_library</i> Completed
                                                            </button>
                                                            {{-- <button type="button"
                                                                class="btn btn-success btn-sm waves-effect">
                                                                <i class="material-icons">local_library</i> Completed
                                                            </button> --}}

                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                {{ __('No records found') }}
                            @endif
                        </div>
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
    <script>
        function deleteCom(id, status) {

            swal({
                title: 'Are you sure?',
                text: "Changing work status",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/admin/change-handyman-status",
                        type: 'get',
                        data: {
                            id: id,
                            status: status,
                        },
                        success: function(res) {
                            // if (res['success'] == 1) {
                            swal(
                                'Status Changed!',
                                'Complaint has been changed.',
                                'success'
                            )
                            location.reload(); // show response from the php script.
                            // } else {
                            //     swal(
                            //         'Something wrong!',
                            //         'document has not deleted.',
                            //         'warning'
                            //     )
                            // }
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
        };
    </script>
@endpush
