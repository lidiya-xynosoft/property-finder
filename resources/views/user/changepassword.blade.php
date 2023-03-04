@extends('frontend.layouts.profile')
@section('title', 'Change Password')

@section('content')
@push('head')
   <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">

    @endpush
    <section class="user-page section-padding pt-50">
        <div class="container-fluid">
            <div class="row">
                @include('user.sidebar')
                <div class="col-lg-7 col-md-6 col-xs-6 pl-3 offset-lg-1 offset-md-3">
                   <div class="col-lg-12 mobile-dashbord dashbord">
                        <div class="dashboard_navigationbar dashxl">
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard
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
                    <div class="my-address">
                        <h3 class="heading pt-0">Change Password</h3>
                            <form action="{{route('user.changepassword.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group name">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control validate"
                                            id="currentpassword" name="currentpassword" placeholder="Current Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group email">
                                        <label>New Password</label>
                                        <input type="password" id="newpassword" name="newpassword" class="form-control validate"
                                            placeholder="New Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label>Confirm New Password</label>
                                        <input type="password" id="new-password_confirmation" name="newpassword_confirmation" class="form-control validate"
                                            placeholder="Confirm New Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="send-btn mt-2">
                                        <button type="submit" class="btn btn-common">Send Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

