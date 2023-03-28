<div id="history" class="tab-pane fade">
    <div class="header" id="history">
        <div class="body">
            <span class="nearby-title mb-3 d-block text-success">
                <i class="fas fa-car mr-2"></i><b class="title">History Overview</b>
            </span>
            <br />
        </div>
        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Agreement Number') }}</th>
                        <th>{{ __('Contract Period') }}</th>
                        <th>{{ __('Customer Name') }}</th>
                        <th>{{ __('status') }}</th>
                        {{-- <th>{{ __('Actions') }}</th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($property_history as $key => $history)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $history->agreement_id }}</td>
                            <td>{{ $history->lease_commencement . ' - ' . $history->lease_expiry }}</td>
                            <td>{{ $history->tenant_name }}</td>
                            <td>
                                @if ($history->is_withdraw == 1)
                                    {{ 'Withrowed' }}
                                @else
                                    {{ 'Active' }}
                                @endif
                            </td>

                            <td>
                                <div class="table-actions">
                                    
                                    <a href="{{ url('agreement/generate-pdf?agreement_id=') . $history->id }}"
                                        target="black">
                                        <button data-repeater-create type="button"
                                            class="btn btn-success btn-icon ml-2 mb-2">
                                            <i class="material-icons">file_download</i></button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
