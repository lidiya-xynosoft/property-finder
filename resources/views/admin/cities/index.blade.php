@extends('backend.layouts.app')

@section('title', 'Cities')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endpush

@section('content')

    <div class="block-header">
        <a href="{{ route('admin.cities.create') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CITY LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Order</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $key => $city)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>
                                            @if (Storage::disk('public')->exists('city/' . $city->image))
                                                <img src="{{ Storage::url('city/' . $city->image) }}"
                                                    alt="{{ $city->name }}" width="60"
                                                    class="img-responsive img-rounded">
                                            @endif
                                        </td>
                                        <td>{{ $city->city_order }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.cities.edit', $city->id) }}"
                                                class="btn btn-info btn-sm waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                onclick="deleteCity({{ $city->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('admin.cities.destroy', $city->id) }}"
                                                method="POST" id="del-city-{{ $city->id }}" style="display:none;">
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


@push('scripts')
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
        function deleteCity(id) {

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
                    document.getElementById('del-city-' + id).submit();
                    swal(
                        'Deleted!',
                        'City has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
@endpush
