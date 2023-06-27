 <?php 
 use App\Property;
 ?>
 <div id="dividend" class="tab-pane fade">
     <div class="header" id="dividend">

         <div class="body">
             {{-- <div class="row">
                 <form action="{{ route('admin.share-holder-report') }}" method="POST" name="shareHolderDataForm">
                     @csrf
                     <div class="col-sm-2">
                         <div class="form-group">
                             <label>&nbsp;</label>

                             <select name="share_holder_id" class="form-control select2">
                                 <option value="">-- select Share Holder --</option>
                                 @foreach ($share_holders as $key => $value)
                                     <option value="{{ $value->id }}">
                                         {{ $value->first_name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="col-sm-2">
                         <div class="form-group">
                             <label>&nbsp;</label>

                             <select name="ledger_id" class="form-control select2">
                                 <option value="">-- select Ledger --</option>
                                 @foreach ($ledgers as $key => $value)
                                     <option value="{{ $value->id }}">{{ $value->title }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                       <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>

                                   <select name="ledger_id" class="form-control select2">
                                 <option value="">-- select Ledger --</option>
                                 @foreach ($ledgers as $key => $value)
                                     <option value="{{ $value->id }}">{{ $value->title }}
                                     </option>
                                 @endforeach
                             </select>
                                </div>
                            </div>
                     <div class="col-sm-2">
                         <input id="startDate" type="text" class="form-control" name="start_date"
                             placeholder="select start date">
                     </div>
                     <div class="col-sm-2">
                         <input id="endDate" type="text" class="form-control" name="end_date"
                             placeholder="select End date">
                     </div>
                     <div class="col-sm-2">
                         <div class="form-group">
                             <label>&nbsp;</label>
                             <button type="submit" class="btn btn-indigo btn-s m-t-15 waves-effect">
                                 <i class="material-icons">search</i>
                                 <span>Search</span>
                             </button>
                         </div>
                     </div>

                 </form>
             </div> --}}
             <div class="table-responsive">
                 <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                     <thead>
                         <tr>
                             <th>SL.</th>
                             <th>Name</th>
                             <th>Main Unit</th>
                             <th>Sub Unit</th>

                             <th>date</th>
                             <th>Reference</th>
                             <th>Ledger</th>
                             <th>Applied Percentage (%)</th>
                             <th>Ledger Amount ( {{ $currency }})</th>
                             <th>Applied Amount ( {{ $currency }})</th>
                         </tr>
                     </thead>

                     <tbody>
                         @if (isset($dividends))
                             @if (count($dividends) > 0)
                                 @foreach ($dividends as $key => $income)
                                     <tr>
                                         <td>{{ $key + 1 }}</td>
                                         <td>{{ $income['share_holder']['first_name'] }}
                                         </td>
                                           <td><?php echo Property::find($income['parent_property_id'])->title;
                                           echo ' ( '.Property::find($income['parent_property_id'])->product_code .' ) '  ?>
                                         </td>
                                         <td>{{ $income['property']['title'] }} ( {{ $income['property']['product_code'] }} )
                                         </td>
                                         <td>
                                             {{ $income['date'] }}
                                         </td>
                                        <td>
                                                    @if ($income['reference'] == 1)
                                                        <span class="badge bg-red"> Expense </span>
                                                    @else
                                                        <span class="badge bg-green"> Income </span>
                                                    @endif
                                                </td>
                                         <td>{{ $income['ledger']['title'] }}</td>
                                         <td>{{ $income['applied_percentage'] }} %</td>
                                         <td>{{ $income['ledger_amount'] }}</td>

                                         <td>{{ $income['applied_amount'] }}</td>

                                     </tr>
                                 @endforeach
                             @endif
                         @endif
                     </tbody>
                 </table>
             </div>

             <div class="row text-right">
                 {{-- <b>Total Property Income - {{ $total_income }}</b> --}}
             </div>
         </div>
     </div>
 </div>
