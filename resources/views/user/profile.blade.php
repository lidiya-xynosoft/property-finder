@extends('frontend.layouts.profile')
@section('title', 'Agent dashboard')

@section('styles')
@endsection

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


                @include('user.sidebar')

                <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    <div class="col-lg-12 mobile-dashbord dashbord">
                        <div class="dashboard_navigationbar dashxl">
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i>
                                    Dashboard
                                    Navigation</button>
                                <ul id="myDropdown" class="dropdown-content">
                                    <li>
                                        <a class="{{ Request::is('user/dashboard') ? 'active' : '' }}"
                                            href="{{ route('user.dashboard') }}">
                                            <i class="fa fa-map-marker mr-3"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ Request::is('user/profile') ? 'active' : '' }}"
                                            href="{{ route('agent.profile') }}">

                                            <i class="fa fa-user mr-3"></i>Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('user.profile') }}">
                                            <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                                        </a>
                                    </li>


                                    <li>
                                        <a class="{{ Request::is('user/changepassword') ? 'active' : '' }}"
                                            href="{{ route('user.changepassword') }}">
                                            <i class="fa fa-lock mr-3"></i>Change Password
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
             
                    <div class="clearfix"></div>
                    &nbsp;&nbsp;
                    <div class="dashborad-box mb-0">
                        <div class="widget-boxed-header">
                            <h4>Personal Information</h4>
                        </div>
                        <div class="section-inforamation">
                            <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input id="name" class="form-control" placeholder="Enter your First name"
                                                name="name" type="text" value="{{ $profile->name }}"
                                                class="validate">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input id="username" class="form-control" placeholder="Enter your First name"
                                                name="last_name" type="text" value="{{ $profile->username }}"
                                                class="validate">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input id="email" name="email" class="form-control"
                                                placeholder="Ex: example@domain.com" type="email"
                                                value="{{ $profile->email }}" class="validate">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input id="contact_no" required name="contact_no" class="form-control"
                                                placeholder="Ex: +1-800-7700-00" type="text"
                                                value="{{ $profile->contact_no }}" class="validate">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Address</label>

                                            <textarea id="address" name="address" class="form-control" placeholder="Write your address here">{{ $profile->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>About Yourself</label>
                                            <textarea id="about" name="about" class="form-control" placeholder="Write about userself">{{ $profile->about }}</textarea>

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg mt-2">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
