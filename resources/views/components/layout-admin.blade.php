<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Admin - {{ $title }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ asset('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css">
    <link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
    <link href="{{ asset('css/widgets.css" rel="stylesheet') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
    <script defer src="{{ asset('js/alpine.min.js') }}"></script>
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('js/kambiti_utils.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/kstyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kambiti/styles.css') }}">
</head>

<body>
    <!-- container section start -->
    <section id="container" class="">
        <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
                    <i class="icon_menu"></i>
                </div>
            </div>

            <!--logo start-->
            <a href="/" class="logo">
                <span class="lite" style="color: orangered">{{ env('APP_NAME') }}</span>
            </a>
            <!--logo end-->
            <div class="top-nav notification-row">
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    <li id="alert_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" id="notification-icon" href="#">
                            @if ((int) $notifications > 0)
                                <i class="fa fa-envelope"></i>
                                <span class="notification-count" id="notification-count">{{ getNotificationsCount() }}</span>
                            @else
                                <i class="fa fa-envelope-open-o"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <a href="/notifications">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- alert notification end-->
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                @if (auth()->user()->dp != null)
                                    <img alt="Image not found" height="33" width="33"
                                        src="{{ asset('storage/' . auth()->user()->dp) }}">
                                @else
                                    <img alt="Image not found" height="33" width="33"
                                        src="{{ asset('img/profile.jpg') }}">
                                @endif
                            </span>
                            <span class="username">{{ auth()->user()->username }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up">
                            </div>
                            <li class="eborder-top {{ Request::is('profile') ? 'active' : '' }}">
                                <a href="/profile"><i class="icon_profile"></i> My Profile</a>
                            </li>
                            <li class="eborder-top {{ Request::is('settings') ? 'active' : '' }}">
                                <a href="/settings"><i class="fa fa-gear"></i> Settings</a>
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
        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a class="" href="/">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:void(0);" class="">
                            <i class="fa fa-bell"></i>
                            <span>Notifications</span>
                            <span class="menu-arrow {{ Request::is('notifications') ? 'arrow_carrot-down' : ' arrow_carrot-down arrow_carrot-right' }}"></span>
                        </a>
                        <ul class="sub" style="overflow: hidden; display: {{ Request::is('notifications') ? 'block' : 'none' }}">
                            {{-- <li><a class="fa fa-envelope" href="messages"> Messages</a></li> --}}
                            <li class="{{ Request::is('notifications') ? 'active' : '' }}"><a class="fa fa-eye" href="/notifications"> View Notifications</a></li>
                            {{-- <li><a class="fa fa-pencil-square" href="notifications/create"> Create Notification</a> --}}
                    </li>
                </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:void(0);" class="">
                        <i class="icon_document"></i>
                        <span>Reports</span>
                        <span class="menu-arrow {{ Request::is('reports/*') ? 'arrow_carrot-down' : ' arrow_carrot-down arrow_carrot-right' }}"></span>
                    </a>
                    <ul class="sub" style="overflow: hidden; display: {{ Request::is('reports/*') ? 'block' : 'none' }}">
                        <li class="{{ Request::is('reports/generate') ? 'active' : '' }}"><a class="fa fa-print" href="/reports/generate"> Generate Report</a></li>
                        <li class="{{ Request::is('reports/history') ? 'active' : '' }}"><a class="fa fa-clock-o" href="/reports/history"> Reports History</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:void(0);" class="">
                        <i class="icon_comment"></i>
                        <span>Complain</span>
                        <span class="menu-arrow {{ (Request::is('complains') || Request::is('complains/*')) ? 'arrow_carrot-down' : ' arrow_carrot-down arrow_carrot-right' }}"></span>
                    </a>
                    <ul class="sub" style="overflow: hidden; display: {{ (Request::is('complains') || Request::is('complains/*')) ? 'block' : 'none' }}">
                        @auth
                            {{-- if admin and in managerial level --}}
                            @if(auth()->user()->account_type_id == 1)
                                <li class="{{ Request::is('complains') ? 'active' : '' }}"><a class="fa fa-comments-o" href="/complains"> View Complain</a></li>
                            @endif
                        @endauth
                        {{-- <li class="{{ Request::is('complains') ? 'active' : '' }}"><a class="fa fa-eye" href="/complains"> View Complain</a></li> --}}
                        <li class="{{ Request::is('complains/me') ? 'active' : '' }}"><a class="fa fa-comments-o" href="/complains/me"> My Complains</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:void(0);" class="">
                        <i class="fa fa-users"></i>
                        <span>Employees</span>
                        <span class="menu-arrow {{ Request::is('employees/*') ? 'arrow_carrot-down' : ' arrow_carrot-down arrow_carrot-right' }}"></span>
                    </a>
                    @if (getEmployeeType() == 1 || getEmployeeType() == 2)
                        <ul class="sub" style="overflow: hidden; display: {{ Request::is('employees/*') ? 'block' : 'none' }}">
                            <li class="{{ Request::is('employees/create') ? 'active' : '' }}"><a class="fa fa-user-plus" href="/employees/create"> Create Employee</a></li>
                            <li class="{{ Request::is('employees/manage') ? 'active' : '' }}"><a class="fa fa-users" href="/employees/manage"> Manage Employees</a></li>
                            <li class="{{ Request::is('employees/payment') ? 'active' : '' }}"><a class="fa fa-dollar" href="/employees/payment"> Pay Employee(s)</a></li>
                        </ul>
                    @endif
                </li>

                <li class="{{ Request::is('profile') ? 'active' : '' }}">
                    <a class="" href="/profile">
                        <i class="icon_profile"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a class="" href="/logout">
                        <i class="arrow_right_alt"></i>
                        <span>Logout</span>
                    </a>
                </li>

                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        {{-- sidebar end --}}

        <div {{-- style="margin-top: 5%;margin-bottom: 1%" --}}>
            {{ $slot }}
        </div>

    </section>
    <!--main content end-->

    <!-- container section start -->

    <!-- javascripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.10.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- nice scroll -->
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="{{ asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <!-- jQuery full calendar -->
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="{{ asset('assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
    <!--script for this page only-->
    <script src="{{ asset('js/calendar-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.rateit.min.js') }}"></script>
    <!-- custom select -->
    <script src="{{ asset('js/jquery.customSelect.min.js') }}"></script>
    <script src="{{ asset('assets/chart-master/Chart.js') }}"></script>

    <!--custome script for all page-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- custom script for this page-->
    <script src="{{ asset('js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('js/easy-pie-chart.js') }}"></script>
    <script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('js/xcharts.min.js') }}"></script>
    <script src="{{ asset('js/jquery.autosize.min.js') }}"></script>
    <script src="{{ asset('js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ asset('js/gdp-data.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/sparklines.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script>
        //knob
        $(function() {
            $(".knob").knob({
                'draw': function() {
                    $(this.i).val(this.cv + '%')
                }
            })
        });

        //carousel
        $(document).ready(function() {
            $("#owl-slider").owlCarousel({
                navigation: true,
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true

            });
        });

        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });

        /* ---------- Map ---------- */
        $(function() {
            $('#map').vectorMap({
                map: 'world_mill_en',
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#000', '#000'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                backgroundColor: '#eef3f7',
                onLabelShow: function(e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>

    @yield('javascript')
</body>

</html>
