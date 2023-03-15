
<div class="header">
    <div class="body">
     <span class="nearby-title mb-3 d-block text-success">
                    <i class="fas fa-car mr-2"></i><b class="title">Income Overview</b> 
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
