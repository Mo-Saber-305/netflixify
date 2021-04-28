<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="{{ request()->routeIs('dashboard.welcome') ? 'menuitem-active' : '' }}">
                    <a
                            href="{{ route('dashboard.welcome') }}"
                            class="{{ request()->routeIs('dashboard.welcome') ? 'active' : '' }}"
                    >
                        <i class="mdi mdi-home"></i>
                        <span> dashboard </span>
                    </a>
                </li>
                @if(auth()->user()->hasPermission('read_categories'))
                    <li class="{{ request()->routeIs('dashboard.categories*') ? 'menuitem-active' : '' }}">
                        <a
                                href="{{ route('dashboard.categories.index') }}"
                                class="{{ request()->routeIs('dashboard.categories*') ? 'active' : '' }}"
                        >
                            <i class="mdi mdi-view-list"></i>
                            <span> categories </span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_movies'))
                    <li class="{{ request()->routeIs('dashboard.movies*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('dashboard.movies.index') }}"
                           class="{{ request()->routeIs('dashboard.movies*') ? 'active' : '' }}"
                        >
                            <i class="mdi mdi-video"></i>
                            <span> movies </span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_roles'))
                    <li class="{{ request()->routeIs('dashboard.roles*') ? 'menuitem-active' : '' }}">
                        <a
                                href="{{ route('dashboard.roles.index') }}"
                                class="{{ request()->routeIs('dashboard.roles*') ? 'active' : '' }}"
                        >
                            <i class="mdi mdi-account-lock"></i>
                            <span> roles </span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_users'))
                    <li class="{{ request()->routeIs('dashboard.users*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('dashboard.users.index') }}"
                           class="{{ request()->routeIs('dashboard.users*') ? 'active' : '' }}"
                        >
                            <i class="mdi mdi-account-group"></i>
                            <span> users </span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_settings'))
                    <li>
                        <a href="#settings_links" data-toggle="collapse"
                           class="{{ request()->routeIs('dashboard.settings*') ? 'menuitem-active' : '' }}"
                           aria-expanded="{{ request()->routeIs('dashboard.settings*') ? 'true' : 'false' }}">
                            <i class="mdi mdi-cog"></i>
                            <span> settings </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('dashboard.settings*') ? 'show' : '' }}"
                             id="settings_links" style="">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('dashboard.settings.social_login') }}"
                                       class="{{ request()->routeIs('dashboard.settings.social_login') ? 'menuitem-active' : '' }}">
                                        <i class="mdi mdi-minus"></i>
                                        <span>social login</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard.settings.social_links') }}"
                                       class="{{ request()->routeIs('dashboard.settings.social_links') ? 'menuitem-active' : '' }}">
                                        <i class="mdi mdi-minus"></i>
                                        <span>social links</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
