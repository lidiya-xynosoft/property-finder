@extends('backend.layouts.app')

@section('title', 'Messages')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endpush


@section('content')

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
                                    <div class="form-line">
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
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="complaint_id" class="form-control">
                                            <option value="">-- select complaint --</option>
                                            @foreach ($complaints as $key => $value)
                                                <option value="{{ $value['id'] }}">{{ $value['complaint_number'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="property_id" class="form-control">
                                            <option value="">-- select property --</option>
                                            @foreach ($properties as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->product_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
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
                                    <th>Complaint number</th>
                                    <th>Service Type</th>
                                    <th>status</th>
                                    <th>Complaints</th>

                                    <th width="150px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($complaints as $key => $message)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $message['property']['product_code'] }}</td>
                                        <td>{{ $message['complaint_number'] }}</td>
                                        <td>{{ $message['service_list']['name'] }}</td>
                                        <td>
                                            @if ($message['status'] == 0)
                                                <span class="btn-success btn-sm"> New </span>
                                            @elseif($message['status'] == 1)
                                                <span class="btn-success btn-sm"> Approved </span>
                                            @elseif($message['status'] == 2)
                                                <span class="btn-danger btn-sm"> Rejected </span>
                                            @elseif($message['status'] == 3)
                                                {{ 'Assigned to handiman' }}
                                            @elseif($message['status'] == 4)
                                                {{ 'Ressolved' }}
                                            @endif
                                        </td>
                                        <td>{{ str_limit($message['complaint'], 40, '...') }}</td>
                                        <td>
                                            @if ($message['status'] == 0 || $message['status'] == 2)
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

                                            <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                onclick="deleteMessage({{ $message['id'] }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('admin.messages.destroy', $message['id']) }}"
                                                method="POST" id="del-message-{{ $message['id'] }}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
    </script>
@endpush
