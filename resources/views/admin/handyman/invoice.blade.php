@extends('backend.layouts.app')

@section('title', 'Read Invoice')

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
                    <h2>INVOICE {{ $invoice_no }} </h2>
                    <div class="text-right">

                    </div>
                </div>
                <div class="header">
                    <div class="row">

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
                        @if (isset($assigned_handyman))
                            <div class="col-sm-6">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>handyman Name : </strong>
                                        <span class="right">
                                            @if (isset($assigned_handyman->handyman->first_name))
                                                {{ $assigned_handyman->handyman->first_name }}
                                                {{ $assigned_handyman->handyman->last_name }}
                                            @endif
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email : </strong>
                                        <span class="right">
                                            @if (isset($assigned_handyman->handyman->first_name))
                                                {{ $assigned_handyman->handyman->email }}
                                            @endif
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Contact number : </strong>
                                        <span class="right">
                                            @if (isset($assigned_handyman->handyman->first_name))
                                                {{ $assigned_handyman->handyman->phone }}
                                            @endif
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Complaint ressolved date : </strong>
                                        <span class="right">{{ $assigned_handyman->work_end_time }}</span>
                                    </li>


                                </ul>
                            </div>
                        @endif
                        {{-- <div class="col-sm-2"></div> --}}
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Items</th>
                                            <th>Item Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($invoice_list as $key => $invoice)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $invoice['item'] }}</td>
                                                <td>{{ $invoice['item_price'] }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>Total</th>
                                            <th>{{ count($invoice_list) }}</th>
                                            <th>{{ $currency }} {{ $total }} /-</th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="col-sm-2"></div> --}}

                    </div>
                </div>
                <div class="body">


                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>
        (function($) {
            $("#cancellationForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/admin/complaint/reject'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        console.log(data);
                        location.reload(); // show response from the php script.
                    }
                });

            });

            $("#actionsForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/admin/complaint/action'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        console.log(data);
                        location.reload(); // show response from the php script.
                    }
                });

            });
        })(jQuery);
    </script>
@endpush
