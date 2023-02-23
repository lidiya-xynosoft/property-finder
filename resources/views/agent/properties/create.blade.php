@extends('frontend.layouts.profile')

@section('title', 'Create Property')

@section('content')
@push('head')
   <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">

    @endpush
    <section class="user-page section-padding">
        <div class="container-fluid">
            <div class="row">


                @include('agent.sidebar')

                <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    <div class="col-lg-12 mobile-dashbord dashbord">
                        <div class="dashboard_navigationbar dashxl">
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard
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
                <form action="{{route('agent.properties.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="single-add-property">
                            <h3>Property description and price</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="title">Property Title</label>
                                            <input type="text" name="title" id="title"
                                                placeholder="Enter your property title" data-length="200">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="description">Property Description</label>
                                            <textarea id="description" name="description" placeholder="Describe about your property"></textarea>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" placeholder="USD" id="price">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Floor Area</label>
                                            <input type="text" name="area" placeholder="Sqft" id="area">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Bedroom</label>
                                            <input type="text" id="bedroom" name="bedroom" type="number"
                                                class="validate">
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Bathroom</label>
                                            <input type="text" id="bathroom" name="bathroom" type="number"
                                                class="validate">
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Near By</label>
                                            <input type="text" id="nearby" name="nearby" type="number"
                                                class="validate">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 dropdown faq-drop">
                                        <div class="form-group categories">
                                            <div class="nice-select form-control wide" tabindex="0"><span
                                                    class="current">Select status</span>
                                                <select class="list" name="purpose">
                                                    <option value="rent" class="option">
                                                        Rent
                                                    </option>
                                                    <option value="sale" class="option">
                                                        Sale
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 dropdown faq-drop">
                                        <div class="form-group categories">
                                            <div class="nice-select form-control wide" tabindex="0"><span
                                                    class="current">Type</span>
                                                <select class="list" name="type">
                                                    <option value="house" class="option">
                                                        house</option>
                                                    <option value="commercial" class="option">commercial</option>
                                                    <option value="apartment" class="option">apartment</option>
                                                </select>
                                            </div>
                                        </div>
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

                                              @foreach($features as $feature)
                                                <li class="fl-wrap filter-tags clearfix">
                                                    <div class="checkboxes float-left">
                                                        <div class="filter-tags-wrap">
                                                            <input id="check-k" type="checkbox" name="features[]"
                                                                value="{{$feature->id}}">
                                                            <label for="check-k">{{$feature->name}}</label>
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
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Address</label>
                                            <input type="text" id="address" name="address"
                                                placeholder="Enter Your Address">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="city">City</label>
                                            <input type="text" id="city" name="city" type="text"
                                                class="validate" placeholder="Enter Your City">
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p class="no-mb first">
                                            <label for="latitude">Latitude</label>
                                            <input id="location_latitude" name="location_latitude" type="text"
                                                class="validate" placeholder="Google Maps latitude">
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
                                            <input id="video" name="video" type="text" class="validate"
                                                placeholder="Enter youtube link">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Featured Image</label>

                                            <input type="file" name="image">
                                        </p>
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
@endsection