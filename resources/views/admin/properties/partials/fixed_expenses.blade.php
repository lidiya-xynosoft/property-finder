<div class="header">
    <div class="property-nearby">
        <form method="POST" id="expenseForm">
            @csrf
            <input name="property_id" value="{{ $property->id }}" hidden>
            <div class="nearby-info mb-4 repeater">
                <span class="nearby-title mb-3 d-block text-danger">
                    <i class="fas fa-car mr-2"></i><b class="title">Add Property Expenses</b>
                     <a  data-repeater-create
                                                class="btn btn-warning btn-sm waves-effect">
                                                <i class="material-icons">add</i>
                                            </a>
                    
                </span>
                <div data-repeater-list="expenses">

                    <br />
                    <div data-repeater-item class="d-flex mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="expense_category_id" class="form-label">Select expense category<span
                                                class="text-red">*</span></label>

                                        <select name="expense_category_id" class="form-control show-tick">
                                            <option value="">-- Please select --</option>

                                            @foreach ($expense_category as $expense)
                                                <option value="{{ $expense->id }}">
                                                    {{ $expense->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="expense_amount" class="form-label">Amount<span
                                                class="text-red">*</span></label>

                                        <input id="expense_amount" type="text" class="form-control"
                                            name="expense_amount" value="{{ isset($expense) ? $expense->amount : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="expense_amount" class="form-label">&nbsp;<span
                                                class="text-red"></span></label>
   
                                    <div  class="table-actions">
                                        <button data-repeater-delete type="button"
                                            class="btn btn-danger btn-sm waves-effect"><i class="material-icons">close</i></button>
                                           
                                    </div>
                                </div>

                            </div>
                        </div><br />
                    </div>
                </div>
            </div>
            <div class="card-footer" align="left">
                <input type="submit" id="expense_submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<div class="header">
    <div class="body">
        <span class="nearby-title mb-3 d-block text-success">
            <i class="fas fa-car mr-2"></i><b class="title">Expenses Overview</b>
        </span>
        <br />
    </div>
    <div class="table-responsive">
        <table id="garageListTable" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                   <th>{{ __('SL') }}</th>
                    <th>{{ __('Expense Name') }}</th>
                    <th>{{ __('Expense Amount') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fixed_expenses as $key=>$expense)
                <tr>
                   <td>{{ $key + 1 }}</td>
                    <td>{{ $expense['expense_category']['title'] }}</td>
                    <td>{{ $expense['amount'] }}</td>
                    
                    <td>
                        <div class="table-actions">

                            {{-- <a href=""> --}}
                                {{-- <button data-repeater-create type="button" class="btn btn-danger btn-icon ml-2 mb-2">
                                    <i class="material-icons">delete</i></button> --}}
                               <button class="btn btn-danger btn-icon ml-2 mb-2 deleteExpense" data-id="{{ $expense['id'] }}" data-token="{{ csrf_token() }}" >Delete</button>
                            {{-- </a> --}}

                            <a href="{{ url('admin/property/manage/?update_id=') . $expense['id']}}">
                                <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2">
                                    <i class="material-icons">edit</i></button>
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

