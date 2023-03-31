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
            </div>
            <div class="card">
                <div class="header">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#new_complaints">New Complaints</a></li>
                        <li><a data-toggle="tab" href="#handyman_complaints">Handyman Complaints </a></li>
                        <li><a data-toggle="tab" href="#progress">Complaints in Progress</a></li>
                        <li><a data-toggle="tab" href="#ressolved">Ressolved</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="new_complaints" class="tab-pane fade in">
                            <div class="header">
                                <div class="body">
                                   
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
                                    <th>status</th>

                                    <th width="150px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($handyman_complaints as $key => $message)
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
                                            @if ($message['status'] != 4 )
                                                <a href="{{ route('admin.complaint.read', $message['id']) }}"
                                                    class="btn btn-warning btn-sm waves-effect">
                                                    <i class="material-icons">local_library</i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.complaint.read', $message['id']) }}"
                                                    class="btn btn-success btn-sm waves-effect">
                                                    <i class="material-icons">done</i>
                                                </a>
                                            @endif

                                            {{-- <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                onclick="deleteMessage({{ $message['id'] }})">
                                                <i class="material-icons">delete</i>
                                            </button> 
                                            <form action="{{ route('admin.messages.destroy', $message['id']) }}"
                                                method="POST" id="del-message-{{ $message['id'] }}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>--}}
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
        (function($) {

        })(jQuery);
    </script>
@endpush
