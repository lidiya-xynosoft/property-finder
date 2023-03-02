@extends('backend.layouts.app')

@section('title', 'Edit city')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.cities.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT CITY</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.cities.update', $city->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $city->name }}">
                                <label class="form-label">City Title</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('type') ? 'focused error' : '' }}">
                                <label>Select Type</label>
                                <select name="country_id" class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    @foreach ($countries as $key => $value)
                                        <option value="blog" {{ $value->id == $city->country_id ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (Storage::disk('public')->exists('city/thumb/' . $city->icon))
                            <div class="form-group">
                                <img src="{{ Storage::url('city/thumb/' . $city->icon) }}" alt="{{ $city->title }}"
                                    class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>



                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" name="city_order" class="form-control" min="1"
                                    value="{{ $city->city_order }}">
                                <label class="form-label">City Order</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="latitude" class="form-control"
                                    value="{{ $city->latitude }}">
                                <label class="form-label">Latitude</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="longitude" class="form-control"
                                    value="{{ $city->longitude }}">
                                <label class="form-label">Longitude</label>
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
