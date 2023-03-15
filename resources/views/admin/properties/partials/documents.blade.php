<div class="header">
    <div class="property-nearby">
        <form>
            <div class="nearby-info mb-4 repeater">
                <span class="nearby-title mb-3 d-block text-danger">
                    <i class="fas fa-car mr-2"></i><b class="title">Add Property Documents</b>
                    <button data-repeater-create type="button" class="btn btn-success ml-0"><i
                            class="fa fa-plus mr-3"></i></button>
                </span>
                <div data-repeater-list="group_c">

                    <br />
                    <div data-repeater-item class="d-flex mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="expense_category_id" class="form-label">Document<span
                                                class="text-red">*</span></label>

                                        <input id="expense_category_id" type="text" class="form-control"
                                            name="expense_category_id"
                                            value="{{ isset($expense) ? $expense->expense_category : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="expense_amount" class="form-label">File<span
                                                class="text-red">*</span></label>

                                        <input id="expense_amount" type="file" class="form-control"
                                            name="expense_amount" value="{{ isset($expense) ? $expense->amount : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <button data-repeater-delete type="button"
                                            class="btn btn-danger btn-icon ml-2"><i
                                                class="fa fa-remove mr-3"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div><br />
                    </div>
                </div>
            </div>
            <div class="card-footer" align="left">
                <input type="submit" name="save_draft" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
 
<div class="header">
    <div class="body">
     <span class="nearby-title mb-3 d-block text-success">
                    <i class="fas fa-car mr-2"></i><b class="title">Documents Uploaded</b> 
                </span>
                <br/>
    </div>
    <div class="table-responsive">
        <table id="garageListTable" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>{{ __('Agreement Number') }}</th>
                    <th>{{ __('Tenant Name') }}</th>
                    <th>{{ __('Tenant Phone') }}</th>
                    <th>{{ __('Lease Period') }}</th>
                    <th>{{ __('Lease Expiry') }}</th>
                    <th>{{ __('Monthly rent') }}</th>
                    <th>{{ __('Mode Of Pay') }}</th>
                    <th>{{ __('PDF') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($agreements as $rows) --}}
                <tr>
                    <td>{{ $rows->agreement_id }}</td>
                    <td>{{ $rows->tenant_name }}</td>

                    <td>{{ $rows->phone }}</td>
                    <td>{{ $rows->lease_period }} </td>
                    <td>{{ $rows->lease_expiry }}</td>
                    <td>{{ $rows->monthly_rent }}</td>
                    <td>{{ $rows->payment_mode }}</td>
                    <td><a href="{{ url('agreement/generate-pdf?agreement_id=') . $rows->id }}" target="_blank"
                            class="btn btn-danger">PDF</a></td>

                    @if ($rows->is_draft == '1')
                        <td>
                            <div class="badge badge-pill badge-secondary">Not Published</div>
                        </td>
                    @else
                        <td>
                            <div class="badge badge-pill badge-primary">Published</div>
                        </td>
                    @endif
                    <td>
                        <div class="table-actions">

                            @if ($rows->is_published == '0')
                                <a target="_blank"
                                    href="{{ url('publish-previewed-agreement?list_id=') . $rows->id }}">
                                    <button data-repeater-create type="button"
                                        class="btn btn-success btn-icon ml-2 mb-2">Publish</button>
                                </a>
                                {{-- @else
                                                     
                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success btn-icon ml-2 mb-2"> View --}}
                            @endif
                            <a href="{{ url('agreement/delete-agreement?id=') . $rows->id }}">
                                <button data-repeater-create type="button" class="btn btn-danger btn-icon ml-2 mb-2">
                                    <i class="material-icons">delete</i></button>
                            </a>

                            <a href="{{ url('admin/property/manage/?update_id=') . $rows->id }}">
                                <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2">
                                    <i class="material-icons">edit</i></button>
                            </a>

                        </div>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
