  <aside class="col-lg-4 col-md-12 car">
      <div class="widget">
          <!-- Search Fields -->
          <div class="widget-boxed main-search-field">
              <div class="widget-boxed-header">
                  <h4>Find Your House</h4>
              </div>
              <!-- Search Form -->
              <div class="trip-search">
                 <form action="{{ route('search') }} " method="POST">
                            @csrf
                      <!-- Form Lookin for -->
                      <div class="form-group looking">
                          <div class="first-select wide">
                              <div class="main-search-input-item">
                                  <input type="text" name="key_word" placeholder="Enter Keyword..." value="" />
                              </div>
                          </div>
                      </div>
                        <br/>
                      <!--/ End Form Lookin for -->
                      <!-- Form Location -->
                      <div class="rld-single-select ml-22">
                          <select name="type" class="browser-default">
                              <option value="" disabled selected>Types</option>
                              @foreach ($types as $type)
                                  <option value="{{ $type->slug }}">{{ $type->name }}</option>
                              @endforeach
                          </select>
                      </div>
                        <br/>
                      <!--/ End Form Location -->
                      <!-- Form Categories -->
                        <div class="rld-single-select ml-22">
                          <select name="purpose" class="browser-default">
                              <option value="" disabled selected>Purpose</option>
                              @foreach ($purposes as $purpose)
                                  <option value="{{ $purpose->slug }}">{{ $purpose->name }}</option>
                              @endforeach
                          </select>
                      </div>

                        <br/>
                      <!--/ End Form Categories -->
                      <!-- Form Property Status -->
                       <div class="rld-single-select ml-22">
                          <select name="city" class="browser-default">
                              <option value="" disabled selected>Cities</option>
                              @foreach ($cities as $city)
                                  <option value="{{ $city->slug }}">{{ $city->name }}</option>
                              @endforeach
                          </select>
                      </div>
                          <br/>
                      <!--/ End Form Property Status -->
                      <!-- Form Bedrooms -->
                     <div class="rld-single-select ml-22">
                          <select name="bedroom" class="browser-default">
                              <option value="" disabled selected>Choose Bedroom</option>
                              @foreach ($bedroomdistinct as $bedroom)
                                  <option value="{{ $bedroom->bedroom }}">{{ $bedroom->bedroom }}</option>
                              @endforeach
                          </select>
                      </div>
                          <br/>
                      <!--/ End Form Bedrooms -->
                      <!-- Form Bathrooms -->
                       <div class="rld-single-select ml-22">
                          <select name="bathroom" class="browser-default">
                              <option value="" disabled selected>Choose Bathroom</option>
                              @foreach ($bathroomdistinct as $bathroom)
                                  <option value="{{ $bathroom->bathroom }}">{{ $bathroom->bathroom }}</option>
                              @endforeach
                          </select>
                      </div>
                           <br/>
                      <!--/ End Form Bathrooms -->

              </div>
              <!--/ End Search Form -->
              <!-- Price Fields -->
              <div class="main-search-field-2">
                  <!-- Area Range -->
                  <div class="range-slider">
                      <label>Area Size</label>
                      <div id="area-range" data-min="0" name="minarea" id="minarea" data-max="1300"
                          data-unit="sq ft"></div>
                      <div class="clearfix"></div>
                  </div>
                  <br>
                  <!-- Price Range -->
                  <div class="range-slider">
                      <label>Price Range</label>
                      <div id="price-range" data-min="0" name="minprice" id="minprice" data-max="600000"
                          data-unit="$"></div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <!-- More Search Options -->
              <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30"
                  data-open-title="Advanced Features" data-close-title="Advanced Features"></a>

              <div class="more-search-options relative">
                  <!-- Checkboxes -->
                  <div class="checkboxes one-in-row margin-bottom-10">
                      @foreach ($features as $key => $feature)
                          <input id="check-{{ $key }}" type="checkbox" name="feature[]">
                          <label for="check-{{ $key }}">{{ $feature->name }}</label>
                      @endforeach
                  </div>
                  <!-- Checkboxes / End -->
              </div>

              <!-- More Search Options / End -->
              <div class="col-lg-12 no-pds">
                  <div class="at-col-default-mar">
                      <button class="btn btn-default hvr-bounce-to-right" type="submit">Search</button>
                  </div>
              </div>
              </form>
          </div>

          <div class="widget-boxed mt-5">
              <div class="widget-boxed-header">
                  <h4>Popular Places</h4>
              </div>
              <div class="widget-boxed-body">
                  <div class="recent-post">
                      <div class="recent-main">
                          <ul>
                              @foreach ($processed_cities as $city)
                                  <li> <a href="{{ route('property.cityslug', $city['city_slug']) }}"><i
                                              class="fa fa-caret-right" aria-hidden="true"></i>{{ $city['city_name'] }}
                                          ({{ $city['total_property'] }})
                                      </a>
                                  </li>
                              @endforeach
                          </ul>
                      </div>

                  </div>
              </div>
          </div>
          <div class="widget-boxed mt-5">
              <div class="widget-boxed-header">
                  <h4>Recent Properties</h4>
              </div>
              @php
                  $counter = 1;
              @endphp
              <div class="widget-boxed-body">
                  <div class="recent-post">
                      @foreach ($recent_properties as $key => $property)
                          <div class="recent-main my-4">
                              <div class="recent-img">
                                  <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                      @if (Storage::disk('public')->exists('property/' . $property->image) && $property->image)
                                          <img src="{{ Storage::url('property/' . $property->image) }}"
                                              alt="{{ $property->title }}" class="img-responsive">
                                      @else
                                      @endif

                              </div>
                              <div class="info-img">
                                  <a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}">
                                      <h6>{{ str_limit($property->title, 22) }}</h6>
                                  </a>
                                  <p>{{ $currency }} {{ number_format($property->price, 2) }}</p>
                              </div>
                          </div>
                      @endforeach
                      {{-- <div class="recent-main my-4">
                          <div class="recent-img">
                              <a href="blog-details.html"><img src="images/feature-properties/fp-2.jpg"
                                      alt=""></a>
                          </div>
                          <div class="info-img">
                              <a href="blog-details.html">
                                  <h6>Luxury Villa House</h6>
                              </a>
                              <p>$120,000</p>
                          </div>
                      </div>
                      <div class="recent-main">
                          <div class="recent-img">
                              <a href="blog-details.html"><img src="images/feature-properties/fp-3.jpg"
                                      alt=""></a>
                          </div>
                          <div class="info-img">
                              <a href="blog-details.html">
                                  <h6>Luxury Family Home</h6>
                              </a>
                              <p>$150,000</p>
                          </div>
                      </div> --}}
                  </div>
              </div>
          </div>
          <div class="widget-boxed popular mt-5 mb-0">
              <div class="widget-boxed-header">
                  <h4>Popular Tags</h4>
              </div>
              <div class="widget-boxed-body">
                  <div class="recent-post">
                      @php
                          $counter = 1;
                      @endphp

                      <div class="tags">

                          @foreach ($tags as $tag)
                              <span><a href="{{ url('property/' . $property->product_code . '/' . $property->slug) }}"
                                      class="btn btn-outline-primary">{{ $tag->name }}</a></span>

                              @if ($counter % 2 === 0)
                      </div>
                      <div class="tags">
                          @endif
                          @php
                              $counter++;
                          @endphp
                          @endforeach

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </aside>
