@if (isset($update_data) || !$rows)
    <div id="manage_property" class="tab-pane fade in active">
        <div class="container-fluid">

            {{-- <div class="body"> --}}
            <div class="col-md-12">

                {{-- <div class="card"> --}}
                <div class="card-header">
                    <h4> {{ __('Generate Contract') }}</h4>
                </div>
                <form action="{{ url('admin/landlord/save-update-contract') }}" enctype="multipart/form-data"
                    method="POST" id="contractForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-radio mb-30">
                                    <label>&nbsp;</label>

                                    {{-- <div class="form-line">
                                    <input type="radio" id="agrement_type_new" name="agrement_type"
                                        value="new_agreement" class="filled-in" value="1" checked />
                                    <label for="agrement_type_new">{{ __('New Agrement') }}</label>
                                </div> --}}

                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-radio mb-30">
                                    <label>&nbsp;</label>

                                    {{-- <div class="form-line">
                                    <input type="radio" id="agrement_type_renew" name="agrement_type"
                                        value="renew_agreement" class="filled-in" value="1" />
                                    <label for="agrement_type_renew">{{ __('Renew Agrement') }}</label>
                                </div> --}}

                                </div>
                            </div>
                            <div class="col-sm-3">&nbsp;</div>
                        </div>
                        {{-- <div class="card-header">
                            <h4>{{ __('1.Landlord Details') }}</h4>
                        </div>
                        <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">{{ $settings->name }}</th>
                                        <th class="text-center">الجازي للاستثمار العقاري</th>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <th class="text-center">{{ $settings->address }}</th>
                                        <th class="text-center">صندوق بريد</th>
                                    </tr>
                                    <tr>
                                        <th>Telephone</th>
                                        <th class="text-center">{{ $settings->phone }}</th>
                                        <th class="text-center">{{ $settings->phone }}</th>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="right">&nbsp;</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> --}}
                        <div class="card-header">
                            <h4>{{ __('2. Landlord Details') }}</h4>
                        </div>
                        <br />
                        <input id="property_id" type="hidden" name="property_id"
                            value="{{ isset($property) ? $property->id : '' }}">
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
                        {{-- <div class="card-header">
                            <h4>{{ __('3. Premises Details') }}</h4>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="unit_no">{{ __('Enter Unit No:') }}<span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" id="unit_no" name="unit_no" required>
                                        <option value="{{ $property->product_code }}" $selected>
                                            {{ $property->product_code }}</option>
                                    </select>

                                    <input id="unit_no_arabic" type="hidden" name="unit_no_arabic"
                                        value="{{ isset($update_data) ? $update_data->unit_no_arabic : '' }}">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Building Name(in english) <span
                                            class="text-red">*</span></label>
                                    <input required id="building_name_english" type="text" class="form-control "
                                        name="building_name_english"
                                        value="{{ isset($property) ? $property->title : '' }}"
                                        placeholder="Building Name:">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4 linepass">
                                <div class="form-line">
                                    <label for="name" class="text-right">Building Name(in arabic)
                                        <span class="text-red">*</span></label>
                                    <input required id="building_name_arabic" type="text" dir="rtl"
                                        class="form-control form-control-rtl" name="building_name_arabic"
                                        value="{{ isset($update_data) ? $update_data->building_name_arabic : '' }}"
                                        placeholder="Building Name:">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-line">
                                    <label for="">{{ __('Unit Type(in english)') }}<span
                                            class="text-red">*</span>
                                    </label>
                                    <textarea required class="form-control h-205" name="unit_type_english" id="unit_type_english" rows="2">{{ isset($update_data) ? $update_data->unit_type_english : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 linepass">
                                <div class="form-line">
                                    <label class="text-right">{{ __('Unit Type(in arabic)') }}<span
                                            class="text-red">*</span>
                                    </label>
                                    <textarea dir="rtl" required class="form-control form-control-rtl" name="unit_type_arabic"
                                        id="unit_type_arabic" rows="2">{{ isset($update_data) ? $update_data->unit_type_arabic : '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-line"> <br />
                                    <label for="name">Water Number<span class="text-red">*</span></label>
                                    <input required id="water_no" type="text" class="form-control "
                                        name="water_no" value="{{ isset($property) ? $property->water_no : '' }}"
                                        placeholder="Enter Water Number">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line"><br />
                                    <label for="name">Location(in english)<span class="text-red">*</span></label>
                                    <input required id="location_english" type="text" class="form-control "
                                        name="location_english"
                                        value="{{ isset($property) ? $property->address : '' }}"
                                        placeholder="Enter Location">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4 linepass">
                                <div class="form-line"><br />
                                    <label for="name" class="text-right">Location(in arabic)<span
                                            class="text-red">*</span></label>
                                    <input dir="rtl" required id="location_arabic" type="text"
                                        class="form-control form-control-rtl" name="location_arabic"
                                        value="{{ isset($update_data) ? $update_data->location_arabic : '' }}"
                                        placeholder="Enter Location">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Electricity Number:<span class="text-red">*</span></label>
                                    <input required id="electricity_no" type="text" class="form-control "
                                        name="electricity_no"
                                        value="{{ isset($property) ? $property->electricity_no : '' }}"
                                        placeholder="Enter Electricity Number">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-line">
                                    <label for="name">Building Number:<span class="text-red">*</span></label>
                                    <input required id="building_no" type="text" class="form-control "
                                        name="building_no"
                                        value="{{ isset($property) ? $property->building_no : '' }}"
                                        placeholder="Enter building number">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-line">
                                    <label for="name">Zone:<span class="text-red">*</span></label>
                                    <input required id="zone" type="text" class="form-control "
                                        name="zone" value="{{ isset($property) ? $property->zone_no : '' }}"
                                        placeholder="Enter Zone">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4 linepass">
                                <div class="form-line">
                                    <label for="name">Street:<span class="text-red">*</span></label>
                                    <input required id="street" type="text" class="form-control "
                                        name="street" value="{{ isset($property) ? $property->street_no : '' }}"
                                        placeholder="Enter street">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <input id="premises_utilities" type="hidden" name="premises_utilities" value="">
                        </div> --}}

                        <div class="card-header">
                            <h4>{{ __('3. Contract Terms') }}</h4>
                        </div>

                        <br />
                        <div class="row">

                            <div class="col-sm-3">

                                <div class="form-radio">

                                    <div class="radio radio-inline">
                                        <br />
                                        <div class="form-line">
                                            <input type="radio" id="lease_mode_day" name="lease_mode" value="day"
                                                class="filled-in" />
                                            <label for="lease_mode_day">{{ __('Day') }}</label>
                                        </div>
                                    </div>

                                    <div class="radio radio-inline">
                                        <br />
                                        <div class="form-line">
                                            <input type="radio" id="lease_mode_month" checked name="lease_mode"
                                                value="month" class="filled-in" />
                                            <label for="lease_mode_month">{{ __('Month') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <label for="name">No of days/months<span class="text-red">*</span></label>
                                    <input id="no_of_days" type="text" class="form-control" name="no_of_days"
                                       placeholder="Enter no of days/months">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <label for="name">start date<span class="text-red">*</span></label>
                                    <input id="lease_date"  value="{{ isset($update_data) ? $update_data->lease_commencement : '' }}" type="date" class="form-control" name="lease_date">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <label for="name">&nbsp;</label>
                                    <br />
                                    <span class="btn btn-primary mr-2" id="ok">{{ __('OK') }}</span>
                                    {{-- <button class="btn btn-primary mr-2" id="ok">{{ __('OK') }}</button> --}}
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-line">
                                    <label for="name">&nbsp;<span class="text-red"></span></label>
                                    <span class="badge badge-danger mb-1" id="error"></span>
                                </div>


                            </div>
                            <div class="col-sm-2">&nbsp;</div>
                            <div class="col-sm-2">&nbsp;</div>



                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Lease Period<span class="text-red">*</span></label>
                                    <input id="lease_period" type="text" class="form-control "
                                        name="lease_period"
                                        value="{{ isset($update_data) ? $update_data->lease_period : '' }}"
                                        placeholder="Enter Lease period" readonly>
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Lease Commencement<span class="text-red">*</span></label>
                                    <input id="lease_commencement" type="text" class="form-control "
                                        name="lease_commencement"
                                        value="{{ isset($update_data) ? $update_data->lease_commencement : '' }}"
                                        placeholder="lease commencement" readonly>
                                    <div class="help-block with-errors"></div>

                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    <label for="name">Lease Expiry<span class="text-red">*</span></label>
                                    <input id="lease_expiry" type="text" class="form-control "
                                        name="lease_expiry"
                                        value="{{ isset($update_data) ? $update_data->lease_expiry : '' }}"
                                        placeholder="Enter user name" readonly>
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="lease-section">
                            <div class="col-sm-4">
                                <div class="form-line">
                                    {{-- <label for="name">Lease Period<span class="text-red">*</span></label> --}}
                                    <input id="lease_period_arabic" type="text" class="form-control text-right"
                                        name="lease_period_arabic"
                                        value="{{ isset($update_data) ? $update_data->lease_period_arabic : '' }}"
                                        placeholder="Lease period in Arabic">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    {{-- <label for="name">Lease Commencement<span class="text-red">*</span></label> --}}
                                    <input id="lease_commencement_arabic" type="text"
                                        class="form-control text-right" placeholder="Lase commencement in arabic"
                                        name="lease_commencement_arabic"
                                        value="{{ isset($update_data) ? $update_data->lease_commencement_arabic : '' }}">
                                    <div class="help-block with-errors"></div>

                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-line">
                                    {{-- <label for="name">Lease Expiry<span class="text-red">*</span></label> --}}
                                    <input id="lease_expiry_arabic" type="text" class="form-control text-right"
                                        name="lease_expiry_arabic"
                                        value="{{ isset($update_data) ? $update_data->lease_expiry_arabic : '' }}"
                                        placeholder="Lease Expiry in arabic">
                                    <div class="help-block with-errors"></div>

                                </div>
                            </div>
                        </div>

                        {{-- <div class="card-header">
                            <div class="col-sm-3">
                                <strong>{{ __('4. Financial Terms') }} </strong>
                            </div>

                        </div>
                        <br />
                        <div class="radio-inline">
                            <div class="form-check">
                                <input class="form-check-input utility_case" type="radio" checked
                                    name="utility_case" id="utility_case_excluded" value="excluded">
                                <label class="form-check-label" for="utility_case_excluded">
                                    {{ __('Excluded') }}
                                </label>
                            </div>
                        </div> --}}
                        {{-- <div class="radio-inline">
                            <div class="form-check">
                                <input class="form-check-input utility_case" type="radio" name="utility_case"
                                    id="utility_case_included" value="included">
                                <label class="form-check-label" for="utility_case_included">
                                    {{ __('Included') }}
                                </label>
                            </div>
                        </div> --}}

                    </div>
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-line">
                                <label for="">{{ __('Monthly rent') }}<span class="text-red">*</span>
                                </label>
                                <input id="monthly_rent" type="text" class="form-control" name="monthly_rent"
                                    value="{{ isset($update_data) ? $update_data->monthly_rent : '' }}"
                                    placeholder="Enter monthly rent" required="">
                                <input type="hidden" id="monthly_rent_arabic" name="monthly_rent_arabic"
                                    value="{{ isset($update_data) ? $update_data->monthly_rent_arabic : '' }}">
                            </div>

                        </div>


                        <div class="col-sm-4">
                            <div class="form-line">
                                <label for="name">Security Deposit<span class="text-red">*</span></label>
                                <input id="security_deposit" type="text" class="form-control "
                                    name="security_deposit"
                                    value="{{ isset($update_data) ? $update_data->security_deposit : '' }}"
                                    placeholder="Enter Security Deposit" required="">
                                <div class="help-block with-errors"></div>
                                <input type="hidden" id="security_deposit_arabic" name="security_deposit_arabic"
                                    value="{{ isset($update_data) ? $update_data->security_deposit_arabic : '' }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-line">
                                <label for="name">Cheque Number<span class="text-red">*</span></label>
                                <input id="cheque_no" type="text" class="form-control"
                                    name="cheque_no"
                                    value="{{ isset($update_data) ? $update_data->cheque_no : '' }}"
                                    placeholder="Enter Cheque number" required="">
                                <div class="help-block with-errors"></div>
                             
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-line">
                                <label for="name">No of share holders<span class="text-red">*</span></label>
                                <input id="share_holders" type="number" class="form-control" 
                                    name="share_holders"
                                    value="{{ isset($update_data) ? $update_data->share_holders : '0' }}"
                                    placeholder="Number of share holders" required="">
                                <div class="help-block with-errors"></div>
                             
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-line">
                                <label for="name">Rent payment commencement<span class="text-red">*</span></label>
                                <input id="payment_commencement" type="text" class="form-control "
                                    name="payment_commencement"
                                    value="{{ isset($update_data) ? $update_data->rent_payment_commencement : '' }}"
                                    placeholder="Enter Rent payment date" required="">
                                <div class="help-block with-errors"></div>
                                <input type="hidden" id="payment_commencement_arabic"
                                    name="payment_commencement_arabic"
                                    value="{{ isset($update_data) ? $update_data->rent_payment_commencement_arabic : '' }}">
                            </div>
                        </div>

                    </div>
            </div>

            @if (isset($update_data))
                <input type="hidden" value="{{ isset($update_data) ? $update_data->id : '' }}" id="update_id"
                    name="update_id">
            @endif
            <div class="card-footer" align="right">
                <a href="{{ url('admin/landlord-property/manage?property_id=' . $property->id) }}">
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
@else
    <div class="header">
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
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($agreements as $rows) --}}
                    <tr>
                        <input value="{{ $rows['id'] }}" id="agreement_row_id" hidden>
                        <td>{{ $rows['contract_no'] }}</td>
                        <td>{{ $rows['landlord']['first_name'] }}</td>

                        <td>{{ $rows['landlord']['phone'] }}</td>
                        <td>{{ $rows['lease_period'] }} </td>
                        <td>{{ $rows['lease_expiry'] }}</td>
                        <td>{{ $currency }} {{ $rows['monthly_rent'] }}</td>
                        <td>{{ $rows['landlord']['email'] }}</td>



                        <td>
                            <div class="table-actions">

                                @if ($rows['is_published'] == '0')
                                    <a target="_blank"
                                        href="{{ url('publish-previewed-agreement?list_id=') . $rows['id'] }}">
                                        <button data-repeater-create type="button"
                                            class="btn btn-success btn-icon ml-2 mb-2">Publish</button>
                                    </a>
                                @endif

                                <a href="{{ url('admin/landlord-property/manage/?update_id=') . $rows['id'] }}">
                                    <button data-repeater-create type="button"
                                        class="btn btn-success btn-icon ml-2 mb-2"> <i
                                            class="material-icons">edit</i></button>
                                </a>

                            </div>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

@endif