 <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
     <div class="user-profile-box mb-0">
         <div class="sidebar-header">
             <img src="{{asset('frontend/findhouse/images/logo-blue.svg')}}" alt="header-logo2.png">
         </div>
         <div class="header clearfix">
             <img src="{{Storage::url('users/' . auth()->user()->image)}}" alt="{{auth()->user()->name}}"
                 class="img-fluid profile-img">
         </div>
         <div class="active-user">
             <h2> {{auth()->user()->name}}</h2>
         </div>
         <div class="detail clearfix">
             <ul class="mb-0">
                 <li>
                     <a class="{{Request::is('agent/dashboard') ? 'active' : ''}}"
                         href="{{route('agent.dashboard')}}">
                         <i class="fa fa-map-marker"></i> Dashboard
                     </a>
                 </li>
                 <li>
                     <a class="{{Request::is('agent/profile') ? 'active' : ''}}" href="{{route('agent.profile')}}">
                         <i class="fa fa-user"></i>Profile
                     </a>
                 </li>
                 <li>
                     <a class="{{Request::is('agent/properties') ? 'active' : ''}}"
                         href="{{route('agent.properties.index')}}">
                         <i class="fa fa-list" aria-hidden="true"></i>My Properties
                     </a>
                 </li>
                 <li>
                     <a href="{{route('agent.profile')}}">
                         <i class="fa fa-heart" aria-hidden="true"></i>Favorited Properties
                     </a>
                 </li>
                 <li>
                     <a class="{{Request::is('agent/properties/create') ? 'active' : ''}}"
                         href="{{route('agent.properties.create')}}">
                         <i class="fa fa-list" aria-hidden="true"></i>Add Property
                     </a>
                 </li>


                 <li>
                     <a class="{{Request::is('agent/changepassword') ? 'active' : ''}}"
                         href="{{route('agent.changepassword')}}">
                         <i class="fa fa-lock"></i>Change Password
                     </a>
                 </li>

             </ul>
         </div>
     </div>
 </div>