<!-- Main header -->
<div class="main-header row">
    <div class="col-sm-6 col-xs-7">

        <!-- User info -->
        <ul class="user-info pull-left">
            <li class="profile-info dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                    <img width="44" class="img-circle avatar" alt="" src="{{auth('web')->user()->photo}}">{{auth('web')->user()->name}}<span class="caret"></span>
                </a>

                <!-- User action menu -->
                <ul class="dropdown-menu">

{{--                    <li><a href="{{route('admin.profile')}}"><i class="icon-user"></i>My profile</a></li>--}}
                    <li class="divider"></li>
{{--                    <li><a href="#"><i class="icon-cog"></i>Account settings</a></li>--}}
                    <li><a href="{{route('admin.logout')}}"><i class="icon-logout"></i>Logout</a></li>
                </ul>
                <!-- /user action menu -->

            </li>
        </ul>
        <!-- /user info -->

    </div>

    <div class="col-sm-6 col-xs-5">

    </div>
</div>
<!-- /main header -->
