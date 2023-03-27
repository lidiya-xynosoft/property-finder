@extends('backend.layouts.app')

@section('title', 'Read data')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.complaint') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>{{ $data->complaint_number }} - COMPLAINT</h2>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-group">

                                <li class="list-group-item">
                                    <strong>Lease period : </strong>
                                    <span class="right"
                                        id="lease_duration">{{ $agreement_data->lease_commencement }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lease expiry : </strong>
                                    <span class="right" id="expiry_date">{{ $agreement_data->lease_expiry }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Property Type : </strong>
                                    <span class="right" id="rent_date">{{ $data->property->type }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Property code : </strong>
                                    <span class="right" id="rent_date">{{ $data->property->product_code }}</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Tenant Name : </strong>
                                    <span class="right"> {{ $data->customer->first_name }}
                                        {{ $data->customer->last_name }} </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Email : </strong>
                                    <span class="right">{{ $data->customer->email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Contact number : </strong>
                                    <span class="right">{{ $data->customer->phone }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Complaint registered date : </strong>
                                    <span class="right">{{ $data->created_at->toFormattedDateString() }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="body">

                    <h5>message</h5>
                    <p>{!! $data->complaint !!}</p>
                    <hr>

                    <a href="{{ route('admin.complaint.readunread', $data->id) }}"
                        class="btn btn-danger btn-sm waves-effect">
                        <i class="material-icons">replay</i>
                        <span>Reject</span>
                    </a>

                    <form class="right" action="{{ route('admin.complaint.readunread') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="{{ $data->status }}">
                        <input type="hidden" name="dataid" value="{{ $data->id }}">

                        <button type="submit" class="btn btn-success btn-sm waves-effect">
                            <i class="material-icons">local_library</i>
                            @if ($data->status == 0)
                                <span>Accept</span>
                            @elseif($data->status == 1)
                                <span>Assign</span>
                            @elseif($data->status == 3)
                                <span>Ressolved</span>
                            @endif
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
@endpush
