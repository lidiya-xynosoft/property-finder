@extends('backend.layouts.app')

@section('title', 'Tenant Service')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @endpush
    <div class="block-header">
        <a href="{{ route('admin.cancellation-reason.create') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CANCELLATION REASON</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($cancellation_reason as $key => $feature)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $feature->reason }}</td>
                                      
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.cancellation-reason.edit', $feature->id) }}"
                                                class="btn btn-info btn-sm waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" id="cancellation_reason"
                                                value="{{ $feature->id }}" onclick="deleteTenantService({{ $feature->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('admin.cancellation-reason.destroy', $feature->id) }}"
                                                method="POST" id="del-feature-{{ $feature->id }}" style="display:none;">
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
        (function($) {
            function deleteAminity(id) {
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
                        document.getElementById('del-feature-' + id).submit();
                        swal(
                            'Deleted!',
                            'Feature has been deleted.',
                            'success'
                        )
                    }
                })
            }
        })(jQuery);
    </script>
@endpush
