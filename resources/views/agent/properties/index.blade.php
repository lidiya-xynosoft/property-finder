@extends('frontend.layouts.profile')



@section('content')
@push('head')
   <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/findhouse/css/owl-carousel.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('frontend/findhouse/css/default.css') }}">

    @endpush
    <section class="user-page section-padding pt-5">
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
                    <div class="my-properties">
                        <table class="table-responsive">
                            <thead>
                                <tr>
                                    <th class="pl-2">My Properties</th>
                                    <th class="p-0"></th>
                                    <th>Date Added</th>
                                    <th>Views</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $key => $property)
                                    <tr>
                                        <td class="image myelist">
                                            <a href="single-property-1.html">
                                                <img alt="my-properties-3" src="images/feature-properties/fp-1.jpg"
                                                    class="img-fluid"></a>
                                        </td>
                                        <td>
                                            <div class="inner">
                                                <a href="single-property-1.html">
                                                    <h2> {{ str_limit($property->title, 30) }}</h2>
                                                </a>
                                                <figure><i class="lni-map-marker"></i> {{ ucfirst($property->address) }}
                                                </figure>
                                                <ul class="starts text-left mb-0">
                                                    <li class="mb-0"><i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="mb-0"><i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="mb-0"><i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="mb-0"><i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="mb-0"><i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="ml-3">(6 Reviews)</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $property->created_at }}</td>
                                        <td>{{ $property->price }}</td>
                                        <td class="actions">
                                            <a href="{{ route('agent.properties.edit', $property->slug) }}"
                                                class="edit"><i class="lni-pencil"></i>Edit</a>
                                            <button type="button" class="btn btn-small deep-orange accent-3 waves-effect"
                                                onclick="deleteProperty({{ $property->id }})">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <nav>
                                <ul class="pagination">
                                    {{ $properties->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteProperty(id){
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "Yes, delete it!"]
            }).then((value) => {
                if (value) {
                    document.getElementById('del-property-'+id).submit();
                    swal(
                    'Deleted!',
                    'Property has been deleted.',
                    'success',
                    {
                        buttons: false,
                        timer: 1000,
                    })
                }
            })
        }
    </script>
@endsection
