 <!-- START FOOTER -->
 <footer class="first-footer rec-pro">
     <div class="top-footer">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-3 col-md-6">
                     <div class="netabout">
                         <a href="index.html" class="logo">
                             <img src="images/logo-footer.svg" alt="netcom">
                         </a>
                         @if (isset($footersettings[0]) && $footersettings[0]['aboutus'])
                             <p>{{ $footersettings[0]['aboutus'] }}</p>
                         @else
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum incidunt architecto soluta
                                 laboriosam, perspiciatis, aspernatur officiis esse.</p>
                         @endif
                     </div>
                     <div class="contactus">
                         <ul>
                             <li>
                                 <div class="info">
                                     <i class="fa fa-map-marker" aria-hidden="true"></i>
                                     <p class="in-p">95 South Park Avenue, USA</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="info">
                                     <i class="fa fa-phone" aria-hidden="true"></i>
                                     <p class="in-p">+456 875 369 208</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="info">
                                     <i class="fa fa-envelope" aria-hidden="true"></i>
                                     <p class="in-p ti">support@findhouses.com</p>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-3 col-md-6">
                     <div class="navigation">
                         <h3>Navigation</h3>
                         <div class="nav-footer">
                             <ul>
                                 <li class="uppercase {{ Request::is('property*') ? 'underline' : '' }}">
                                     <a href="{{ route('property') }}" class="grey-text text-lighten-3">Properties</a>
                                 </li>

                                 <li class="uppercase {{ Request::is('agents*') ? 'underline' : '' }}">
                                     <a href="{{ route('agents') }}" class="grey-text text-lighten-3">Agents</a>
                                 </li>

                                 <li class="uppercase {{ Request::is('gallery*') ? 'underline' : '' }}">
                                     <a href="{{ route('gallery') }}" class="grey-text text-lighten-3">Gallery</a>
                                 </li>


                             </ul>

                             <ul class="nav-right">
                                 <li class="uppercase {{ Request::is('blog*') ? 'underline' : '' }}">
                                     <a href="{{ route('blog') }}" class="grey-text text-lighten-3">Blog</a>
                                 </li>

                                 <li class="uppercase {{ Request::is('contact') ? 'underline' : '' }}">
                                     <a href="{{ route('contact') }}" class="grey-text text-lighten-3">Contact Us</a>
                                 </li>
                                 <li class="no-mgb"><a href="contact-us.html">Contact Us</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-3 col-md-6">
                     <div class="widget">
                         <h3>Recent Properties</h3>
                         <div class="twitter-widget contuct">
                             <div class="twitter-area">
                                 @foreach ($footerproperties as $post)
                                     <div class="recent-main">
                                         @if (Storage::disk('public')->exists('property/' . $post->image) && $post->image)
                                             <div class="recent-img">
                                                 <a href="{{ route('blog.show', $post->slug) }}"><img
                                                         src="{{ Storage::url('property/' . $post->image) }}"
                                                         alt="{{ $post->title }}"></a>
                                             </div>
                                         @endif

                                         <div class="info-img">
                                             <a href="blog-details.html">
                                                 <h6>{{ $post->title }}</h6>
                                             </a>
                                             <p>{{ $post->created_at->diffForHumans() }}</p>
                                         </div>
                                     </div>
                                 @endforeach

                             </div>
                         </div>
                     </div>

                 </div>
                 <div class="col-lg-3 col-md-6">
                     <div class="newsletters">
                         <h3>Newsletters</h3>
                         <p>Sign Up for Our Newsletter to get Latest Updates and Offers. Subscribe to receive news in
                             your inbox.</p>
                     </div>
                     <form class="bloq-email mailchimp form-inline" method="post">
                         <label for="subscribeEmail" class="error"></label>
                         <div class="email">
                             <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Enter Your Email">
                             <input type="submit" value="Subscribe">
                             <p class="subscription-success"></p>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="second-footer rec-pro">
         <div class="container-fluid sd-f">
             @if (isset($footersettings[0]) && $footersettings[0]['footer'])
                 <p> {{ $footersettings[0]['footer'] }}</p>
             @else
                 <p>2021 © Copyright - All Rights Reserved.</p>
             @endif
             <ul class="netsocials">
                 @if (isset($footersettings[0]) && $footersettings[0]['facebook'])
                     <li><a href="{{ $footersettings[0]['facebook'] }}" target="_blank"><i class="fa fa-facebook"
                                 aria-hidden="true"></i></a></li>
                 @endif
                 @if (isset($footersettings[0]) && $footersettings[0]['twitter'])
                     <li><a href="{{ $footersettings[0]['twitter'] }}" target="_blank"><i class="fa fa-twitter"
                                 aria-hidden="true"></i></a></li>
                 @endif
                 @if (isset($footersettings[0]) && $footersettings[0]['linkedin'])
                     <li><a href="{{ $footersettings[0]['linkedin'] }}" target="_blank"><i
                                 class="fa fa-linkedin"></i></a></li>
                 @endif
                 @if (isset($footersettings[0]) && $footersettings[0]['youtube'])
                     <li><a href="{{ $footersettings[0]['youtube'] }}" target="_blank"><i class="fa fa-youtube"
                                 aria-hidden="true"></i></a></li>
                 @endif
             </ul>

         </div>
     </div>
 </footer>

 <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
 <!-- END FOOTER -->
