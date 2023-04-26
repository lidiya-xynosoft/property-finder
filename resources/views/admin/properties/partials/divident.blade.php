<div id="divident" class="tab-pane fade">
    <div class="header" id="income">
        <div class="body">
            <div class="row">
                <div class="block-header">
                    <div class="row">
                           <div class="col-sm-8">
                            @if (isset($rows['people_share']) && $rows['people_share'] > 0)
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Monthly rent amount: </strong>
                                        <span class="right" id="customer_name"> {{ $currency }} {{ $rows['monthly_rent'] }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>No of peoples share : </strong>
                                        <span class="right" id="lease_duration">{{ $rows['people_share'] }}</span>
                                    </li>
                                 
                                     <li class="list-group-item">
                                        <strong>mode of lease : </strong>
                                        <span class="right" id="lease_duration">{{ $rows['lease_mode'] }}</span>
                                    </li>

                                   <li class="list-group-item">
                                        <strong>Per head share : </strong>
                                        <span class="right" id="lease_duration">{{ $currency }} {{ $rows['monthly_rent'] / $rows['people_share']  }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Monthly rent date : </strong>
                                        <span class="right" id="rent_date">{{ $rows['rent_payment_commencement'] }}</span>
                                    </li>
                                </ul>
                                @else
                                <p> No data found</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="body">
                
                </div>
            </div>
            {{--          
            <button class="btn btn-info btn-icon ml-2 mb-2 add_income_model" data-toggle="modal"
                data-target="#incomeModal" data-whatever="@mdo">Add
                Income</button> --}}
        </div>
        <div class="modal fade" id="incomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="incomeForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Income</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input name="property_id" value="{{ $property->id }}" hidden>
                            <input type="text" id="income_type" name="mode_of_bill_payment" value="income_type"
                                hidden />
                            @if (isset($rows['id']))
                                <input name="property_agreement_id" value="{{ $rows['id'] }}" hidden>
                            @endif
                            <div class="form-line">
                                <label for="name">Date<span class="text-red">*</span></label>
                                <input id="date" type="date" class="form-control" name="date">
                            </div>
                            <div class="form-line">
                                <label for="title">Title<span class="text-red">*</span></label>
                                <input id="title" type="text" class="form-control" name="name">
                            </div>
                            <div class="form-line">
                                <label for="reference">reference</label>
                                <input id="reference" type="text" class="form-control" name="reference">
                            </div>
                            <div class="form-line">
                                <label for="ledger_id" class="form-label">Select income
                                    category<span class="text-red">*</span></label>

                                <select name="ledger_id" class="form-control show-tick">
                                    <option value="">-- Please select --</option>

                                    @foreach ($ledger_income as $each_value)
                                        <option value="{{ $each_value->id }}">
                                            {{ $each_value->title }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-line">
                                <label for="expense_amount" class="form-label">Amount<span
                                        class="text-red">*</span></label>

                                <input id="expense_amount" type="text" class="form-control" name="amount">
                            </div>

                            <div class="form-line">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>

                        </div>
                        <div class="form-line">

                            @foreach ($payment_types as $payment_type)
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="radio" id="{{ 'income_' . $payment_type->id }}"
                                            name="payment_type_id" value="{{ $payment_type->id }}" />
                                        <label
                                            for="{{ 'income_' . $payment_type->id }}">{{ $payment_type->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" id="income_submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
