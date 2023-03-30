@extends('backend.layouts.app')

@section('title', 'Create handyman')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.handyman.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CREATE HANDYMAN</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.handyman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="first_name" class="form-control">
                                        <label class="form-label">First name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="phone" class="form-control">
                                        <label class="form-label">Contact number</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" name="password" class="form-control">
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea class="form-control textarea-custom input-full" id="address" name="address" rows="3"></textarea> <label class="form-label">address</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="published" name="status" class="filled-in" value="1"
                                        checked />
                                    <label for="published">Active</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="last_name" class="form-control">
                                        <label class="form-label">Last name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="email" class="form-control">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" name="password_confirmation" class="form-control">
                                        <label class="form-label">Conform password</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="document_type_id" class="form-control show-tick">
                                            <option value="">-- Document Type--</option>

                                            @foreach ($document_types as $document_type)
                                                <option value="{{ $document_type->id }}">
                                                    {{ $document_type->title }}</option>
                                            @endforeach
                                        </select>

                                        {{-- <label class="form-label">Document Type</label> --}}
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="verification" class="form-control">
                                        <label class="form-label">Document number</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect text-right">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
@endpush
