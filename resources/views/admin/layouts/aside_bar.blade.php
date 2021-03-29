<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('admin.home')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>

            </li>

            <li class=" nav-item"><a href="#"><i class="la la-columns"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Make</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('make.create')}}" data-i18n="nav.page_layouts.1_column">Add Make</a>
                    </li>
                    <li><a class="menu-item" href="{{route('make.index')}}" data-i18n="nav.page_layouts.2_columns">All Make</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-navicon"></i><span class="menu-title" data-i18n="nav.navbars.main">Model</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('model.create')}}" data-i18n="nav.navbars.nav_light">Add Model</a>
                    </li>
                    <li><a class="menu-item" href="{{route('model.index')}}" data-i18n="nav.navbars.nav_dark">All Model</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-puzzle-piece"></i><span class="menu-title" data-i18n="nav.starter_kit.main">Cars</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('car.create')}}" data-i18n="nav.navbars.nav_light">Add Car</a>
                    </li>
                    <li><a class="menu-item" href="{{route('car.index')}}" data-i18n="nav.navbars.nav_dark">All Car</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-android"></i><span class="menu-title" data-i18n="nav.menu_levels.main">Spare Parts</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level">Second level</a>
                    </li>
                    <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.main">Second level child</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level">Third level</a>
                            </li>
                            <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level_child.main">Third level child</a>
                                <ul class="menu-content">
                                    <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level_child.fourth_level1">Fourth level</a>
                                    </li>
                                    <li><a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level_child.fourth_level2">Fourth level</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="ft-power"></i><span class="menu-title" data-i18n="nav.morris_charts.main">Signout</span></a> <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form></li>
        </ul>
    </div>
</div>



