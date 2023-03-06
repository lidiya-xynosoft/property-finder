@push('head')
 
@endpush
<!-- STAR HEADER SEARCH -->
<section id="hero-area" class="parallax-searchs home15 overlay thome-6" style="background: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.5))),
                url({{Storage::url('slider/'.$homeImage->image)}}) no-repeat center top !important;background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{Storage::url('slider/'.$homeImage->image)}}) no-repeat center top !important;background-size: cover;
  background-attachment: fixed !important;
  width: 100%;
  height: 95vh;
  position: relative;
  z-index: 99;" data-stellar-background-ratio="0.5">
    <div class="hero-main">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-12">
                    <div class="hero-inner">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h1 class="h1">Find Your Dream
                                <br class="d-md-none">
                                <span class="typed border-bottom"></span>
                            </h1>
                            <p class="mt-4">We Have Over Million Properties For You.</p>
                        </div>
                        <!--/ End Welcome Text -->
                        <!-- Search Form -->
                        <form action="{{ route('search') }} " method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="banner-search-wrap">
                                    <ul class="nav nav-tabs rld-banner-tab">
                                        @foreach ($types as $key => $purpose)
                                            {{-- <li class="nav-item">
                                               <a class="nav-link active" data-toggle="tab" href="#tabs_1">For {{ $purpose->name }}</a>
                                           </li> --}}
                                            <li class="nav-item">
                                                <a class="nav-link @if ($key == 0) ? active : '' @endif"
                                                    data-toggle="tab" href="#tabs_2">For {{ $purpose->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tabs_1">
                                            <div class="rld-main-search">
                                                <div class="row">
                                                    <div class="rld-single-input">
                                                        <input type="text" name="keyword"
                                                            placeholder="Enter Keyword...">
                                                    </div>
                                                    <div class="rld-single-select ml-22">
                                                        <select class="select single-select" name="type">
                                                            <option>Property Type</option>
                                                            @foreach ($types as $type)
                                                                <option value="{{ $type->id }}">
                                                                    {{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="rld-single-select">
                                                        <select class="select single-select mr-0" name="city">
                                                            <option>City</option>
                                                            @foreach ($cities_all as $city)
                                                                <option value="{{ $city->id }}">
                                                                    {{ $city->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="dropdown-filter"><span>Advanced Search</span></div>
                                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                        <button type="submit" class="btn btn-yellow">
                                                            Search Now
                                                        </button>
                                                    </div>
                                                    <div class="explore__form-checkbox-list full-filter">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                                <div class="rld-single-select ml-22">
                                                                    <select class="select single-select" name="purpose">
                                                                        <option>Choose Type</option>
                                                                        @foreach ($purposes as $purpose)
                                                                            <option value="{{ $purpose->id }}">
                                                                                {{ $purpose->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <!--/ End Form Property Status -->
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                                <!-- Form Bedrooms -->
                                                                <div class="form-group beds">
                                                                    <div class="rld-single-select ml-22">
                                                                        <select class="select single-select"
                                                                            name="bedroom">
                                                                            <option>No of bedrooms</option>
                                                                            @if (isset($bedroomdistinct))
                                                                                @foreach ($bedroomdistinct as $bedroom)
                                                                                    <option
                                                                                        value="{{ $bedroom->bedroom }}">
                                                                                        {{ $bedroom->bedroom }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <!--/ End Form Bedrooms -->
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                                <!-- Form Bathrooms -->
                                                                <div class="rld-single-select ml-22">
                                                                    <select class="select single-select"
                                                                        name="bathroom">
                                                                        <option>No of bathrooms</option>
                                                                        @if (isset($bathroomdistinct))
                                                                            @foreach ($bathroomdistinct as $bathroom)
                                                                                <option
                                                                                    value="{{ $bathroom->bathroom }}">
                                                                                    {{ $bathroom->bathroom }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <!--/ End Form Bathrooms -->
                                                            </div>
                                                            <div
                                                                class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld d-none d-lg-none d-xl-flex">
                                                                <!-- Price Fields -->
                                                                <div class="main-search-field-2">
                                                                    <!-- Area Range -->
                                                                    <div class="range-slider">
                                                                        <label>Area Size</label>
                                                                        <div id="area-range" data-min="0"
                                                                            data-max="1300" data-unit="sq ft"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <br>
                                                                    <!-- Price Range -->
                                                                    <div class="range-slider">
                                                                        <label>Price Range</label>
                                                                        <div id="price-range" data-min="0"
                                                                            data-max="600000" data-unit="$"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-none d-lg-none d-xl-flex">
                                                                <!-- Checkboxes -->
                                                                <div
                                                                    class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                                    @foreach ($features as $key => $feature)
                                                                        <input id="features-{{ $key }}"
                                                                            type="checkbox" name="features[]"
                                                                            value="{{ $feature->id }}">
                                                                        <label
                                                                            for="features-{{ $key }}">{{ $feature->name }}</label>
                                                                    @endforeach

                                                                </div>
                                                                <!-- Checkboxes / End -->
                                                            </div>
                                                            <div
                                                                class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 d-none d-lg-none d-xl-flex">
                                                                <!-- Checkboxes -->
                                                                <div
                                                                    class="checkboxes one-in-row margin-bottom-10 ch-2">
                                                                    @foreach ($features as $key => $feature)
                                                                        <input id="features-{{ $key }}"
                                                                            type="checkbox" name="features[]">
                                                                        <label
                                                                            for="features-{{ $key }}">{{ $feature->name }}</label>
                                                                    @endforeach
                                                                </div>
                                                                <!-- Checkboxes / End -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Search Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END HEADER SEARCH -->
