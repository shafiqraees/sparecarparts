    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                @if(auth()->user()->user_type === 'Supplier')
                    <li class=" nav-item"><a href="{{route('supplier.home')}}"><i class="la la-home"></i><span
                                class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                    </li>
                    <li class=" nav-item"><a href="{{route('supplier.order')}}"><i class="la la-home"></i><span
                                class="menu-title" data-i18n="nav.dash.main">Order Products</span></a>
                    </li>
                @endif
                    @if(auth()->user()->user_type === 'Admin')
                        <li class=" nav-item"><a href="{{route('admin.home')}}"><i class="la la-home"></i><span
                                    class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="la la-columns"></i><span class="menu-title"
                                                                                             data-i18n="nav.page_layouts.main">Make</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="{{route('make.create')}}"
                                       data-i18n="nav.page_layouts.1_column">Add Make</a>
                                </li>
                                <li><a class="menu-item" href="{{route('make.index')}}"
                                       data-i18n="nav.page_layouts.2_columns">All Make</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="la la-navicon"></i><span class="menu-title"
                                                                                             data-i18n="nav.navbars.main">Model</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="{{route('model.create')}}" data-i18n="nav.navbars.nav_light">Add
                                        Model</a>
                                </li>
                                <li><a class="menu-item" href="{{route('model.index')}}" data-i18n="nav.navbars.nav_dark">All
                                        Model</a>
                                </li>
                            </ul>
                        </li>

                        <li class=" nav-item"><a href="#"><i class="la la-puzzle-piece"></i><span class="menu-title"
                                                                                                  data-i18n="nav.starter_kit.main">Cars</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="{{route('car.create')}}" data-i18n="nav.navbars.nav_light">Add
                                        Car</a>
                                </li>
                                <li><a class="menu-item" href="{{route('car.index')}}" data-i18n="nav.navbars.nav_dark">All
                                        Car</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="la la-android"></i><span class="menu-title"
                                                                                             data-i18n="nav.menu_levels.main">Spare Parts</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="{{route('sparepart.create')}}"
                                       data-i18n="nav.navbars.nav_light">Add Spare parts</a>
                                </li>
                                <li><a class="menu-item" href="{{route('sparepart.index')}}"
                                       data-i18n="nav.navbars.nav_dark">All Spare parts</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="{{route('admin.supplier')}}"><i class="la la-users"></i><span
                                    class="menu-title" data-i18n="nav.dash.main">Supplier</span></a>
                        </li>
                        <li class=" nav-item"><a href="{{route('admin.sales')}}"><i class="la la-shopping-cart"></i><span
                                    class="menu-title" data-i18n="nav.dash.main">Sales</span></a>
                        </li>
                        <li class=" nav-item"><a href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i><span class="menu-title"
                                                              data-i18n="nav.morris_charts.main">Signout</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endif
            </ul>
        </div>
    </div>



