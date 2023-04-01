@extends('backend.layouts.app')

@section('title', 'Create Property')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all"
            rel="stylesheet" type="text/css" />
    @endpush
    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" name="propertyForm">
            @csrf
            <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>CREATE PROPERTY</h2>
                    </div>
                    <div class="body">

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                <label class="form-label">Property Title</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="price" required>
                                <label class="form-label">Price</label>
                            </div>
                            <div class="help-info">{{ $currency }}</div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="bedroom" required>
                                <label class="form-label">No of bedroom</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="bathroom" required>
                                <label class="form-label">No of bathroom</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="garage" required>
                                <label class="form-label">No of garage</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="built_year" required>
                                <label class="form-label">Built Year</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="area" required>
                                <label class="form-label">Floor Area</label>
                            </div>
                            <div class="help-info">Square Feet</div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" />
                            <label for="featured">Featured</label>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label for="tinymce">Description</label>
                            <textarea name="description" id="tinymce">{{ old('description') }}</textarea>
                        </div>

                        <hr>
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

                                    <select name="city_id" class="form-control" required>
                                        {{-- <option>--Select city--</option> --}}
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $city->id }}"
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
                                        placeholder="Enter your location" required>
                                </p>
                            </div>
                             <div class="col-lg-6 col-md-12">

                                <div class="form-line">
                                    <label class="form-label">Address line1</label>

                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">

                                <div class="form-line">
                                    <label for="address">Address line2</label>
                                    <input type="text" id="address1" class="form-control" name="address1"
                                        placeholder="Enter Your Address">
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
                                        placeholder="Google Maps latitude">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-line">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="Google Maps longitude">
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
                                                <span class="nearby-title mb-3 d-block {{ $nearby_category->class }}">
                                                    <i class="{{ $nearby_category->icon }}"></i><b
                                                        class="title">{{ $nearby_category->name }}</b>
                                                    <button data-repeater-create type="button"
                                                        class="btn btn-success btn-sm m-t-15 waves-effect">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>

                                                <div data-repeater-item class="d-flex mb-2">


                                                    <label class="sr-only"
                                                        for="inlineFormInputGroup1">{{ __('Users') }}</label>

                                                    <input type="text" class="form-control"
                                                        name="{{ $nearby_category->slug }}_name"
                                                        placeholder="Enter item name">
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="text" class="form-control"
                                                        name="{{ $nearby_category->slug }}_distance"
                                                        placeholder="Enter distance ">


                                                    <button data-repeater-delete type="submit"
                                                        class="btn btn-danger btn-sm m-t-15 waves-effect text-right">
                                                        <i class="material-icons">cancel</i>
                                                    </button>
                                                    <br />
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
                        <h2>GALLERY IMAGE</h2>
                    </div>
                    <div class="body">
                        <input id="input-id" type="file" name="gallaryimage[]" class="file"
                            data-preview-file-type="text" multiple>
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
                                <label>Select Type</label>

                                <select name="type_id" class="form-select show-tick" required>
                                    {{-- <option>--Select-- </option> --}}
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" class="option">{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('type') ? 'focused error' : '' }}">
                                <label>Select Purpose</label>
                                <select name="purpose_id" class="form-select show-tick" required>
                                    {{-- <option>--Select--</option> --}}

                                    @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}" class="option">{{ $purpose->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5>Aminities</h5>
                        <div class="form-group demo-checkbox">
                            @foreach ($features as $feature)
                                <input type="checkbox" id="features-{{ $feature->id }}" name="features[]"
                                    class="filled-in chk-col-indigo" value="{{ $feature->id }}" />
                                <label for="features-{{ $feature->id }}">{{ $feature->name }}</label>
                            @endforeach
                        </div>

                        <h5>Tags</h5>
                        <div class="form-group demo-checkbox">
                            @foreach ($tags as $tag)
                                <input id="check-t{{ $tag->id }}" type="checkbox" name="tags[]"
                                    value="{{ $tag->id }}">
                                <label for="check-t{{ $tag->id }}">{{ $tag->name }}</label>
                            @endforeach
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="video">
                                <label class="form-label">Video</label>
                            </div>
                            <div class="help-info">Youtube Link</div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>FLOOR PLAN</h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
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
        $(function() {
            $("#input-id").fileinput();
        });
        $('.repeater').repeater({
            defaultValues: {
                'this_id': '1',
                'this_name': 'foo'
            }
        });
        $(document).ready(function() {
            $("#map_area").hide();
            $(function() {
                $("form[name='propertyForm']").validate({
                    // Define validation rules
                    rules: {

                        title: {
                            required: true
                        },
                        description: {
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
