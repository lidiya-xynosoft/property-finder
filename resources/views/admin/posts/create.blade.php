@extends('backend.layouts.app')

@section('title', 'Create Post')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @endpush
    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>CREATE POST</h2>
                    </div>
                    <div class="body">

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                <label class="form-label">Post Title <span class="text-red">*</span></label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="excerpt" class="form-control" value="{{ old('excerpt') }}">
                                <label class="form-label">Excerpt <span class="text-red">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="published" name="status" class="filled-in" value="1" />
                            <label for="published">Published</label>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Body <span class="text-red">*</span></label>
                            <textarea name="body" id="tinymce">{{ old('body') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="header">
                        <h2>SELECT CATEGORY <span class="text-red">*</span></h2>
                    </div>
                    <div class="body">

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                <label>Select Category</label>
                                <select name="categories[]" class="form-control show-tick" multiple data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br /><br />
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                <label>Select Tag <span class="text-red">*</span></label>
                                <select name="tags[]" class="form-control show-tick" multiple data-live-search="true">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>FEATURED IMAGE <span class="text-red">*</span></h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>

                        <a href="{{ route('admin.posts.index') }}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                            <i class="material-icons left">arrow_back</i>
                            <span>BACK</span>
                        </a>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@push('script')
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
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
