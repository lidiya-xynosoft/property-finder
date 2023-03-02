   <!-- main slider carousel items -->
   <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
       <h5 class="mb-4">Gallery</h5>
       <div class="carousel-inner">
           @foreach ($property->gallery as $key => $gallery)
               @if ($key == 0)
                   <div class="active item carousel-item" data-slide-number="{{ $key }}">
                   @else
                       <div class="item carousel-item" data-slide-number="{{ $key }}">
               @endif

               <img src="{{ Storage::url('property/gallery/' . $gallery->name) }}" class="img-fluid" alt="slider-listing">
       </div>
       @endforeach

       <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i
               class="fa fa-angle-left"></i></a>
       <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i
               class="fa fa-angle-right"></i></a>

   </div>
   <!-- main slider carousel nav controls -->
   <ul class="carousel-indicators smail-listing list-inline">
       @foreach ($property->gallery as $key => $gallery)
           @if ($key == 0)
               <li class="list-inline-item active">
                   <a id="carousel-selector-{{ $key }}" class="selected" data-slide-to="{{ $key }}"
                       data-target="#listingDetailsSlider">
                   @else
               <li class="list-inline-item">
                   <a id="carousel-selector-{{ $key }}" data-slide-to="{{ $key }}"
                       data-target="#listingDetailsSlider">
           @endif

           <img src="{{ Storage::url('property/gallery/' . $gallery->name) }}" class="img-fluid" alt="{{ $gallery->name }}">
           </a>
           </li>
       @endforeach
   </ul>
   <!-- main slider carousel items -->
   </div>
