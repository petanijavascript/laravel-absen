        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a href="index.html"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                </li>
                <li class=" navigation-header"><span>Master&nbsp;Data</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Our Projects">Our Projects</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('countries') ? 'active' : '' }}"><a href="/countries"><i class="feather icon-box"></i><span class="menu-item" datad-i18n="Countries">Countries</span></a>
                        </li>
                        <li class="{{ request()->is('states') ? 'active' : '' }}"><a href="/states"><i class="feather icon-box"></i><span class="menu-item" data-i18n="States">States</span></a>
                        </li>
                        <li class="{{ request()->is('cities') ? 'active' : '' }}"><a href="/cities"><i class="feather icon-box"></i><span class="menu-item" data-i18n="Cities">Cities</span></a>
                        </li>
                        <!-- <li class="{{ request()->is('locations') ? 'active' : '' }}"><a href="/locations"><i class="feather icon-box"></i><span class="menu-item" data-i18n="Locations">Locations</span></a>
                        </li> -->
                        <li class="{{ request()->is('projects') ? 'active' : '' }}"><a href="/projects"><i class="feather icon-box"></i><span class="menu-item" data-i18n="Projects">Projects</span></a>
                        </li>
                        <li class="{{ request()->is('departments') ? 'active' : '' }}"><a href="/departments"><i class="feather icon-box"></i><span class="menu-item" data-i18n="Departments">Departments</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Our Users">Our Users</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('titles') ? 'active' : '' }}"><a href="/titles"><i class="feather icon-user"></i><span class="menu-item" data-i18n="Titles">Titles</span></a>
                        </li>
                        <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users"><i class="feather icon-user"></i><span class="menu-item" data-i18n="Users">Users</span></a>
                        </li>
                        <li class="{{ request()->is('roles') ? 'active' : '' }}"><a href="/roles"><i class="feather icon-user"></i><span class="menu-item" data-i18n="Roles">Roles</span></a>
                        </li>
                        <li class="{{ request()->is('access') ? 'active' : '' }}"><a href="/access"><i class="feather icon-user"></i><span class="menu-item" data-i18n="Access">Access</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Our Accounts">Our Accounts</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('accounts') ? 'active' : '' }}"><a href="/accounts"><i class="feather icon-file"></i><span class="menu-item" datad-i18n="Accounts">Accounts</span></a>
                        </li>
                        <li class="{{ request()->is('accmaps') ? 'active' : '' }}"><a href="/accmaps"><i class="feather icon-file"></i><span class="menu-item" data-i18n="Account Maps">Account Maps</span></a>
                        </li>
                        <li class="{{ request()->is('statistics') ? 'active' : '' }}"><a href="/statistics"><i class="feather icon-file"></i><span class="menu-item" data-i18n="Statistics">Statistics</span></a>
                        </li>
                        <li class="{{ request()->is('remarks') ? 'active' : '' }}"><a href="/remarks"><i class="feather icon-file"></i><span class="menu-item" data-i18n="Remarks">Remarks</span></a>
                        </li>
                        <li class="{{ request()->is('maps') ? 'active' : '' }}"><a href="/maps"><i class="feather icon-file"></i><span class="menu-item" data-i18n="Maps">Maps</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>