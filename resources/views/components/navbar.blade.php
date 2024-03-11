<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
            <a href="/" class="scrollto"
                style="color:white;padding: 5px;
                display: inline-block;
                font-family: sans-serif;
                font-weight: 600;
                font-size: 25px;">
                KAMBITI SYSTEMS</a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="fa fa-home" style="{{ Request::is('/') ? 'color: #fff;' : '' }}">
                    <a href="/" style="{{ Request::is('/') ? 'color: #fff;text-decoration: none;' : '' }}">Home</a>
                </li>
                <li class="fa fa-info" style="{{ Request::is('about-us') ? 'color: #fff;' : '' }}">
                    <a href="/about-us" style="{{ Request::is('about-us') ? 'color: #fff;text-decoration: none;' : '' }}">About Us</a></li>
                <li class="fa fa-address-book" style="{{ Request::is('contact-us') ? 'color: #fff;' : '' }}"><a href="/contact-us" style="{{ Request::is('contact-us') ? 'color: #fff;text-decoration: none;' : '' }}">Contact Us</a></li>
                <li class="fa fa-file" style="{{ Request::is('career') ? 'color: #fff;' : '' }}"><a href="/career" style="{{ Request::is('career') ? 'color: #fff;text-decoration: none;' : '' }}">Career</a></li>
                @auth
                    <li class="fa fa-book" style="{{ (Request::is('reports') || Request::is('reports/*')) ? 'color: #fff;' : '' }}">
                        <a href="/reports" style="{{ (Request::is('reports') || Request::is('reports/*')) ? 'color: #fff;text-decoration: none;' : '' }}">Reports</a>
                    </li>
                
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown" href="#" style="a:focus color:#797979">
                            @if (getNotificationsCount() > 0)
                                <i class="fa fa-envelope"></i>
                            @else
                                <i class="fa fa-envelope-open-o"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu extended logout"
                            style="border-radius: 10%; border-bottom-right-radius: 10%;border-bottom-left-radius: 10%;">
                            <div class="log-arrow-up">
                            </div>
                            <li>
                                <a href="/notifications" style="{{ (Request::is('reports') || Request::is('reports/*')) ? 'color: #fff;text-decoration: none;' : '' }}"><i class="fa fa-lock"></i>
                                    See all notifications</a>
                            </li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown" href="#" style="a:focus color:#797979">
                            <span class="profile-ava">
                                <img alt="Image not found" height="30px" width="30px" {{-- src="image.url" --}}
                                    src="{{ getUserDP(asset(auth()->user()->id)) }}">
                            </span>
                            <span class="username" style="{{ Request::is('profile') ? 'color: #fff;text-decoration: none;' : '' }}">{{ auth()->user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu extended logout"
                            style="border-radius: 10%; border-bottom-right-radius: 10%;border-bottom-left-radius: 10%;">
                            <div class="log-arrow-up">
                            </div>
                            <li class="eborder-top {{ Request::is('profile') ? 'active' : '' }}">
                                <a href="/profile"><i class="icon_profile"></i> Profile</a>
                            </li>
                            <li>
                                <a href="logout" style="background-color: #040919 !important"><i class="fa fa-lock"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown" href="#" style="a:focus color:#797979">
                            <span class="profile-ava fa fa-user">
                                {{-- <img alt="Image not found" src="image.url" height="30px" width="30px"> --}}
                            </span>
                            <span class="username">Join Us</span>
                        </a>
                        <ul class="dropdown-menu extended logout"
                            style="border-radius: 10%; border-bottom-right-radius: 10%;border-bottom-left-radius: 10%;">
                            <div class="log-arrow-up">
                            </div>
                            <li class="eborder-top">
                                {{-- <a href="vprofile"><i class="icon_profile"></i> Profile</a> --}}
                                <a href="login"><i class="fa fa-sign-in">Login</i></a>
                            </li>
                            <li>
                                <a href="register"><i class="fa fa-user-plus"></i>Register</a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->
