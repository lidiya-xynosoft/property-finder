     <!-- START SECTION HEADINGS -->
     <!-- Header Container
        ================================================== -->
     <div class="dash-content-wrap">
         <header id="header-container" class="db-top-header">
             <!-- Header -->
             <div id="header">
                 <div class="container-fluid">
                     <!-- Left Side Content -->
                     <div class="left-side">
                         <!-- Logo -->
                         <div id="logo">
                             <a href="{{ route('home') }}"><img
                                     src="{{ asset('frontend/findhouse/images/logo-white-1.svg') }}"
                                     data-sticky-logo="{{ asset('frontend/findhouse/images/logo-white-1.svg') }}"
                                     alt=""></a>
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
                         <nav id="navigation" class="style-1">
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
                         <div class="clearfix"></div>
                         <!-- Main Navigation / End -->
                     </div>
                     <!-- Left Side Content / End -->
                     <!-- Right Side Content / -->
                     <div class="header-user-menu user-menu">
                         @if (!empty(Auth::user()->image))
                         <div class="header-user-name">
                             <span><img src="{{ Storage::url('users/' . auth()->user()->image) }}"
                                     alt=""></span>
                             {{ ucfirst(Auth::user()->username) }}
                         </div>
                       
                         <ul>
                             @if (Auth::user()->role->id == 1)
                                 <li><a href="{{ route('admin.dashboard') }}">
                                         Profile
                                     </a></li>
                                 <li><a href="{{ route('admin.changepassword') }}">
                                         Change password
                                     </a></li>
                             @elseif(Auth::user()->role->id == 2)
                                 <li><a href="{{ route('agent.dashboard') }}">
                                         Profile
                                     </a></li>
                                       <li><a href="{{ route('agent.changepassword') }}">
                                         Change password
                                     </a></li>
                             @elseif(Auth::user()->role->id == 3)
                                 <li><a href="{{ route('user.dashboard') }}">
                                         Profile
                                     </a></li>
                                       <li><a href="{{ route('user.changepassword') }}">
                                         Change password
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
                     <!-- Right Side Content / End -->
                 </div>
             </div>
             <!-- Header / End -->
         </header>
     </div>
     <div class="clearfix"></div>
