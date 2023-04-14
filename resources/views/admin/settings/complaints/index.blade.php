@extends('backend.layouts.app')

@section('title', 'Messages')
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
                    <h2>PROPERTY COMPLAINTS</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{ route('admin.complaint.search') }}" method="POST">
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
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="status" class="form-control">
                                        <option value="">-- select status--</option>
                                        <option value="0">New</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                        <option value="3">Assigned</option>
                                        <option value="3">Ressolved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="service_list_id" class="form-control">
                                        <option value="">-- select Service --</option>
                                        @foreach ($service_lists as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                    <select name="complaint_id" class="form-control">
                                        <option value="">-- select complaint --</option>
                                        @foreach ($complaint_lists as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->complaint_number }}
                                            </option>
                                        @endforeach
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
                                    <th>Complaint number</th>
                                    <th>Service Type</th>
                                    <th>status</th>

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
                                            @if ($message['status'] != 4)
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
                                            <a href="{{ url('admin/complaint-history?id=' .$message['id']) }}"
                                                class="btn btn-info btn-sm waves-effect">
                                                <i class="material-icons">history</i>
                                            </a>
                                         
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
        function deleteMessage(id) {

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
                    document.getElementById('del-message-' + id).submit();
                    swal(
                        'Deleted!',
                        'Message has been deleted.',
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
