<!-- container section start -->
<section id="container" class="">
    {{-- <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
                <i class="icon_menu"></i>
            </div>
        </div>

        <!--logo start-->
        <a href="/EC_Admin/adminhome" class="logo">
            <span class="lite" style="color: orangered">Dig<span style="color: white">ital Vot</span><span
                    style="color: green">ing</span></span>
        </a>
        <!--logo end-->
        <div class="top-nav notification-row">
            <!-- notificatoin dropdown start-->
            <ul class="nav pull-right top-menu">
                <li id="alert_notificatoin_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <i class="icon-bell-l"></i>
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <div class="notify-arrow notify-arrow-blue"></div>
                        <li>
                            <a href="#">See all notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- alert notification end-->
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="profile-ava">
                            <img alt="Image not found" height="33" width="33" src="image.url">
                        </span>
                        <span class="username">username</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up">
                        </div>
                        <li class="eborder-top">
                            <a href="/EC_Admin/adminprofile"><i class="icon_profile"></i> My Profile</a>
                        </li>
                        <li>
                            <a href="/EC_Admin/achangepassword"><i class="icon_key_alt"></i>Change password</a>
                        </li>
                        <li>
                            <a href="/logout" style="background-color: #EBEBEB; color: black"><i
                                    class="arrow_right_alt"></i> Log
                                Out</a>
                        </li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header> --}}
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="active">
                    <a class="" href="/">
                        <i class="fa fa-book"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="active">
                    <a class="" href="/EC_Admin/adminprofile">
                        <i class="fa fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="fa fa-printer"></i>
                        <span>Voter</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/addvoter">Add Voter</a></li>
                        <li><a class="" href="/EC_Admin/editvoter">Edit/Delete Voter</a></li>
                        <li><a class="" href="/EC_Admin/viewvoter">View Voter</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="fa fa-document"></i>
                        <span>Candidate</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/addcandidate">Add Candidate</a></li>
                        <li><a class="" href="/EC_Admin/editcandidate">Edit/Delete Candidate</a></li>
                        <li><a class="" href="/EC_Admin/viewcandidate">View Candidate</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>Election</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/generateelection">Generate Election</a></li>
                        <li><a class="" href="/EC_Admin/modifyelection">Modify Election</a></li>
                        <li><a class="" href="/EC_Admin/completeelection">Complete Election</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>Voting</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/voting">Polling Booth</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>Result & Report</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/generateresult">Generate Result</a></li>
                        <li><a class="" href="/EC_Admin/viewresult">View Result</a></li>
                        <li><a class="" href="/EC_Admin/generatereport">Generate Report</a></li>
                        <li><a class="" href="/EC_Admin/viewreport">View Report</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>Complain</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="/EC_Admin/viewcomplain">View Complain</a></li>
                        <li><a class="" href="/EC_Admin/replycomplain">Reply Complain</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a class="" href="logout">
                        <i class="fa fa-lock"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    {{-- {% block content %} --}}

    {{-- {% endblock content %} --}}

</section>
<!--main content end-->
