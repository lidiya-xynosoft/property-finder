<div class="header">
    <div class="property-nearby">
        <form method="POST" id="documentForm">
            @csrf
            <input name="property_id" value="{{ $property->id }}" hidden>
            <div class="nearby-info mb-4 repeater">
                <span class="nearby-title mb-3 d-block text-danger">
                    <i class="fas fa-car mr-2"></i><b class="title">Add Document</b>
                     <a  data-repeater-create
                                                class="btn btn-warning btn-sm waves-effect">
                                                <i class="material-icons">add</i>
                                            </a>
                    
                </span>
                <div data-repeater-list="documents">

                    <br />
                    <div data-repeater-item class="d-flex mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="document_type_id" class="form-label">Select Document type<span
                                                class="text-red">*</span></label>

                                        <select name="document_type_id" class="form-control show-tick">
                                            <option value="">-- Please select --</option>

                                            @foreach ($document_types as $expense)
                                                <option value="{{ $expense->id }}">
                                                    {{ $expense->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <label for="document_file" class="form-label">File<span
                                                class="text-red">*</span></label>

                                        <input id="document_file" type="file" class="form-control"
                                            name="document_file" value="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="document_file" class="form-label">&nbsp;<span
                                                class="text-red"></span></label>
   
                                    <div  class="table-actions">
                                        <button data-repeater-delete type="button"
                                            class="btn btn-danger btn-sm waves-effect"><i class="material-icons">close</i></button>
                                           
                                    </div>
                                </div>

                            </div>
                        </div><br />
                    </div>
                </div>
            </div>
            <div class="card-footer" align="left">
                <input type="submit" id="expense_submit" value="Submit" class="btn btn-primary">
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
        <table id="garageListTable" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                   <th>{{ __('SL') }}</th>
                    <th>{{ __('Document Name') }}</th>
                    <th>{{ __('file') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $key=>$document)
                <tr>
                   <td>{{ $key + 1 }}</td>
                    <td>{{ $document['document_type']['title'] }}</td>
                    <td>{{ $document['file'] }}</td>
                    
                    <td>
                        <div class="table-actions">

                         
                               <button class="btn btn-danger btn-icon ml-2 mb-2 deleteDocument" data-id="{{ $document['id'] }}" data-token="{{ csrf_token() }}" >Delete</button>
                           

                            {{-- <a href="{{ url('admin/property/manage/?update_id=') . $document['id']}}">
                                <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2">
                                    <i class="material-icons">edit</i></button>
                            </a> --}}

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

