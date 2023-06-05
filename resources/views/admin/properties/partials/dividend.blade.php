     <div id="dividend" class="tab-pane fade">
         <div class="header" id="dividend_rule">

             <div class="body">
                 @if (!empty($rows))

                     @if ($rows['people_share'] > 0)
                         <div class="col-md-12">

                             {{-- <div class="card"> --}}
                             <div class="card-header">
                                 {{-- <h4> {{ __('Generate Contract') }}</h4> --}}
                             </div>
                             <form action="{{ url('admin/landlord/save-dividend-rule') }}" enctype="multipart/form-data"
                                 method="POST" id="dividend_rule_form">
                                 @csrf
                                 <div class="card-body">
                                     <div class="row">
                                         <input id="property_id" type="hidden" name="property_id"
                                             value="{{ isset($property) ? $property->id : '' }}">

                                         <input name="property_agreement_id" value="{{ $rows['id'] }}" hidden>
                                         <input name="share_holders" value="{{ $rows['people_share'] }}" hidden>

                                         <div class="nearby-info mb-4 repeater">
                                             <div data-repeater-list="dividend_persons">
                                                 <div class="row">

                                                     <div class="col-md-4">
                                                         <p> List down your
                                                             {{ isset($rows) ? $rows['people_share'] : '0' }}
                                                             share
                                                             holders</p>
                                                     </div>
                                                     <div class="col-md-2">
                                                         <span data-repeater-create class="btn badge bg-green"> +
                                                         </span>
                                                     </div>
                                                 </div>

                                                 @if (count($dividend_rule) <= 0)
                                                     {{-- <div class="row">
                                                         <div class="col-md-5">
                                                             <label class="form-label">Person Name</label>
                                                             <input type="text" class="form-control"
                                                                 name="person_name" placeholder="Enter person name"
                                                                 required>
                                                         </div>
                                                         <div class="col-md-5">
                                                             <label class="form-label">Percentage (%)</label>
                                                             <input type="number" class="form-control"
                                                                 name="percentage" placeholder="Enter percentage"
                                                                 required>
                                                         </div>
                                                         <div class="col-md-2">
                                                             <span data-repeater-delete class="btn badge bg-red"> x
                                                             </span>
                                                         </div>
                                                     </div> --}}
                                                 @else
                                                     @foreach ($dividend_rule as $key => $value)
                                                         <div class="row dividend-rule-edit"
                                                             id="dividend-{{ $value->id }}">
                                                             <div class="col-md-5">
                                                                 <select class="form-control" name="share_holder_id"
                                                                     id="share_holder_id" required>

                                                                     @foreach ($share_holders as $customer)
                                                                         <option value="{{ $value->id }}"
                                                                             {{ $customer->id == $value->share_holder_id ? 'selected' : '' }}>
                                                                             {{ $customer->first_name }}
                                                                             {{ $customer->last_name }}
                                                                         </option>
                                                                     @endforeach
                                                                 </select>
                                                             </div>
                                                             <div class="col-md-5">
                                                                 <input type="text" class="form-control" disabled
                                                                     value="{{ $value->percentage }}" name="percentage"
                                                                     placeholder="Enter percentage" required>
                                                             </div>
                                                             <div class="col-md-2">
                                                                 <span class="btn badge bg-red"
                                                                     data-id="{{ $value->id }}"
                                                                     data-token="{{ csrf_token() }}"
                                                                     data-id="{{ $value->id }}"> x
                                                                 </span>
                                                             </div>
                                                         </div>
                                                     @endforeach
                                                 @endif

                                                 <div data-repeater-item class="d-flex mb-2">
                                                     <div class="row">
                                                         <div class="col-md-5">
                                                             <select class="form-control" name="share_holder_id"
                                                                 id="share_holder_id" required>
                                                                 <option>--select share holder--</option>
                                                                 @foreach ($share_holders as $customer)
                                                                     <option value="{{ $customer->id }}">
                                                                         {{ $customer->first_name }}
                                                                         {{ $customer->last_name }}
                                                                     </option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                         <div class="col-md-5">
                                                             <input type="number" class="form-control"
                                                                 name="percentage" placeholder="Enter percentage"
                                                                 required>
                                                         </div>
                                                         <div class="col-md-2">
                                                             <span data-repeater-delete class="btn badge bg-red"> x
                                                             </span>
                                                         </div>
                                                     </div>

                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>

                         </div>

                         <div class="card-footer" align="right">
                             <a href="{{ url('admin/landlord-property/manage?property_id=' . $property->id) }}">
                                 <span class="btn btn-dark">{{ __('Back') }}</span>
                             </a>
                             @if (count($dividend_rule) > 0)
                                 <input type="submit" class="btn btn-primary mr-2" value="Update"
                                     name="dividend_rule_update">
                             @else
                                 <input type="submit" class="btn btn-primary mr-2" value="Save"
                                     name="dividend_rule_save">
                             @endif

                         </div>

                         </form>
                         {{-- </div> --}}
                     @else
                         {{ __('No share holders record found') }}
                     @endif
                 @endif
             </div>
         </div>


     </div>
