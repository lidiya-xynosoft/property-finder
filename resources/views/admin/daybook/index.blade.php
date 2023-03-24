@extends('backend.layouts.app')

@section('title', 'ledger')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endpush

@section('content')



    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>TRANSACTION</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Head</th>
                                    <th>Title</th>
                                    <th>Date & Time</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daybook as $key => $entry)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $entry->head }}</td>
                                        <td>{{ $entry->title }}</td>

                                        <td>{{ date('d-m-Y', strtotime($entry->date)) }}
                                            {{ date('h:i a', strtotime($entry->time)) }}</td>
                                        <td>{{ $entry->debit }}</td>
                                        <td>{{ $entry->credit }}</td>
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
