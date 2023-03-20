<div class="header">
    <div class="body">
        <span class="nearby-title mb-3 d-block text-success">
            <i class="fas fa-car mr-2"></i><b class="title">Rent Overview</b>
        </span>
        <br />
    </div>
    <div class="table-responsive">
        <table id="garageListTable" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>{{ __('SL') }}</th>
                    <th>{{ __('Months') }}</th>
                    <th>{{ __('Rent Amount') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rent_months as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->month . '-' . $data->rental_date }}</td>
                        <td>{{ $data->rent_amount.'/-' }}</td>

                        <td>
                            <div class="table-actions">

                                @if ($data->payment_status == 0)
                                    <button class="btn btn-info btn-icon ml-2 mb-2 payRent"
                                        data-id="{{ $data->id }}" data-token="{{ csrf_token() }}">Receive Rent</button>
                                @else
                                    <button class="btn btn-success btn-icon ml-2 mb-2" data-id=""
                                        data-token="{{ csrf_token() }}">Paid</button>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
