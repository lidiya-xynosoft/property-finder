@extends('backend.layouts.app')

@section('title', 'Edit aminities')

@section('content')

    <div class="block-header">
        <a href="{{ route('admin.aminities.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT AMINITY</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.aminities.update', $feature->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $feature->name }}">
                                <label class="form-label">Aminity</label>
                            </div>
                        </div>
                        @if (Storage::disk('public')->exists('aminity/' . $feature->icon))
                            <div class="form-group">
                                <img src="{{ Storage::url('aminity/' . $feature->icon) }}" alt="{{ $feature->name }}"
                                    class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="icon">
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
