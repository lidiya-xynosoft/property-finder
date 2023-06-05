@extends('backend.layouts.app')

@section('title', 'Create Share Holder')




@section('content')

    <div class="block-header">
        <a href="{{ route('admin.share-holder.index') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CREATE SHARE HOLDER</h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.share-holder.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="first_name" class="form-control">
                                <label class="form-label">First name <span
                                                                class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="last_name" class="form-control">
                                <label class="form-label">Last name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="email" class="form-control">
                                <label class="form-label">Email <span
                                                                class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" name="phone" class="form-control">
                                <label class="form-label">Contact number <span
                                                                class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                               <div class="form-line">
                            <textarea name="address" id="tinymce"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
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
