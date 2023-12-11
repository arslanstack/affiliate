<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- set favicon -->
    <link rel="shortcut-icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Affilliate | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link href="{{url('/adminpanel/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{url('/adminpanel/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <!-- Sweet ALert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Gritter -->
    <link href="{{url('/adminpanel/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{url('/adminpanel/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('/adminpanel/css/style.css')}}" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }

        .dataTables_filter input {
            margin-bottom: 10px;
        }

        .tree,
        .tree ul,
        .tree li {
            list-style: none;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .tree {
            margin: 0 0 1em;
            text-align: center;
        }
        .tree h6{
            font-size: 0.8rem;
            font-weight: 600;;
        }
        .tree,
        .tree ul {
            display: table;
        }

        .tree {
            margin: 0 auto;
            /* Center the tree horizontally */
            text-align: center;
        }

        .tree ul {
            width: 100%;
        }

        .tree li {
            display: table-cell;
            padding: .5em 0;
            vertical-align: top;
        }

        /* _________ */
        .tree li:before {
            outline: solid 1px #666;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .tree li:first-child:before {
            left: 50%;
        }

        .tree li:last-child:before {
            right: 50%;
        }

        .tree code,
        .tree span {
            /* border: solid .1em #666; */
            /* border-radius: .2em; */
            display: inline-block;
            margin: 0 .2em .5em;
            padding: .2em .5em;
            position: relative;
        }

        /* If the tree represents DOM structure */
        .tree code {
            font-family: monaco, Consolas, 'Lucida Console', monospace;
        }

        /* | */
        .tree ul:before,
        .tree code:before,
        .tree span:before {
            outline: solid 1px #666;
            content: "";
            height: .5em;
            left: 50%;
            position: absolute;
        }

        .tree ul:before {
            top: -.5em;
        }

        .tree code:before,
        .tree span:before {
            top: -.55em;
        }

        /* The root node doesn't connect upwards */
        .tree>li {
            margin-top: 0;
        }

        .tree>li:before,
        .tree>li:after,
        .tree>li>code:before,
        .tree>li>span:before {
            outline: none;
        }   
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" style="width: 48px; height: 48px;" src="{{ asset('uploads/profile/' . (Auth::guard('admin')->user()->image ? Auth::guard('admin')->user()->image : 'avatar.jpg')) }}" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{ Auth::guard('admin')->user()->name }}</span>
                                <span class="text-muted text-xs block">Administrator<b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile">Profile</a></li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form action="{{ route('admin.logout') }}" id="logout-form" class="d-none" method="POST">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            A
                        </div>
                    </li>
                    <li {{ request()->route()->getName() === 'admin.dashboard' ? "class=active" : '' }}>
                        <a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li {{ Str::contains(request()->path(), 'user') ? "class=active" : '' }}>
                        <a href="{{route('admin.users')}}"><i class="fa fa-table"></i> <span class="nav-label">Users</span></a>
                    </li>
                    <li {{ request()->route()->getName() === 'admin.products' ? "class=active" : '' }}>
                        <a href="{{route('admin.products')}}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Products</span></a>
                    </li>
                    <li {{ request()->route()->getName() === 'admin.commission-levels' ? "class=active" : '' }}>
                        <a href="{{route('admin.commission-levels')}}"><i class="fa fa-calculator"></i> <span class="nav-label">Commssion Levels</span></a>
                    </li>
                    <li {{ request()->route()->getName() === 'admin.orders' ? "class=active" : '' }}>
                        <a href="{{route('admin.orders')}}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <div class="mr-4" style="cursor: pointer; margin-right: 20px; text-decoration:underline;" onclick="document.getElementById('logout-form').submit();">
                                Logout from<strong> Admin?</strong>
                            </div>
                        </li>



                        <!-- <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li> -->
                    </ul>

                </nav>
            </div>

            <div class="wrapper wrapper-content">
                @yield('content')
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> Affiliate &copy; 2023
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>


    <script src="{{url('/adminpanel/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Mainly scripts -->
    <script src="{{url('/adminpanel/js/popper.min.js')}}"></script>
    <script src="{{url('/adminpanel/js/bootstrap.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{url('/adminpanel/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{url('/adminpanel/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{url('/adminpanel/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{url('/adminpanel/js/inspinia.js')}}"></script>
    <script src="{{url('/adminpanel/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{url('/adminpanel/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- GITTER -->
    <script src="{{url('/adminpanel/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{url('/adminpanel/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{url('/adminpanel/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{url('/adminpanel/js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{url('/adminpanel/js/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        // document ready jquery
        $(document).ready(function() {
            $(':input[readonly]').css({
                'background-color': '#ffffff'
            });
            $(':select[disabled]').css({
                'background-color': '#ffffff'
            });
        });
    </script>

</body>

</html>