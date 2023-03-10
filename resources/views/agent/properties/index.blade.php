@extends('frontend.layouts.profile')

@section('title', 'Properties')


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
                                            @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                                <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                                    class="img-fluid">
                                                    <img src="{{ Storage::url('property/' . $property->image) }}"
                                                        alt="{{ $property->title }}"></a>
                                            @else
                                            @endif

                                        </td>
                                        <td>
                                            <div class="inner">
                                                <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
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
                                                    <li class="ml-3">({{ $property->comments_count }} Reviews)</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $property->created_at }}</td>
                                        <td>{{ $currency }} {{ $property->price }}</td>
                                        <td class="actions">
                                            <a href="{{ route('agent.properties.edit', $property->slug) }}"
                                                class="edit"><i class="fa fa-list mr-3"></i></a>

                                            <a href="#" onclick="deleteProperty({{ $property->id }})"
                                                class="edit"><i class="fa fa-remove mr-3"></i></a>
                                            <form action="{{ route('agent.properties.destroy', $property->slug) }}"
                                                method="POST" id="del-property_{{ $property->id }}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <nav>
                                <ul class="pagination">
                                    {{ $properties->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @push('script')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            var deleteProperty = function(id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    buttons: ["Cancel", "Yes, delete it!"]
                }).then((value) => {
                    if (value) {
                        // document.getElementById('del-property_' + id).submit();
                        document.forms['del-property_' + id].submit();
                        swal(
                            'Deleted!',
                            'Property has been deleted.',
                            'success', {
                                buttons: false,
                                timer: 1000,
                            })
                    }
                })
            }
        </script>
    @endpush
@endsection
