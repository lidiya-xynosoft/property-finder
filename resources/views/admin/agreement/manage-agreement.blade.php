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
                            <strong>Lease Period : </strong>
                            <span class="right">{{ $agreement_data['lease_period'] }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Lease Expiry : </strong>
                            <span class="right">{{ $agreement_data['lease_expiry'] }}</span>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Monthly rent : </strong>
                            <span class="right">{{ $agreement_data['monthly_rent'] }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Mode Of Pay : </strong>
                            <span class="right">{{ $agreement_data['payment_mode'] }}</span>
                        </li>

                    </ul>
                </div>


            </div>


            <div class="card">
                <div class="header">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-cyan hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">playlist_add_check</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">TOTAL EXPENSE</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $total_expense }}"
                                            data-speed="15" data-fresh-interval="20">{{ $total_expense }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-light-green hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">credit_score</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">TOTAL INCOME</div>
                                        <div class="number count-to" data-from="0" data-to="{{ $total_income }}"
                                            data-speed="15" data-fresh-interval="20">{{ $total_income }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($documents)
                            <div class="card">
                                <div class="header bg-red">
                                    <h3>Documents</h3>
                                </div>
                                <div class="body">
                                    <div class="gallery-box">
                                        @foreach ($documents as $gallery)
                                            <div class="gallery-image">
                                                <img width="100"
                                                    class="img-responsive img-rounded"
                                                    src="{{ Storage::url($gallery['file']) }}"
                                                    alt="{{ $gallery['id']}}" >
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
