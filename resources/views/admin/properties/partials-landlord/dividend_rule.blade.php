     <div id="dividend_rule" class="tab-pane fade">
     <div class="header" id="dividend_rule">

            {{-- <div class="body"> --}}
            <div class="col-md-12">

                {{-- <div class="card"> --}}
                <div class="card-header">
                    <h4> {{ __('Generate Contract') }}</h4>
                </div>
                <form action="{{ url('admin/landlord/dividend') }}" enctype="multipart/form-data"
                    method="POST" id="dividendForm">
                    @csrf
                    <div class="card-body">
                    
                      
                      
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-line">
                                    <label for="name">Choose Landlord<span class="text-red">*</span></label>

                                    <select class="form-control" name="landlord_id" id="landlord_id" required>

                                        @foreach ($landlords as $customer)
                                            @if (isset($update_data))
                                                <option value="{{ $customer->id }}"
                                                    {{ $customer->id == $update_data->landlord_id ? 'selected' : '' }}>
                                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                                </option>
                                            @else
                                                <option>--select--</option>

                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    <label for="name" class="form-label">Landlord Name:<span
                                            class="text-red">*</span></label>
                                    <input id="landlord_name" type="text" class="form-control" readonly
                                        name="landlord_name"
                                        value="{{ isset($update_data) ? $update_data->landlord->first_name : '' }}"
                                        required="">

                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Telephone<span class="text-red">*</span></label>
                                    <input id="phone" type="text" readonly class="form-control " name="phone"
                                        value="{{ isset($update_data) ? $update_data->landlord->phone : '' }}"
                                        placeholder="Enter Telephone" required="">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Email address<span class="text-red">*</span></label>
                                    <input id="email" type="text" readonly class="form-control " name="email"
                                        value="{{ isset($update_data) ? $update_data->landlord->email : '' }}"
                                        placeholder="Enter Email" required="">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">address<span class="text-red">*</span></label>
                                    <input required id="address" type="text" class="form-control " name="address"
                                        value="{!! isset($update_data) ? $update_data->landlord->address : '' !!}"
                                        placeholder="Enter Location">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                        </div>
                      
                    </div>
                 
            </div>

            @if (isset($update_data))
                <input type="hidden" value="{{ isset($update_data) ? $update_data->id : '' }}" id="update_id"
                    name="update_id">
            @endif
            <div class="card-footer" align="right">
                <a href="{{ url('admin/property/manage?property_id=' . $property->id) }}">
                    <span class="btn btn-dark">{{ __('Back') }}</span>
                </a>
                @if (isset($update_data))
                    <input type="submit" class="btn btn-primary mr-2" value="Update Agreement" name="update_form">
                @else
                    <input type="submit" name="save_draft" value="Save as Draft" class="btn btn-primary mr-2">
                    <input type="reset" value="Clear Form" class="btn btn-light" />
                @endif

            </div>

            </form>
            {{-- </div> --}}

        </div>
        {{-- </div> --}}


    </div>

