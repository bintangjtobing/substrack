<div class="mobile-author-actions"></div>
<header class="header-top">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            <a href="/" class="sidebar-toggle">
                <img class="svg" src="{{ asset('img/svg/bars.svg') }}" alt="Logo Substrack"></a>
            <a class="navbar-brand" href="/"><img class="dark" style="max-height: 100px;"
                    src="{!! asset('img/4.png') !!}" alt="png"><img class="light" style="max-height: 100px;"
                    src="{!! asset('img/4.png') !!}" alt="Logo Substrack"></a>
            <div class="top-menu">

                <div class="strikingDash-top-menu position-relative">
                    <ul>
                        <li class="mb-4">
                            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                                <span data-feather="home" class="nav-icon"></span>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- ends: navbar-left -->

        <div class="navbar-right">
            <ul class="navbar-right__menu">
                <li class="nav-search d-none">
                    <a href="#" class="search-toggle">
                        <i class="la la-search"></i>
                        <i class="la la-times"></i>
                    </a>
                    <form action="/" class="search-form-topMenu">
                        <span class="search-icon" data-feather="search"></span>
                        <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
                    </form>
                </li>
                <!-- ends: .nav-flag-select -->
                <li class="nav-author">
                    <div class="dropdown-custom">
                        <a href="javascript:;" class="nav-item-toggle"><img src="{!! asset('img/2.png') !!}" alt=""
                                class="rounded-circle"></a>
                        <div class="dropdown-wrapper">
                            <div class="nav-author__info">
                                <div class="author-img">
                                    <img src="{!! asset('img/2.png') !!}" alt="" class="rounded-circle">
                                </div>
                                <div>
                                    <h6>Bintang Tobing</h6>
                                    <span>Private / Personal Use</span>
                                </div>
                            </div>
                            <div class="nav-author__options">
                                <ul>
                                    <li>
                                        <a href="">
                                            <span data-feather="user"></span> Profile</a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span data-feather="settings"></span> Settings</a>
                                    </li>
                                </ul>
                                <a href="" class="nav-author__signout">
                                    <span data-feather="log-out"></span> Sign Out</a>
                            </div>
                        </div>
                        <!-- ends: .dropdown-wrapper -->
                    </div>
                </li>
                <!-- ends: .nav-author -->
            </ul>
            <!-- ends: .navbar-right__menu -->
            <div class="navbar-right__mobileAction d-md-none">
                <a href="#" class="btn-search">
                    <span data-feather="search"></span>
                    <span data-feather="x"></span></a>
                <a href="#" class="btn-author-action">
                    <span data-feather="more-vertical"></span></a>
            </div>
        </div>
        <!-- ends: .navbar-right -->
    </nav>
</header>
