
<div class="header">
    <div class="body">
     <span class="nearby-title mb-3 d-block text-success">
                    <i class="fas fa-car mr-2"></i><b class="title">History Overview</b> 
                </span>
                <br/>
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
                               <button class="btn btn-danger btn-icon ml-2 mb-2 deleteProduct" data-id="{{ $expense['id'] }}" data-token="{{ csrf_token() }}" >Delete</button>
                            {{-- </a> --}}

                            <a href="{{ url('admin/property/manage/?update_id=') . $expense['id'] }}">
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

