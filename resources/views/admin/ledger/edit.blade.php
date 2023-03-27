@extends('backend.layouts.app')

@section('title', 'Edit ledger')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.ledger.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>Edit ledger</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.ledger.update', $ledger->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $ledger->title }}">
                                <label class="form-label">ledger Title</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize">{{ $ledger->description }}</textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>
             
                        <div class="form-group form-float">
                            <div class="form-line">
                               <select name="type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="0" {{ $ledger->type=='0' ? 'selected' : '' }}>Receipt</option>
                                <option value="1" {{ $ledger->type=='1' ? 'selected' : '' }}>Payment</option>
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
