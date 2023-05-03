@extends('backend.layouts.app')

@section('title', 'Edit Property')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all"
            rel="stylesheet" type="text/css" />
    @endpush
    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{ route('admin.properties.update', $property->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>Edit PROPERTY</h2>
                    </div>
                    <div class="body">

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ $property->title }}">
                                <label class="form-label">Property Title</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" name="price" class="form-control" value="{{ $property->price }}"
                                    required>
                                <label class="form-label">Price</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="bedroom" value="{{ $property->bedroom }}"
                                    required>
                                <label class="form-label">No of Bedroom</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="bathroom" value="{{ $property->bathroom }}"
                                    required>
                                <label class="form-label">No of Bathroom</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="area" value="{{ $property->area }}"
                                    required>
                                <label class="form-label">Floor Area</label>
                            </div>
                            <div class="help-info">Square Feet</div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="garage" required
                                    value="{{ $property->garage }}">
                                <label class="form-label">No of garage</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="built_year" required
                                    value="{{ $property->built_year }}">
                                <label class="form-label">Built Year</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="parent_property" name="parent_property" class="filled-in"
                                value="1" {{ $property->is_parent_property ? 'checked' : '' }} />
                            <label for="parent_property">Is Parent Property</label>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="parent_property_id text-right">Choose parent Property</label>

                            <select name="parent_property_id" class="form-select form-select-lg text-right" required>
                                <option value="-1">--This is Parent Property--</option>
                                @foreach ($parent_property as $key => $row)
                                    <option value="{{ $row->id }}"
                                        {{ $property->is_parent_property == $row->id ? 'selected' : '' }}>
                                        {{ $row->title }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="electricity_no"
                                    value="{{ $property->electricity_no }}">
                                <label class="form-label">Electricity number</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="water_no"
                                    value="{{ $property->water_no }}">
                                <label class="form-label">Water number</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="tinymce">Description</label>
                            <textarea name="description" id="tinymce">{{ $property->description }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>PROPERTY LOCATION</h2>
                    </div>
                    <div class="body">
                        <div class="row">

                            <div class="col-lg-6 col-md-12">

                                <p>
                                    <label for="city">Select City </label>

                                    <select name="city_id" class="form-select form-select-lg" required>
                                        <option>--Select city--</option>
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $city->id }}"
                                                {{ $property->city_id == $city->id ? 'selected' : '' }}
                                                onclick="getSelectedDistrictLatLong({{ $city->id }})">
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br />

                                </p>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <p>
                                    <label for="address">Find Property</label>
                                    <input type="text" name="autocomplete" id="autocomplete" class="form-control"
                                        placeholder="Enter your location">
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-12">

                                <div class="form-line">
                                    <label class="form-label">Address line1</label>

                                    <input type="text" class="form-control" value="{{ $property->address }}"
                                        name="address" id="address" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-line">
                                    <label for="address">Address line2</label>
                                    <input type="text" id="address1" value="{{ $property->address1 }}"
                                        class="form-control" name="address1" placeholder="Enter Your Address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">

                                <div class="form-line">
                                    <label class="form-label">Building no</label>

                                    <input type="text" placeholder="Biulding no" class="form-control"
                                        name="building_no" id="building_no" value="{{ $property->building_no }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">

                                <div class="form-line">
                                    <label for="address">Zone No</label>
                                    <input type="text" id="zone_no" class="form-control" name="zone_no"
                                        placeholder="Enter Zone no" value="{{ $property->zone_no }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">

                                <div class="form-line">
                                    <label for="address">Street No</label>
                                    <input type="text" id="street_no" class="form-control" name="street_no"
                                        placeholder="Enter Street no" value="{{ $property->street_no }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12" id="map_area">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div id="map" style="height:400px; width: 600px;" class="my-3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-line">
                                    <label for="latitude">Latitude</label>
                                    <input id="latitude" name="latitude" type="text" class="form-control"
                                        value="{{ $property->latitude }}" placeholder="Google Maps latitude">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-line">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        value="{{ $property->longitude }}" placeholder="Google Maps longitude">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="card">
                    <div class="header">
                        <h2>PROPERTY NEARBY</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="property-nearby">
                                    @foreach ($nearby_categories as $key => $nearby_category)
                                        <div class="nearby-info mb-4 repeater">
                                            <div data-repeater-list="{{ $nearby_category->slug }}">
                                                <div class="col-md-10">
                                                    <span class="nearby-title mb-3 {{ $nearby_category->class }}">
                                                        <i class="{{ $nearby_category->icon }}"></i><b
                                                            class="title">{{ $nearby_category->name }}</b>
                                                    </span>
                                                </div>
                                                <div class="col-md-2">
                                                    <span data-repeater-create class="btn badge bg-green"> + </span>
                                                </div>

                                                <div data-repeater-item class="d-flex mb-2">


                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="{{ $nearby_category->slug }}_name"
                                                            placeholder="Enter item name">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="{{ $nearby_category->slug }}_distance"
                                                            placeholder="Enter distance ">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span data-repeater-delete class="btn badge bg-red"> x </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div> 
                <div class="card">
                    <div class="header">
                        <h2>DOCUMENT FILES</h2>
                    </div>
                    <div class="body">
                        <div class="gallery-box" id="gallerybox">
                            <div class="nearby-info mb-4 repeater">
                                <div data-repeater-list="documents">
                                    <div class="col-md-10">
                                        <span class="nearby-title mb-3">
                                            <i class=""></i><b class="title">Add multiple Documents</b>
                                        </span>
                                    </div>
                                    @if (count($documents) > 0)
                                        @foreach ($documents as $document)
                                            <div class="col-md-2">
                                                <span data-repeater-create class="btn badge bg-green"> + </span>
                                            </div>
                                            <div data-repeater-item class="d-flex mb-2">
                                                <div class="col-md-5">
                                                    <select name="document_type_id" class="form-control show-tick">
                                                        <option value="">-- Please select --</option>
                                                        @foreach ($document_types as $document_type)
                                                            <option value="{{ $document_type->id }}"
                                                                {{ $document_type->id == $document->document_type_id ? 'selected' : '' }}>
                                                                {{ $document_type->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-line">
                                                        <label for="document_file" class="form-label">Document file<span
                                                                class="text-red">*</span></label>
                                                        <input type="file" name="document_file"
                                                            value="{{ $document->file }}">
                                                        {{ $document->file }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <span data-repeater-delete class="btn badge bg-red"> x </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-2">
                                            <span data-repeater-create class="btn badge bg-green"> + </span>
                                        </div>
                                        <div data-repeater-item class="d-flex mb-2">
                                            <div class="col-md-5">
                                                <select name="document_type_id" class="form-control show-tick">
                                                    <option value="">-- Please select --</option>
                                                    @foreach ($document_types as $document_type)
                                                        <option value="{{ $document_type->id }}">
                                                            {{ $document_type->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-line">
                                                    <label for="document_file" class="form-label">Document file<span
                                                            class="text-red">*</span></label>
                                                    <input type="file" name="document_file">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <span data-repeater-delete class="btn badge bg-red"> x </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-red">
                        <h2>GALLERY IMAGE</h2>
                    </div>
                    <div class="body">
                        <div class="gallery-box" id="gallerybox">
                            @foreach ($property->gallery as $gallery)
                                <div class="gallery-image-edit" id="gallery-{{ $gallery->id }}">
                                    <button type="button" data-id="{{ $gallery->id }}"
                                        class="btn btn-danger btn-sm"><i
                                            class="material-icons">delete_forever</i></button>
                                    <img class="img-responsive"
                                        src="{{ Storage::url('property/gallery/' . $gallery->name) }}"
                                        alt="{{ $gallery->name }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="gallery-box">
                            <hr>
                            <input type="file" name="gallaryimage[]" value="UPLOAD" id="gallaryimageupload" multiple>
                            <button type="button" class="btn btn-info btn-lg right" id="galleryuploadbutton">UPLOAD
                                GALLERY IMAGE</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>SELECT</h2>
                    </div>
                    <div class="body">

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('purpose') ? 'focused error' : '' }}">
                                <label>Select Purpose</label>

                                <select name="purpose_id" class="form-select show-tick">
                                    <option>--Select--</option>

                                    @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}"
                                            {{ $purpose->name == $property->purpose ? 'selected' : '' }}>
                                            {{ $purpose->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('type') ? 'focused error' : '' }}">
                                <label>Select type</label>
                                <select name="type_id" class="form-select show-tick">
                                    <option>--Select type-- </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->name == $property->type ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <h5>Features</h5>
                        <div class="form-group demo-checkbox">
                            @foreach ($features as $feature)
                                <input type="checkbox" id="features-{{ $feature->id }}" name="features[]"
                                    class="filled-in chk-col-indigo" value="{{ $feature->id }}"
                                    @foreach ($property->features as $checked)
                                {{ $checked->id == $feature->id ? 'checked' : '' }} @endforeach />
                                <label for="features-{{ $feature->id }}">{{ $feature->name }}</label>
                            @endforeach
                        </div>


                        <h5>Tags</h5>
                        <div class="form-group demo-checkbox">
                            @foreach ($tags as $tag)
                                <input id="check-t{{ $tag->id }}" type="checkbox" name="tags[]"
                                    value="{{ $tag->id }}"
                                    @foreach ($property->tags as $checked)
                                                        {{ $checked->id == $tag->id ? 'checked' : '' }} @endforeach>
                                <label for="check-t{{ $tag->id }}">{{ $tag->name }}</label>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="header bg-indigo">
                        <h2>PROPERTY VIDEO</h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="video" value="{{ $videoembed }}">
                                <label class="form-label">Video</label>
                            </div>
                            <div class="help-info">Youtube Link</div>
                        </div>
                        <div class="embed-video center">
                            {!! $videoembed !!}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header bg-indigo">
                        <h2>FLOOR PLAN</h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            @if (Storage::disk('public')->exists('property/' . $property->floor_plan) && $property->floor_plan)
                                <img src="{{ Storage::url('property/' . $property->floor_plan) }}"
                                    alt="{{ $property->title }}" class="img-responsive img-rounded"> <br>
                            @endif
                            <input type="file" name="floor_plan">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header bg-indigo">
                        <h2>FEATURED IMAGE</h2>
                    </div>
                    <div class="body">

                        <div class="form-group">
                            @if (Storage::disk('public')->exists('property/' . $property->image))
                                <img src="{{ Storage::url('property/' . $property->image) }}"
                                    alt="{{ $property->title }}" class="img-responsive img-rounded"> <br>
                            @endif
                            <input type="file" name="image">
                        </div>

                        {{-- BUTTON --}}
                        <a href="{{ route('admin.properties.index') }}"
                            class="btn btn-danger btn-lg m-t-15 waves-effect">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCcdV0HtLCefHEkAlQAJ0VEOFeMmPGCcTA&libraries=places"
        type="text/javascript"></script>
    <script src="{{ asset('frontend/findhouse/js/jquery.validate.min.js') }}"></script>

    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place.address_components);
                console.log(place);
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                defaultPosition = {
                    lat: place.geometry['location'].lat(),
                    lng: place.geometry['location'].lng(),
                };
                initMap();
                $('#address').val(place.formatted_address);

                // --------- show lat and long ---------------
                // $("#address_area").removeClass("d-none");
                $("#map_area").show();
            });
        }

        var getSelectedDistrictLatLong = function(value) {
            $.ajax({
                url: "/property/city-lat-long",
                type: 'get',
                data: {
                    city_id: value,
                },
                success: function(res) {
                    if (res['success'] == 1) {
                        console.log(res);
                        $('#latitude').val(res['lat']);
                        $('#longitude').val(res['long']);

                        defaultPosition = {
                            lat: res['lat'],
                            lng: res['long'],
                        };

                        initMap();
                        $("#map_area").show;

                    }
                },
                error: function() {
                    alert('failed...');
                    return;
                }
            });
        };
    </script>
    <script>
        let map;

        let defaultPosition = {
            lat: 12.818079042852622,
            lng: 79.69474439948242
        };
        $('#latitude').val('12.818079042852622');
        $('#longitude').val('79.69474439948242');

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultPosition,
                zoom: 8,
                scrollwheel: true,
            });
            const uluru = defaultPosition;
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#latitude').val(lat)
                    $('#longitude').val(lng)
                })
            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.repeater').repeater({
            defaultValues: {
                'this_id': '1',
                'this_name': 'foo'
            }
        });
        // DELETE PROPERTY GALLERY IMAGE
        $('.gallery-image-edit button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var image = $('#gallery-' + id + ' img').attr('alt');
            $.post("{{ route('admin.gallery-delete') }}", {
                id: id,
                image: image
            }, function(data) {
                if (data.msg == true) {
                    $('#gallery-' + id).remove();
                }
            });
        });

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {

                            $('<div class="gallery-image-edit" id="gallery-perview-' + i + '"><img src="' +
                                event.target.result + '" height="106" width="173"/></div>').appendTo(
                                placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallaryimageupload').on('change', function() {
                imagesPreview(this, 'div#gallerybox');
            });
        });

        $(document).on('click', '#galleryuploadbutton', function(e) {
            e.preventDefault();
            $('#gallaryimageupload').click();
        })
        $(document).ready(function() {
            $("#map_area").hide();
            $(function() {
                $("form[name='propertyForm']").validate({
                    // Define validation rules
                    rules: {

                        title: {
                            required: true
                        },
                        parent_property_id: {
                            required: true
                        },
                        price: {
                            required: true,
                            number: true

                        },
                        area: {
                            required: true,
                            number: true

                        },
                        bathroom: {
                            required: true,
                            number: true

                        },
                        bedroom: {
                            required: true,
                            number: true
                        },
                        garage: {
                            number: true
                        },
                        built_year: {
                            number: true
                        },

                        address: {
                            required: true
                        },
                        image: {
                            required: true
                        },

                    },
                    // Specify validation error messages
                    messages: {
                        title: "Please provide a valid Property Title.",
                        description: "Please enter description",
                    },

                    submitHandler: function(form) {
                        console.log(form);
                        form.submit();
                    }
                });
            });
        });
    </script>

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

        $(function() {
            tinymce.init({
                selector: "textarea#tinymce-nearby",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: '',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });
    </script>
@endpush
