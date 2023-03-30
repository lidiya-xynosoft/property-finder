@extends('backend.layouts.app')

@section('title', 'Edit Country')

@section('content')

    <div class="block-header">
        <a href="{{ route('admin.countries.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT COUNTRY</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.countries.update', $country->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $country->name }}">
                                <label class="form-label">Country</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="code" class="form-control" value="{{ $country->code }}">
                                <label class="form-label">Code</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="currency" class="form-control" value="{{ $country->currency }}">
                                <label class="form-label">Currency</label>
                            </div>
                        </div>

                        <div class="form-group">
                            @if ($country->is_active)
                                @php
                                    $checked = 'checked';
                                @endphp
                            @else
                                @php
                                    $checked = '';
                                @endphp
                            @endif
                            <input type="checkbox" id="published" name="status" class="filled-in" value="1"
                                {{ $checked }} />
                            <label for="published">Active</label>
                        </div>



                        <div class="form-group form-float">

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
