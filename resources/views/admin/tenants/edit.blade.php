@extends('backend.layouts.app')

@section('title', 'Edit tenant')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.tenants.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT FEATURES</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ $tenant->first_name }}">
                                <label class="form-label">First Name</label>
                            </div>
                        </div>

                       
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ $tenant->last_name }}">
                                <label class="form-label">Last Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="email" class="form-control"
                                    value="{{ $tenant->email }}">
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $tenant->phone }}">
                                <label class="form-label">Contact Number</label>
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
