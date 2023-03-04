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
                    <div class="dashborad-box stat bg-white">
                        <h4 class="title">Manage Dashboard</h4>
                        <div class="section-body">
                            <div class="row">
                               
                                <div class="col-lg-3 col-md-6 col-xs-12 dar rev mr-3">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{ $commentcount }}</h6>
                                            <p class="type ml-1">Messages</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <div class="dashborad-box">
                        <h4 class="title">Recent Comments</h4>
                        <div class="section-body listing-table">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          @foreach($comments as $key => $comment)
                                            <tr>
                                                <td> {{ ++$key }}. {{ $comment->body }}</td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-container">
                            <nav>
                                <ul class="pagination">
                                    {{ $comments->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                   
                </div>

            </div>
        </div>
    </section>
@endsection

