@extends('backend.layouts.app')
@section('title', 'Agreement Management')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
        <style>
            .table td,
            .table th {
                padding-left: 17px !important;
            }

            .text-right {
                float: right;
                direction: rtl;
                font-weight: bold;
            }
        </style>
    @endpush
    <div class="block-header">
        <a href="{{ route('admin.tenants.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">

        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">

                <div class="header bg-green">
                    <input id="property_id" value="{{ $property->id }}" hidden>
                    <h2> Agreement Contract - {{ $agreement_data['agreement_id'] }} for {{ $property->title }}</h2>
                    <small>contract period
                        <strong>{{ $agreement_data['lease_commencement'] . ' - ' . $agreement_data['lease_expiry'] }}</strong>
                        on
                    </small>
                </div>

                <div class="header">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Agreement Number : </strong>
                                    <span class="right"> {{ $agreement_data['agreement_id'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tenant Name : </strong>
                                    <span class="right">{{ $agreement_data['tenant_name'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tenant Phone : </strong>
                                    <span class="right">{{ $agreement_data['phone'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lease Start : </strong>
                                    <span class="right">{{ $agreement_data['lease_commencement'] }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Monthly rent : </strong>
                                    <span class="right">{{ $currency }}{{ $agreement_data['monthly_rent'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Mode Of Pay : </strong>
                                    <span class="right">{{ $agreement_data['payment_mode'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lease Period : </strong>
                                    <span class="right">{{ $agreement_data['lease_period'] }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lease Expiry : </strong>
                                    <span class="right">{{ $agreement_data['lease_expiry'] }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL EXPENSE</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_expense }}" data-speed="15"
                            data-fresh-interval="20">
                            {{ $currency }}{{ $total_expense }}</div>
                    </div>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Amount' . ' (' . $currency . ')') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fixed_expenses as $key => $expense)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $expense['ledger']['title'] }}</td>
                                            <td>{{ $expense['expense_date'] }}</td>
                                            <td>{{ $expense['amount'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">credit_score</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL INCOME</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_income }}" data-speed="15"
                            data-fresh-interval="20">
                            {{ $currency }}{{ $total_income }}</div>
                    </div>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Amount' . ' (' . $currency . ')') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($income as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row['ledger']['title'] }}</td>
                                            <td>{{ $row['income_date'] }}</td>
                                            <td>{{ $row['amount'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-green">
                    <h2>Property complaints</h2>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>Service Type</th>
                                        <th>complaint</th>
                                        <th>status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaints as $key => $message)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $message['service_list']['name'] }}</td>
                                            <td>{{ str_limit($message['complaint'], 40, '...') }}</td>
                                            <td>
                                                @if ($message['status'] == 0)
                                                    <span class="btn-success btn-sm"> New </span>
                                                @elseif($message['status'] == 1)
                                                    {{ 'Approved' }}
                                                @elseif($message['status'] == 2)
                                                    {{ 'Rejected' }}
                                                @elseif($message['status'] == 3)
                                                    {{ 'Assigned to handiman' }}
                                                @elseif($message['status'] == 4)
                                                    {{ 'Ressolved' }}
                                                @endif
                                            </td>
                                            <td> <a href="{{ route('admin.complaint.read', $message['id']) }}"
                                                    class="btn btn-warning btn-sm waves-effect">
                                                    <i class="material-icons">local_library</i>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-green">
                    <h2>Uploaded Documents</h2>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="gallery-box" id="gallerybox">
                            @foreach ($documents as $gallery)
                                <div class="gallery-image-edit">
                                    <img class="img-responsive" src="{{ Storage::url($gallery['file']) }}">
                                </div>
                            @endforeach
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
      
    @endpush
