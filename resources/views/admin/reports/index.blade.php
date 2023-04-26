@extends('backend.layouts.app')

@section('title', 'Posts')



@section('content')
    @push('head')
        {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}"> --}}
    @endpush


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>REPORTS ALL</h2>
                </div>
                <div class="body">
                    <!-- Widgets -->
                    <div class="row clearfix">

                        <a href="{{ url('admin/property-expense-report') }}">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">PROPERTY EXPENSE<br />
                                            REPORT</div>
                                        {{-- <div class="number count-to" data-from="0" data-to="{{ $postcount }}" data-speed="1000" data-fresh-interval="20">{{ $postcount }}</div> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('admin/property-income-report') }}">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">PROPERTY INCOME<br />
                                            REPORT</div>
                                        {{-- <div class="number count-to" data-from="0" data-to="{{ $commentcount }}" data-speed="1000" data-fresh-interval="20">{{ $commentcount }}</div> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('admin/agreement-income-report') }}">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">PROPERTY AGREEMENT REPORT</div>
                                        {{-- <div class="number count-to" data-from="0" data-to="{{ $usercount }}" data-speed="1000" data-fresh-interval="20">{{ $usercount }}</div> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row clearfix">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/tenant-service-report') }}">

                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">TENANT SERVICE REPORT</div>
                                        {{-- <div class="number count-to" data-from="0" data-to="{{ $propertycount }}" data-speed="15" data-fresh-interval="20">{{ $propertycount }}</div> --}}
                                    </div>
                                </div>
                            </a>

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('admin/complaint') }}">

                                <div class="info-box bg-pink hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">summarize</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">TENANT REQUESTS</div>
                                        {{-- <div class="number count-to" data-from="0" data-to="{{ $propertycount }}" data-speed="15" data-fresh-interval="20">{{ $propertycount }}</div> --}}
                                    </div>
                                </div>
                            </a>

                        </div>

                    </div>
                    <!-- #END# Widgets -->
                </div>
            </div>
        </div>
    </div>

@endsection
