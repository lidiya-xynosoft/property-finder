@extends('backend.layouts.app')

@section('title', 'Features')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @endpush
    <div class="block-header">
        <a href="{{ route('admin.share-holder.create') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>SHARE HOLDER LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($share_holder as $key => $share_holder)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $share_holder->first_name }}</td>
                                        <td>{{ $share_holder->last_name }}</td>
                                        <td>{{ $share_holder->email }}</td>
                                        <td>{{ $share_holder->phone }}</td>
                                        <td>
                                            @if ($share_holder->status == '1')
                                            {{ __('Active') }}
                                            @else
                                            {{ __('') }}
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.share-holder.edit', $share_holder->id) }}"
                                                class="btn btn-info btn-sm waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                id="share_holder" value="{{ $share_holder->id }}"
                                                onclick="deleteShareHolder({{ $share_holder->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('admin.share-holder.destroy', $share_holder->id) }}"
                                                method="POST" id="del-share_holder-{{ $share_holder->id }}"
                                                style="display:none;">
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
        function deleteShareHolder(id) {
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
                    document.getElementById('del-share_holder-' + id).submit();
                    swal(
                        'Deleted!',
                        'Share holder has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
@endpush
