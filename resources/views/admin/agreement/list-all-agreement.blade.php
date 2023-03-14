@extends('layouts.main')
@section('title', 'Agreement Management')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <style>
            .card .card-body .dataTables_wrapper .dataTable {
                margin-left: 0px !important;
            }

        </style>
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('All generated Agreements') }}</h5>
                            <span>{{ __('Listing all Agreement from database') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Forms') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Components') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-block">
                        <h3>{{ __('All Agreements') }}</h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="garageListTable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Agreement Number') }}</th>
                                                <th>{{ __('Tenant Name') }}</th>
                                                <th>{{ __('Tenant Phone') }}</th>
                                                <th>{{ __('Lease Period') }}</th>
                                                <th>{{ __('Lease Expiry') }}</th>
                                                <th>{{ __('Monthly rent') }}</th>
                                                <th>{{ __('Mode Of Pay') }}</th>
                                                <th>{{ __('PDF') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agreement as $rows)
                                                <tr>
                                                    <td>{{ $rows->agreement_id }}</td>
                                                    <td>{{ $rows->tenant_name }}</td>
                                                   
                                                    <td>{{ $rows->phone }}</td>
                                                    <td>{{ $rows->lease_period }} </td>
                                                     <td>{{ $rows->lease_expiry }}</td>
                                                    <td>{{ $rows->monthly_rent }}</td>
                                                    <td>{{ $rows->payment_mode }}</td>
                                                    <td><a href="{{ url('agreement/generate-pdf?agreement_id=') . $rows->id }}"
                                                            target="_blank" class="btn btn-danger">PDF</a></td>
                                                       
                                                        @if ($rows->is_draft == '1')
                                                    <td><div class="badge badge-pill badge-secondary">Not Published</div></td>
                                                @else
                                                    <td><div class="badge badge-pill badge-primary">Published</div></td>
                                            @endif
                                            <td>
                                                <div class="table-actions">

                                                     @if ($rows->is_published == '0')
                                                        <a target="_blank" href="{{ url('publish-previewed-agreement?list_id=') . $rows->id }}">
                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success btn-icon ml-2 mb-2"><i
                                                                class="ik ik-eye-off" title=" update to publish"></i></button>
                                                    </a>
                                                    @else
                                                     
                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success btn-icon ml-2 mb-2"><i
                                                                class="ik ik-eye" title="published"></i></button>
                                                  
                                                    @endif
                                                    <a href="{{ url('agreement/delete-agreement?id=') . $rows->id }}">
                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success btn-icon ml-2 mb-2"><i
                                                                class="ik ik-trash-2" title="Delete agreement"></i></button>
                                                    </a>

                                                    <a href="{{ url('agreement/create-agreement?update_id=') . $rows->id }}">
                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success btn-icon ml-2 mb-2"><i
                                                                class="ik ik-edit-2" title="Edit agreement"></i></button>
                                                    </a>

                                                </div>
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

    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script>
            $(".select2").select2();
            $('#garageListTable').DataTable();
        </script>
    @endpush

@endsection
