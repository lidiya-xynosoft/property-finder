@extends('backend.layouts.app')

@section('title', 'Edit service')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.services.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
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
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $service->title }}">
                                <label class="form-label">Feature Title</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize">{{ $service->description }}</textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>
                        @if (Storage::disk('public')->exists('service/thumb/' . $service->icon))
                            <div class="form-group">
                                <img src="{{ Storage::url('service/thumb/' . $service->icon) }}"
                                    alt="{{ $service->title }}" class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>

    

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" name="service_order" class="form-control" min="1"
                                    value="{{ $service->service_order }}">
                                <label class="form-label">Service Order</label>
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
