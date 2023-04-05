@if (!empty($rows['property_customer']))
    <div class="header">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" id="customer_details">
                    <div class="header">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Customer Name : </strong>
                                <span class="right" id="customer_name"> {{ $rows['tenant_name'] }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Lease period : </strong>
                                <span class="right" id="lease_duration">{{ $rows['lease_period'] }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Lease expiry : </strong>
                                <span class="right" id="expiry_date">{{ $rows['lease_expiry'] }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Monthly rent date : </strong>
                                <span class="right" id="rent_date">{{ $rows['rent_payment_commencement'] }}</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if($rows['is_withdraw'] == 0)
        <div class="footer-body right">
            <button class="btn btn-warning btn-icon ml-2 mb-2 withdrow" data-id="{{ $rows['id'] }}"
                data-token="{{ csrf_token() }}">
                Withdraw Agreement</button>
        </div>
       @endif
    </div>
@else
    <div class="property-nearby" id="sign_area">

        <div class="nearby-info mb-4">
            {{-- <span class="nearby-title mb-3 d-block text-success">
                    <i class="fas fa-car mr-2"></i><b class="title">Add Property Expenses</b> 
                </span> --}}
            <div>

                <br />
                <div class="d-flex mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-line">
                                    <input type="checkbox" id="agrement_type_renew" name="agrement_type"
                                        class="filled-in" value="1" checked />
                                    <label
                                        for="agrement_type_renew">{{ __('An online contract is an agreement that is drafted, signed and executed
                                                                                                                                                                                                                                                                                                                                                electronically via the internet. Online contracts are designed to be read and signed without the need
                                                                                                                                                                                                                                                                                                                                                for physical paper. Signing is done using eSignature technology, whereby a signature can be added to the
                                                                                                                                                                                                                                                                                                                                                contract in a variety of different ways.') }}</label>
                                </div>
                            </div>

                        </div>
                    </div><br />
                </div>
            </div>
        </div>
        <div class="card-footer" align="left">
            <input type="submit" name="sign_agreement" id="sign_agreement" value="Agree this contract"
                class="btn btn-primary">
        </div>

    </div>
@endif
