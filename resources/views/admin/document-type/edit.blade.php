@extends('backend.layouts.app')

@section('title', 'Edit Tags')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.document-type.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>EDIT DOCUMENT TYPE</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.document-type.update', $document_type->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $document_type->title }}">
                                <label class="form-label">Document name</label>
                            </div>
                        </div>
                       <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Select Type</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="0" {{ $document_type->type=='0' ? 'selected' : '' }}>For Property Agreement</option>
                                <option value="1" {{ $document_type->type=='1' ? 'selected' : '' }}>For Property</option>
                            </select>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">update</i>
                            <span>Update</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
@endpush
