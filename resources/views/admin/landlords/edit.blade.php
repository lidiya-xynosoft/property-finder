@extends('backend.layouts.app')

@section('title', 'Edit landlord')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.landlords.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
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
                    <form action="{{ route('admin.landlords.update', $landlord->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ $landlord->first_name }}">
                                <label class="form-label">First Name <span class="text-red">*</span></label>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ $landlord->last_name }}">
                                <label class="form-label">Last Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="email" class="form-control" value="{{ $landlord->email }}">
                                <label class="form-label">Email<span class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="phone" class="form-control" value="{{ $landlord->phone }}">
                                <label class="form-label">Contact Number <span class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea name="address" id="tinymce">{{ $landlord->address }}</textarea>
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
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function() {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });
    </script>
@endpush
