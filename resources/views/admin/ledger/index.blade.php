@extends('backend.layouts.app')

@section('title', 'LEDGER')



@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @endpush
    <div class="block-header">
        <a href="{{ route('admin.ledger.create') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>LEDGER LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ledger as $key => $expense_category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expense_category->title }}</td>
                                        <td>{{ $expense_category->description }}</td>

                                        <td><?php $type = ($expense_category->type == 1) ? 'Payment' : 'Receipt'; ?>
                                        {{ $type }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.ledger.edit', $expense_category->id) }}"
                                                class="btn btn-info btn-sm waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                onclick="deleteService({{ $expense_category->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form
                                                action="{{ route('admin.ledger.destroy', $expense_category->id) }}"
                                                method="POST" id="del-ledger-{{ $expense_category->id }}"
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

    <script>
        function deleteService(id) {

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
                    document.getElementById('del-ledger-' + id).submit();
                    swal(
                        'Deleted!',
                        'Service has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
@endpush
