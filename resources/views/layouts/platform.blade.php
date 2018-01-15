<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('pageTitle') - {{env('APP_NAME')}}</title>
    
    <link href='//fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="{{route('index')}}">i<span>Cheapbooks</span></a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @php($route = \Request::route()->getName())
                        <li {{ $route == 'index' ? 'class=active' : '' }}>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li {{$route == 'faq' ? 'class=active' : ''}}>
                            <a href="{{route('faq')}}">FAQ</a>
                        </li>
                        <li {{$route == 'contact' ? 'class=active' : ''}}>
                            <a href="{{route('contact')}}">Contact Us</a>
                        </li>
                        @guest
                            <li {{ ($route == 'login' || $route == 'register')  ? 'class=active' : '' }}>
                                <a href="{{route('login')}}">Sign Up/Login</a>
                            </li>
                        @else
                            @if(Auth::user()->account == 'admin')
                                <li><a href="{{route('admin.index')}}">Admin Panel</a></li>
                            @endif
                            <li {{$route == 'account' ? 'class=active' : ''}}>
                                <a href="{{route('account')}}">My account</a></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        @endguest
                    </ul>
                </div>  
            </div>
        </div>
    </div>
    
    @yield('content')
    
    <div class="footer-top-area" style="background: inherit">
        <div class="zigzag-bottom"></div>
    </div>
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; {{date('Y').' '.env('APP_NAME')}}. All Rights Reserved. Design by <a href="http://victron-tech.com" target="_blank">Victron Tech.</a> |
                            <a href="{{route('privacy')}}" target="_blank">Privacy Policy</a> |
                            <a href="{{route('conditions')}}" target="_blank">Terms and Conditions of Use</a>
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('partials.htmltemplates')
    @include('partials.jsconfig')
    
    <script type="text/javascript">
        window.onload = () => {
            setTimeout(() => {
                requirejs(['jquery','bootstrap','owl.carousel.min','jquery.sticky','jquery.easing.1.3.min'])
            }, 100)
        }
    </script>
    @yield('js')
  </body>
</html>