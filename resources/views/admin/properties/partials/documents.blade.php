 <div id="document" class="tab-pane fade">
     <div class="header" id="document">
         <div class="property-nearby">
             <form method="POST" action="{{ url('admin/document/save-update-document') }}" enctype="multipart/form-data">
                 @csrf
                 <input name="property_id" value="{{ $property->id }}" hidden>
                 @if (isset($rows['id']))
                     <input name="property_agreement_id" value="{{ $rows['id'] }}" hidden>
                 @endif
                 <div class="nearby-info mb-4 repeater">
                     <span class="nearby-title mb-3 d-block text-danger">
                         <i class="fas fa-car mr-2"></i><b class="title">Add Document</b>
                         {{-- <a data-repeater-create class="btn btn-warning btn-sm waves-effect">
                             <i class="material-icons">add</i>
                         </a> --}}

                     </span>
                     <div>

                         <br />
                         <div class="d-flex mb-2">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-sm-3">
                                         <div class="form-line">
                                             <label for="document_type_id" class="form-label">Select Document type<span
                                                     class="text-red">*</span></label>

                                             <select name="document_type_id" class="form-control show-tick">
                                                 <option value="">-- Please select --</option>

                                                 @foreach ($document_types as $document_type)
                                                     <option value="{{ $document_type->id }}">
                                                         {{ $document_type->title }}</option>
                                                 @endforeach
                                             </select>

                                         </div>
                                     </div>
                                     <div class="col-sm-3">
                                         <div class="form-line">
                                             <label for="document_file" class="form-label">Document file<span
                                                     class="text-red">*</span></label>

                                             <input type="file" name="document_file">
                                         </div>
                                     </div>
                                     <div class="col-sm-3">
                                         <label class="form-label">&nbsp;<span class="text-red"></span></label>

                                         {{-- <div class="table-actions">
                                             <button data-repeater-delete type="button"
                                                 class="btn btn-danger btn-sm waves-effect"><i
                                                     class="material-icons">close</i></button>

                                         </div> --}}
                                     </div>

                                 </div>
                             </div><br />
                         </div>
                     </div>
                 </div>
                 <div class="card-footer" align="left">
                     <input type="submit" id="document_submit" value="Submit" class="btn btn-primary">
                 </div>
             </form>
         </div>
     </div>

     <div class="header">
         <div class="body">
             <span class="nearby-title mb-3 d-block text-success">
                 <i class="fas fa-car mr-2"></i><b class="title">Documents Overview</b>
             </span>
             <br />
         </div>
         <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                 <thead>
                     <tr>
                         <th>{{ __('SL') }}</th>
                         <th>{{ __('Document Name') }}</th>
                         <th>{{ __('file') }}</th>
                         <th>{{ __('Actions') }}</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($documents as $key => $document)
                         <tr>
                             <td>{{ $key + 1 }}</td>
                             <td>{{ $document['document_type']['title'] }}</td>
                             <td>
                                 @if (Storage::disk('public')->exists($document['file']))
                                     <img src="{{ Storage::url($document['file']) }}" alt="{{ $document['file'] }}"
                                         width="60" class="img-responsive img-rounded">
                                 @endif
                             </td>

                             <td class="text-center">
                                 <button type="button" class="btn btn-danger btn-sm waves-effect" id="deleteDocument"
                                     data-id="{{ $document['id'] }}" data-token="{{ csrf_token() }}">
                                     <i class="material-icons">delete</i>
                                 </button>

                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>
