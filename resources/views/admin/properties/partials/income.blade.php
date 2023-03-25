<div id="income" class="tab-pane fade">
    <div class="header" id="income">
        <div class="body">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">credit_score</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL INCOME</div>
                            <div class="number count-to" data-from="0" data-to="{{ $total_income }}" data-speed="15"
                                data-fresh-interval="20">{{ $total_income }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="nearby-title mb-3 d-block text-success">
                <i class="fas fa-car mr-2"></i><b class="title">Income Overview</b>
            </span>
            <br />
            <button class="btn btn-info btn-icon ml-2 mb-2 add_income_model" data-toggle="modal"
                data-target="#incomeModal" data-whatever="@mdo">Add
                Income</button>
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
                            <input type="text" id="income_type"
                                name="mode_of_bill_payment" value="income_type" hidden/>
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
        <div class="table-responsive">
            <table id="garageListTable" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Reference') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Amount' . ' (' . $currency . ')') }}</th>
                        {{-- <th>{{ __('Actions') }}</th> --}}
                    </tr>
                    {{-- <th>{{ __('Actions') }}</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($income as $key => $row)
                        <tr>
                         <td>{{ $key + 1 }}</td>
                             <td>{{ $row['ledger']['title'] }}</td>
                             <td>{{ $row['name'] }}</td>
                             <td>{{ $row['description'] }}</td>
                             <td>{{ $row['income_date'] }}</td>
                             <td>{{ $row['amount'] }}</td>


                            {{-- <td>
                        <div class="table-actions">

                            {{-- <a href=""> --}}
                            {{-- <button data-repeater-create type="button" class="btn btn-danger btn-icon ml-2 mb-2">
                                    <i class="material-icons">delete</i></button> --}}
                            {{-- <button class="btn btn-danger btn-icon ml-2 mb-2 deleteProduct" data-id="{{ $expense['id'] }}" data-token="{{ csrf_token() }}" >Delete</button> --}}
                            {{-- </a> --}}

                            {{-- <a href="{{ url('admin/property/manage/?update_id=') . $expense['id'] }}">
                                <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2">
                                    <i class="material-icons">edit</i></button> --}}
                            {{-- </a> --}}

                            {{-- </div> 
                    </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
