   <header id="header-container" class="{{ Request::is('/') ? 'header head-tr' : '' }}">
       <!-- Header -->
       <div id="header" class="{{ Request::is('/') ? 'head-tr bottom' : '' }}">
           <div class="container container-header">
               <!-- Left Side Content -->
               <div class="left-side">
                   <!-- Logo -->
                   <div id="logo">
                       <a href="{{ route('home') }}">
                           @if (Request::is('/'))
                               <img src="{{ asset('frontend/findhouse/images/logo-red.svg') }}"
                                   data-sticky-logo="{{ asset('frontend/findhouse/images/logo-red.svg') }}"
                                   alt="">
                           @else
                               <img src="{{ asset('frontend/findhouse/images/logo-white-1.svg') }}"
                                   data-sticky-logo="{{ asset('frontend/findhouse/images/logo-white-1.svg') }}"
                                   alt="">
                           @endif

                       </a>
                   </div>
                   <!-- Mobile Navigation -->
                   <div class="mmenu-trigger">
                       <button class="hamburger hamburger--collapse" type="button">
                           <span class="hamburger-box">
                               <span class="hamburger-inner"></span>
                           </span>
                       </button>
                   </div>
                   <!-- Main Navigation -->
                   <nav id="navigation" class="{{ Request::is('/') ? 'style-1 head-tr' : 'style-1' }}">
                       <ul id="responsive">
                           <li class="{{ Request::is('/') ? 'active' : '' }}">
                               <a href="{{ route('home') }}">Home</a>
                           </li>

                           <li class="{{ Request::is('property*') ? 'active' : '' }}">
                               <a href="{{ route('property') }}">Properties</a>
                           </li>

                           <li class="{{ Request::is('agents*') ? 'active' : '' }}">
                               <a href="{{ route('agents') }}">Agents</a>
                           </li>

                           <li class="{{ Request::is('gallery') ? 'active' : '' }}">
                               <a href="{{ route('gallery') }}">Gallery</a>
                           </li>

                           <li class="{{ Request::is('blog*') ? 'active' : '' }}">
                               <a href="{{ route('blog') }}">Blog</a>
                           </li>

                           <li class="{{ Request::is('contact') ? 'active' : '' }}">
                               <a href="{{ route('contact') }}">Contact</a>
                           </li>
                       </ul>
                   </nav>
                   <!-- Main Navigation / End -->
               </div>
               <!-- Left Side Content / End -->
               @if (Auth::user())
                   <!-- Right Side Content / End -->
                   <div class="right-side d-none d-none d-lg-none d-xl-flex">
                       <!-- Header Widget -->
                       @if (Auth::user()->role->id == 2)
                           <div class="header-widget">
                               <a href="add-property.html" class="button border">Add Listing<i
                                       class="fas fa-laptop-house ml-2"></i></a>
                           </div>
                       @endif
                       <!-- Header Widget / End -->
                   </div>
                   <!-- Right Side Content / End -->

                   <!-- Right Side Content / End -->
                   <div class="header-user-menu user-menu add">
                       @if (!empty(Auth::user()->image))
                           <div class="header-user-name">
                               <span><img src="{{ Storage::url('users/' . auth()->user()->image) }}"
                                       alt=""></span>
                               {{ ucfirst(Auth::user()->name) }}
                           </div>

                           <ul>
                               @if (Auth::user()->role->id == 1)
                                   <li><a href="{{ route('admin.dashboard') }}">
                                           Profile
                                       </a></li>
                               @elseif(Auth::user()->role->id == 2)
                                   <li><a href="{{ route('agent.dashboard') }}">
                                           Profile
                                       </a></li>
                               @elseif(Auth::user()->role->id == 3)
                                   <li><a href="{{ route('user.dashboard') }}">
                                           Profile
                                       </a></li>
                               @endif
                               <li>
                                   <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                   </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                       style="display: none;">
                                       @csrf
                                   </form>
                               </li>
                           </ul>
                       @endif
                   </div>
               @endif

               <!-- lang-wrap-->
               @guest
                   <div class="header-user-menu user-menu add d-none d-lg-none d-xl-flex">
                       <div class="lang-wrap">
                           <div class="show-lang"><span><i class="fas fa-globe-americas"></i><strong>ENG</strong></span><i
                                   class="fa fa-caret-down arrlan"></i></div>
                           <ul class="lang-tooltip lang-action no-list-style">
                               <li><a href="#" class="current-lan" data-lantext="En">English</a></li>
                               <li><a href="#" data-lantext="Fr">Francais</a></li>
                               <li><a href="#" data-lantext="Es">Espanol</a></li>
                               <li><a href="#" data-lantext="De">Deutsch</a></li>
                           </ul>
                       </div>
                   </div>


                   <!-- lang-wrap end-->
                   <!-- Right Side Content / End -->

                   <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                       <!-- Header Widget -->
                       <div class="header-widget sign-in">
                           <div><a href="{{ route('login') }}">Sign In</a></div>
                       </div>
                       <!-- Header Widget / End -->
                   </div>
               @endguest
               <!-- Right Side Content / End -->
           </div>
       </div>
       <!-- Header / End -->

   </header>
   <div class="clearfix"></div>
