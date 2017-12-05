<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('pageTitle') - {{env('APP_NAME')}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{asset('/css/material-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('/css/sweetalert2.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/dataTables.bs.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/demo.css')}}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

    <div class="wrapper">

        <div class="sidebar" data-color="blue" data-image="{{asset('/img/sidebar-1.jpg')}}">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->

            <div class="logo">
                <a href="{{route('index')}}" class="simple-text">
                    {{env('APP_NAME')}} site
                </a>
            </div>

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li {{(\Request::route()->getName() == 'admin.index') ? 'class=active' : '' }}>
                        <a href="{{route('admin.index')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li {{(\Request::route()->getName() == 'admin.books') ? 'class=active' : '' }}>
                        <a href="{{route('admin.books')}}">
                            <i class="material-icons">book</i>
                            <p>Books</p>
                        </a>
                    </li>
                    <li {{(\Request::route()->getName() == 'admin.orders') ? 'class=active' : '' }}>
                        <a href="{{route('admin.orders')}}">
                            <i class="material-icons">local_shipping</i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li {{(\Request::route()->getName() == 'admin.users') ? 'class=active' : '' }}>
                        <a href="{{route('admin.users')}}">
                            <i class="material-icons">person</i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{route('admin.index')}}">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{route('admin.index')}}" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Edit my Profile</a></li>
                                    <li><a href="{{route('index')}}">Return to Site</a></li>
                                    <li><a href="{{route('logout')}}">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy; {{date('Y').' '.env('APP_NAME')}}. All Rights Reserved. Designed by <a href="http://design-by-verdi.com">Verdi Co.</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>

</body>
    @include('partials.htmltemplates')
    @include('partials.jsconfig')
    <!--   Core JS Files   -->
    <script src="{{asset('/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/material.min.js')}}" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Material Dashboard javascript methods -->
    <script src="{{asset('/js/material-dashboard.js')}}"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{asset('/js/demo.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    @yield ('js')

</html>
