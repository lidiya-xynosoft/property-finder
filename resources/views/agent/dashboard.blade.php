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
                    <div class="dashborad-box stat bg-white">
                        <h4 class="title">Manage Dashboard</h4>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-xs-12 dar pro mr-3">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{ $propertytotal }}</h6>
                                            <p class="type ml-1">Published Property</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-xs-12 dar rev mr-3">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{ $messagetotal }}</h6>
                                            <p class="type ml-1">Messages</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="dashborad-box">
                        <h4 class="title">Listing</h4>
                        <div class="section-body listing-table">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Listing Name</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($properties as $key => $property)
                                            <tr>
                                                <td> {{ ++$key }}. {{ str_limit($property->title, 28) }}</td>
                                                <td>{{ $property->created_at }}</td>
                                                <td class="rating"><span>{{ $property->price }}</span></td>
                                                <td class="status"><span class=" active">Active</span></td>
                                                <td class="edit"><a
                                                        href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"><i
                                                            class="fa fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="dashborad-box">
                        <h4 class="title">Message</h4>
                        <div class="section-body">
                            <div class="messages">
                                @foreach ($messages as $message)
                                    <div class="message">
                                        <div class="thumb">
                                            <img class="img-fluid" src="images/testimonials/ts-1.jpg" alt="">
                                        </div>
                                        <div class="body">
                                            <h6>{{ strtok($message->name, ' ') }}:</h6>
                                            <p class="post-time">22 Minutes ago</p>
                                            <p class="content mb-0 mt-2">{{ str_limit($message->message, 25) }}</p>
                                            <div class="controller">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
