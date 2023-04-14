  <div id="rent" class="tab-pane fade">
      <div class="header" id="rent">
          <div class="body">
              <span class="nearby-title mb-3 d-block text-success">
                  <i class="fas fa-car mr-2"></i><b class="title">Rent Overview</b>
              </span>
              <br />
          </div>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
              data-whatever="@mdo">Open modal for @mdo</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
              data-whatever="@fat">Open modal for @fat</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" --}}
          {{-- data-whatever="@getbootstrap">Open modal for @getbootstrap</button> --}}

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <form method="POST" id="rentForm">
                      @csrf
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Pay to landloard</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">

                              <input name="property_id" value="{{ $property->id }}" hidden>
                              @if (isset($rows['id']))
                                  <input name="property_agreement_id" value="{{ $rows['id'] }}" hidden>
                              @endif
                              <input name="rent_id" id="rent_id" value="0" type="text" hidden>
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
                                  <label for="expense_amount" class="form-label">Amount<span
                                          class="text-red">*</span></label>

                                  <input id="expense_amount" type="text" class="form-control" name="amount">
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
                              <div class="col-sm-6">
                                  <label for="Option" class="form-label">Option<span class="text-red">*</span></label>
                                  <div class="form-line">
                                      @foreach ($payment_types as $payment_type)
                                          <div class="col-sm-3">
                                              <div class="form-line">
                                                  <input type="radio" id="{{ $payment_type->name }}"
                                                      name="payment_type_id" value="{{ $payment_type->id }}" />
                                                  <label
                                                      for="{{ $payment_type->name }}">{{ $payment_type->name }}</label>
                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="form-line">
                                  <label for="description" class="form-label">Description</label>
                                  <textarea class="form-control" id="description" name="description"></textarea>

                              </div>

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
          <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                  <thead>
                      <tr>
                          <th>{{ __('SL') }}</th>
                          <th>{{ __('Months') }}</th>
                          <th>{{ __('Rent Amount' . ' (' . $currency . ')') }}</th>
                          <th>{{ __('Actions') }}</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($rent_months as $key => $data)
                          <tr>
                              <td>{{ $key + 1 }}</td>
                              <td>{{ $data->month . '-' . $data->rental_date }}</td>
                              <td>{{ $data->rent_amount . '/-' }}</td>

                              <td>
                                  <div class="table-actions">

                                      @if ($data->payment_status == 0)
                                          <button class="btn btn-info btn-icon ml-2 mb-2 payRent"
                                              data-id="{{ $data->id }}" data-token="{{ csrf_token() }}"
                                              data-toggle="modal" data-target="#exampleModal"
                                              data-whatever="@mdo">Pay to landloard
                                              </button>
                                      @else
                                          <button class="btn btn-success btn-icon ml-2 mb-2" data-id=""
                                              data-token="{{ csrf_token() }}">Paid</button>
                                      @endif

                                  </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
