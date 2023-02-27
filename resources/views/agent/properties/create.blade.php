@extends('frontend.layouts.profile')

@section('title', 'Add Property')

@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/dashbord-mobile-menu.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/search.css') }}">
    @endpush
    <section class="user-page section-padding">
        <div class="container-fluid">
            <div class="row">
                @include('agent.sidebar')
                <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    <div class="col-lg-12 mobile-dashbord dashbord">
                        <div class="dashboard_navigationbar dashxl">
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i>
                                    Dashboard
                                    Navigation</button>
                                <ul id="myDropdown" class="dropdown-content">
                                    <li>
                                        <a class="{{ Request::is('agent/dashboard') ? 'active' : '' }}"
                                            href="{{ route('agent.dashboard') }}">
                                            <i class="fa fa-map-marker mr-3"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ Request::is('agent/profile') ? 'active' : '' }}"
                                            href="{{ route('agent.profile') }}">

                                            <i class="fa fa-user mr-3"></i>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ Request::is('agent/properties') ? 'active' : '' }}"
                                            href="{{ route('agent.properties.index') }}">
                                            <i class="fa fa-list mr-3" aria-hidden="true"></i>My Properties
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('agent.profile') }}">
                                            <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ Request::is('agent/properties/create') ? 'active' : '' }}"
                                            href="{{ route('agent.properties.create') }}">
                                            <i class="fa fa-list mr-3" aria-hidden="true"></i>Add Property
                                        </a>
                                    </li>

                                    <li>
                                        <a class="{{ Request::is('agent/changepassword') ? 'active' : '' }}"
                                            href="{{ route('agent.changepassword') }}">
                                            <i class="fa fa-lock mr-3"></i>Change Password
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('agent.properties.store') }}" name="propertyForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="single-add-property">
                            <h3>Property description and price</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="validationCustom01" class="form-label">Property Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="validationCustom01" placeholder="Enter your property title"
                                                data-length="200">
                                        </p>
                                    </div>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="description">Property Description</label>
                                            <textarea id="description" name="description" placeholder="Describe about your property"
                                                class="form-control html-editor h-205 @error('description') is-invalid @enderror"></textarea>
                                        </p>
                                    </div>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Price</label>
                                            <input type="text" name="price"
                                                class="form-control @error('price') is-invalid @enderror" placeholder="USD"
                                                id="price">
                                        </p>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Floor Area</label>
                                            <input type="text" name="area" placeholder="Sqft"
                                                class="form-control @error('area') is-invalid @enderror" id="area">
                                        </p>
                                        @error('area')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Bedroom</label>
                                            <input type="text" id="bedroom" name="bedroom" type="number"
                                                class="form-control @error('bedroom') is-invalid @enderror">
                                        </p>
                                        @error('bedroom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Bathroom</label>
                                            <input type="text" id="bathroom" name="bathroom" type="number"
                                                class="form-control @error('bathroom') is-invalid @enderror">
                                        </p>
                                        @error('bathroom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Garage</label>
                                            <input type="text" id="garage" name="garage" type="number"
                                                class="form-control @error('garage') is-invalid @enderror">
                                        </p>
                                        @error('garage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Built Year</label>
                                            <input type="text" id="built_year" name="built_year" type="number"
                                                class="form-control @error('built_year') is-invalid @enderror">
                                        </p>
                                        @error('built_year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <br />
                                        {{-- <div class="select-option"> --}}
                                        {{-- <i class="ti-angle-down"></i> --}}
                                        <select name="type">
                                            @foreach ($types as $type)
                                                <option value="{{ $type->slug }}" class="option">{{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <br />

                                        <select name="purpose">
                                            @foreach ($purposes as $purpose)
                                                <option value="{{ $purpose->slug }}" class="option">{{ $purpose->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.col -->
                        <div class="single-add-property">
                            <h3>Property Features</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="pro-feature-add pl-0">

                                            @foreach ($features as $feature)
                                                <li class="fl-wrap filter-tags clearfix">
                                                    <div class="checkboxes float-left">
                                                        <div class="filter-tags-wrap">
                                                            <input id="check-{{ $feature->id }}" type="checkbox"
                                                                name="features[]" value="{{ $feature->id }}">
                                                            <label
                                                                for="check-{{ $feature->id }}">{{ $feature->name }}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Location</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="property-nearby">
                                            <div class="nearby-info mb-4 repeater">
                                                <div data-repeater-list="group-a">
                                                    <span class="nearby-title mb-3 d-block text-info">
                                                        <i class="fas fa-graduation-cap mr-2"></i><b
                                                            class="title">Education</b>


                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success ml-0"><i
                                                                class="fa fa-plus mr-3"></i></i></button>
                                                    </span>

                                                    <div data-repeater-item class="d-flex mb-2">

                                                        <label class="sr-only"
                                                            for="inlineFormInputGroup1">{{ __('Users') }}</label>

                                                        <input type="text" class="form-control" name="education_name"
                                                            placeholder="Enter item name">

                                                        <input type="text" class="form-control"
                                                            name="education_distance" placeholder="Enter distance ">

                                                        <button data-repeater-delete type="button"
                                                            class="btn btn-danger btn-icon ml-2"><i
                                                                class="fa fa-remove mr-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="nearby-info mb-4 repeater">
                                                <div data-repeater-list="group-b">
                                                    <span class="nearby-title mb-3 d-block text-success">
                                                        <i class="fas fa-graduation-cap mr-2"></i><b
                                                            class="title">Health & Medical</b>


                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success ml-0"><i
                                                                class="fa fa-plus mr-3"></i></i></button>
                                                    </span>

                                                    <div data-repeater-item class="d-flex mb-2">

                                                        <label class="sr-only"
                                                            for="inlineFormInputGroup1">{{ __('Users') }}</label>

                                                        <input type="text" class="form-control" name="health_name"
                                                            placeholder="Enter item name">

                                                        <input type="text" class="form-control"
                                                            name="education_distance" placeholder="Enter distance ">

                                                        <button data-repeater-delete type="button"
                                                            class="btn btn-danger btn-icon ml-2"><i
                                                                class="fa fa-remove mr-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="nearby-info mb-4 repeater">
                                                <div data-repeater-list="group-c">
                                                     <span class="nearby-title mb-3 d-block text-danger">
                                                <i class="fas fa-car mr-2"></i><b class="title">Transportation</b>


                                                        <button data-repeater-create type="button"
                                                            class="btn btn-success ml-0"><i
                                                                class="fa fa-plus mr-3"></i></i></button>
                                                    </span>

                                                    <div data-repeater-item class="d-flex mb-2">

                                                        <label class="sr-only"
                                                            for="inlineFormInputGroup1">{{ __('Users') }}</label>

                                                        <input type="text" class="form-control" name="health_name"
                                                            placeholder="Enter item name">

                                                        <input type="text" class="form-control"
                                                            name="education_distance" placeholder="Enter distance ">

                                                        <button data-repeater-delete type="button"
                                                            class="btn btn-danger btn-icon ml-2"><i
                                                                class="fa fa-remove mr-3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Location</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Address</label>
                                            <input type="text" id="address" name="address"
                                                placeholder="Enter Your Address"
                                                class=" @error('address') is-invalid @enderror">
                                        </p>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="city">City</label>
                                            <input type="text" id="city" name="city" type="text"
                                                placeholder="Enter Your City">
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb first">
                                            <label for="latitude">Latitude</label>
                                            <input id="location_latitude" name="location_latitude" type="text"
                                                placeholder="Google Maps latitude">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb last">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" id="location_longitude" name="location_longitude"
                                                placeholder="Google Maps longitude">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-add-property">
                            <h3>Extra Information</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <p>
                                            <label for="address">Youtube Link</label>
                                            <input id="video" name="video"
                                                type="text"class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter youtube link">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Featured Image</label>

                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                        </p>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Floor Plan</label>
                                            <input type="file" name="floor_plan">
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <p>
                                            <label for="address">Upload Gallery Images</label>

                                            <input type="file" name="gallaryimage[]" multiple>
                                            <span class="helper-text" data-error="wrong" data-success="right">Upload one
                                                or more images</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="add-property-button pt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="prperty-submit-button">
                                            <button type="submit">Submit Property</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </section>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
        <script>
            $('.repeater').repeater({
                defaultValues: {
                    'this_id': '1',
                    'this_name': 'foo'
                }
            });
            $(document).ready(function() {
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
                                required: true
                            },
                            area: {
                                required: true
                            },
                            bathroom: {
                                required: true
                            },
                            bedroom: {
                                required: true
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
    @endpush
@endsection
