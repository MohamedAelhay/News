<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src={{asset("img/profile_small.jpg")}} />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">{{Auth::user()->getRoleNames()[0]}} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href={{route('home')}}>Home</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li @if(isActive("roles*") || isActive("cities*") || isActive("works*")) class="active" @endif >
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li @if(isActive("roles*")) class="active" @endif><a  href={{route('roles.index')}}>Roles</a></li>
                    <li @if(isActive("cities*")) class="active" @endif><a href={{route('cities.index')}}>Cities</a></li>
                    <li @if(isActive("works*")) class="active" @endif><a  href={{route('works.index')}}> Jobs</a></li>
                </ul>
            </li>
            <li @if(isActive("staff*") || isActive("visitors*")) class="active" @endif >
                <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(isActive("staff*")) class="active" @endif><a href={{route('staff.index')}}>Staff</a></li>
                    <li @if(isActive("visitors*")) class="active" @endif><a href={{route('visitors.index')}}>Visitor</a></li>
                </ul>
            </li>
            <li @if(isActive("articles*")) class="active" @endif>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Topics</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(isActive("articles*")) class="active" @endif><a href={{route('articles.index')}}>Articles</a></li>
                </ul>
            </li>
            <li @if(isActive("events*")) class="active" @endif>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Event</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(isActive("events*")) class="active" @endif><a href={{route('events.index')}}>Events</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
