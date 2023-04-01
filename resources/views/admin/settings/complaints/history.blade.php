@extends('backend.layouts.app')

@section('title', 'Complaints History')



@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @endpush
    <a href="{{ route('admin.complaint') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
        <i class="material-icons left">arrow_back</i>
        <span>BACK</span>
    </a>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>{{ $property_title }} - COMPLAINT HISTORY</h2>
                    <div class="text-right">
                        <span class="btn-info btn-sm">complaint number- #{{ $complaint_number }} </span>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Customer</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>datetime</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($histories as $key => $history)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $history['customer']['first_name'] . ' ' . $history['customer']['last_name'] }}<br />
                                            {{ $history['customer']['phone'] }}<br />
                                            {{ $history['customer']['email'] }}
                                        </td>
                                        <td>{{ $history->title }}</td>
                                        <td>{{ $history->message }}</td>
                                        <td>{{ $history->created_at }}</td>


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
        function deleteHandyman(id) {
            alert("here");
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
                    document.getElementById('del-handyman-' + id).submit();
                    swal(
                        'Deleted!',
                        'Handyman has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
@endpush
