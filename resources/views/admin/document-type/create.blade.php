@extends('backend.layouts.app')

@section('title', 'Create Tags')




@section('content')

    <div class="block-header">
        <a href="{{route('admin.document-type.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>CREATE TAG</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.document-type.store')}}" method="POST">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control">
                                <label class="form-label">Document Name</label>
                            </div>
                        </div>
                         <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Select Type</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="0">For Property Agreement</option>
                                <option value="1">For Property</option>
                            </select>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



