<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ asset('html/ltr/vertical-menu-template/index.html') }}">
                    <div><img src="{{ asset('dist/images/logo.png')}}" width="200px" height="70px" alt=""></div>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="/dashboardadmin"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>

            <li class=" navigation-header"><span>Pendaftaran</span>
            <li class=" nav-item {{ request()->is(['pendaftar', 'pendaftar/*']) ? 'active' : '' }}">
                <a href="/pendaftar"><i class="feather icon-user"></i><span class="menu-title">Data Diri</span></a>
            </li>
            <li class=" nav-item {{ request()->is(['pembayaran', 'pembayaran/*']) ? 'active' : '' }}">
                <a href="/pembayaran"><i class="fa fa-money"></i><span class="menu-title">Pembayaran</span></a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
