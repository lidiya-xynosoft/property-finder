@extends('backend.layouts.app')

@section('title', 'Edit expense_category')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.expense_category.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>Edit Expense Category</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.expense_category.update', $expense_category->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $expense_category->title }}">
                                <label class="form-label">Expense Category Title</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize">{{ $expense_category->description }}</textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>
             
                        <div class="form-group form-float">
                            <div class="form-line">
                               <select name="type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="0" {{ $expense_category->type=='0' ? 'selected' : '' }}>Receipt</option>
                                <option value="1" {{ $expense_category->type=='1' ? 'selected' : '' }}>Payment</option>
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


@push('scripts')
@endpush
