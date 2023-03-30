@extends('backend.layouts.app')
@section('title', 'Tenants')
<meta name="csrf-token">
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

    <div class="row clearfix">


        <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>TENANTS LIST</h2>
                </div>



                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Tenant name') }}</th>

                            <th>{{ __('status') }}</th>
                            {{-- <th>{{ __('Actions') }}</th> --}}

                        </tr>
                    </thead>
                </table>
                {{-- <div class="body"> --}}

                <div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
                    @foreach ($tenants as $key => $tenant)
                        <div class="panel panel-info">
                            <div class="panel-heading" id="{{ $key }}" role="tab">
                                <a aria-controls="{{ $tenant['id'] }}" {{-- aria-expanded="@if ($key == 0) ? true : false @endif" --}} aria-expanded="false"
                                    data-parent="#accordion" data-toggle="collapse" href="#{{ $tenant['id'] }}"
                                    role="button">

                                    <div class="col-sm-4">
                                        <h3 class="panel-title">{{ $key + 1 }}</h3>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="panel-title">{{ $tenant['first_name'] . ' ' . $tenant['last_name'] }}
                                        </h3>
                                    </div>
                                    {{-- <div class="col-sm-4"> --}}
                                    <span class="glyphicon glyphicon-collapse-down"></span>
                                    {{-- </div> --}}
                                </a>
                            </div>
                            <div aria-labelledby="{{ $key }}" {{-- class="panel-collapse collapse @if ($key == 0) ? in : '' @endif" --}} class="panel-collapse collapse"
                                id="{{ $tenant['id'] }}" role="tabpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                @foreach ($tenant['property_agreement'] as $key => $data)
                                                    <tr>
                                                        <td>#</td>
                                                        <td>{{ $data['agreement_id'] }}</td>
                                                        <td>{{ $data['lease_commencement'] . ' - ' . $data['lease_expiry'] }}
                                                        </td>
                                                        <td>{{ $data['agreement_id'] }}</td>
                                                        <td class="text-center">
                                                            {{-- <a target="_blank"
                                                                href="{{ url('publish-previewed-agreement?list_id=') .$data['id'] }}">
                                                                <button data-repeater-create type="button"
                                                                    class="btn btn-success btn-icon ml-2 mb-2"><i
                                                                        class="material-icons"
                                                                        title="view agreement">find_in_page</i></button>
                                                            </a> --}}
                                                            <a href="{{ url('admin/agreement/manage/?agreement_id=' . $data['id']) }}"
                                                                class="btn btn-info btn-sm waves-effect">
                                                                <i class="material-icons">visibility</i>
                                                            </a>
                                                            <a href="{{ url('agreement/generate-pdf?agreement_id=') . $data['id'] }}"
                                                                target="black">
                                                                <button data-repeater-create type="button"
                                                                    class="btn btn-success btn-icon ml-2 mb-2">
                                                                    <i class="material-icons">download</i></button>
                                                            </a>


                                                        </td>


                                                    </tr>
                                                @endforeach
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- </div> --}}
            </div>


        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
