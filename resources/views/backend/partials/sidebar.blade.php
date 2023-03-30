    <aside id="leftsidebar" class="sidebar">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li class="header">MAIN NAVIGATION</li>

                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sliders.index') }}">
                        <i class="material-icons">burst_mode</i>
                        <span>Sliders</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">house</i>
                        <span>Property</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/properties*') ? 'active' : '' }}">
                            <a href="{{ route('admin.properties.index') }}">
                                <span>All Property</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/types*') ? 'active' : '' }}">
                            <a href="{{ route('admin.types.index') }}">
                                {{-- <i class="material-icons">abc</i> --}}
                                <span>Types</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/purposes*') ? 'active' : '' }}">
                            <a href="{{ route('admin.purposes.index') }}">
                                {{-- <i class="material-icons">grading</i> --}}
                                <span>Purpose</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="{{ Request::is('admin/aminities*') ? 'active' : '' }}">
                    <a href="{{ route('admin.aminities.index') }}">
                        <i class="material-icons">star</i>
                        <span>Aminities</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/services*') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}">
                        <i class="material-icons">wb_sunny</i>
                        <span>Features</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li class="header">COMPLAINTS & SERVICES</li>
                <li class="{{ Request::is('admin/tenant-service*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tenant-service.index') }}">
                        <i class="material-icons">room_service</i>
                        <span>Tenant Services</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/handyman*') ? 'active' : '' }}">
                    <a href="{{ route('admin.handyman.index') }}">
                        <i class="material-icons">format_clear</i>
                        <span>Handyman</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/complaint*') ? 'active' : '' }}">
                    <a href="{{ route('admin.complaint') }}">
                        <i class="material-icons">assistant</i>
                        <span>Tenant Complaints</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/cancellation-reason*') ? 'active' : '' }}">
                    <a href="{{ route('admin.cancellation-reason.index') }}">
                        <i class="material-icons">event_busy</i>
                        <span>Cancellation Reason</span>
                    </a>
                </li>

                <li class="header">ACCOUNTS</li>
                <li class="{{ Request::is('admin/ledger*') ? 'active' : '' }}">
                    <a href="{{ route('admin.ledger.index') }}">
                        <i class="material-icons">view_list</i>
                        <span>Ledger</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/daybook') ? 'active' : '' }}">
                    <a href="{{ url('admin/daybook') }}">
                        <i class="material-icons">
                            account_balance
                        </i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="header">TENANTS</li>
                <li class="{{ Request::is('admin/tenants*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tenants.index') }}">
                        <i class="material-icons">people</i>
                        <span>Tenants</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tenancy-list') ? 'active' : '' }}">
                    <a href="{{ url('admin/tenancy-list') }}">
                        <i class="material-icons">list</i>
                        <span>Tenant List</span>
                    </a>
                </li>

                <li class="header">BLOG</li>
                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="material-icons">category</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tags.index') }}">
                        <i class="material-icons">label</i>
                        <span>Tags</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>

                <li class="header"> </li>
                {{-- <li class="{{ Request::is('admin/galleries*') ? 'active' : '' }}">
                    <a href="{{ route('admin.album') }}">
                        <i class="material-icons">view_list</i>
                        <span>Gallery</span>
                    </a>
                </li> --}}

                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <ul class="ml-menu">

                        <li class="{{ Request::is('admin/countries*') ? 'active' : '' }}">
                            <a href="{{ route('admin.countries.index') }}">
                                <span>Country</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/cities*') ? 'active' : '' }}">
                            <a href="{{ route('admin.cities.index') }}">
                                <span>City</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings') }}">
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/changepassword') ? 'active' : '' }}">
                            <a href="{{ route('admin.changepassword') }}">
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a href="{{ route('admin.profile') }}">
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/message*') ? 'active' : '' }}">
                            <a href="{{ route('admin.message') }}">
                                <span>Message</span>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </div>
        <!-- #Menu -->

    </aside>
