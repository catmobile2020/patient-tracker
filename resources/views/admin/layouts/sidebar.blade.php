<!-- Page Sidebar -->
<div class="page-sidebar">

    <!-- Site header  -->
    <header class="site-header">
        <div class="site-logo">
            <a href="{{route('admin.home')}}">
{{--                <img src="{{asset('assets/admin/images/logo.png')}}" title="imaging atelier" width="150">--}}
            </a>
        </div>
        <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
        <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
    </header>
    <!-- /site header -->

    <!-- Main navigation -->
    <ul id="side-nav" class="main-menu navbar-collapse collapse">

        <li class="{{Route::is('admin.home') ? 'active' : ''}}">
            <a href="{{route('admin.home')}}">
                <i class="icon-gauge"></i><span class="title">Dashboard</span>
            </a>
        </li>
        <li class="{{Route::is('admin.users.*') ? 'active' : ''}}">
            <a href="{{route('admin.users.index')}}">
                <i class="fa fa-tasks"></i><span class="title">Speakers</span>
            </a>
        </li>

    </ul>
    <!-- /main navigation -->
</div>
<!-- /page sidebar -->
