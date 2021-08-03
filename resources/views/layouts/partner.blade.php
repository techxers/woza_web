<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    @yield('title')

    <!-- Fontfaces CSS-->
    <link href="{{asset('partner/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('partner/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('partner/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('partner/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link rel="icon" type="image/x-icon" href="{{asset('images/icon/woza.jpg')}}">
    <link href="{{asset('woza/assets/css/google.css')}}" rel="stylesheet">
    <!-- Main CSS-->
    <link href="{{asset('partner/css/theme.css')}}" rel="stylesheet" media="all">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIlDX7c8972C1NTV4QMxHgUZrBPCN5Tdo&libraries=places"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/dashboard">
                            <img src="images/icon/logo.png" alt="" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled"> 
                        <li class="active has-sub">
                            <a href="{{route('partner.dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-warehouse"></i>My Shop</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('categories.index')}}"><i class="fas fa-check-square"></i>Categories</a>
                                </li>
                                <li>
                                    <a href="{{route('products.index')}}"><i class="fas fa-copy"></i>Products</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('orders.index')}}">
                                <i class="fas fa-table"></i>Orders</a>
                        </li>
                        <li>
                            <a href="{{route('bookings.index')}}">
                                <i class="fas fa-calendar-alt"></i>Bookings</a>
                        </li>
                        <li>
                            <a href="{{route('notifications.index')}}">
                                <i class="far fa-bell"></i>Notifications</a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.profile')}}">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{route('partner.dashboard')}}">
                    <img src="{{asset('images/icon/woza.jpg')}}" alt="" width="50" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                       
                        <li class="{{Request::is('dashboard*') ? 'active':''}} has-sub">
                            <a href="{{route('partner.dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="has-sub {{Request::is('categories*') ? 'active':(Request::is('products*') ? 'active':'')}}">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-warehouse"></i>My Shop</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{route('categories.index')}}"><i class="fas fa-check-square"></i>Categories</a>
                                </li>
                                <li>
                                    <a href="{{route('products.index')}}"><i class="fas fa-copy"></i>Products</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{Request::is('orders*') ? 'active':''}}">
                            <a href="{{route('orders.index')}}">
                                <i class="fas fa-table"></i>Orders</a>
                        </li>
                        <li class="{{Request::is('bookings*') ? 'active':''}}">
                            <a href="{{route('bookings.index')}}">
                                <i class="fas fa-calendar-alt"></i>Bookings</a>
                        </li>
                        <li class="{{Request::is('notifications*') ? 'active':''}}">
                            <a href="{{route('notifications.index')}}">
                                <i class="far fa-bell"></i>Notifications</a>
                        </li>
                        <li class="{{Request::is('profile*') ? 'active':''}}">
                            <a href="{{route('dashboard.profile')}}">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                               
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">{{Auth::user()->receivednotifications->where('status','!=',1)->count()}}</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have {{Auth::user()->receivednotifications->where('status','!=',1)->count()}} New Notifications</p>
                                            </div>
                                            
                                            @forelse (Auth::user()->receivednotifications->where('status','!=',1) as $item)
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>{{$item->message}}</p>
                                                        <?php $date=strtotime($item->created_date);
                                                        $new= \Carbon\Carbon::parse($date);?>
                                                        <span class="date">{{$new->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                            @empty
                                            <div class="notifi__title">
                                            </div>
                                            @endforelse
                                            <div class="notifi__footer">
                                                <a href="{{route('notifications.index')}}">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->profile_image==null||Auth::user()->profile_image=='-')
                                                <i class="fas fa-user fa-3x rounded-circle"></i>
                                            @else
                                                <img src="{{asset('images/profile/'.Auth::user()->profile_image)}}" alt="John Doe" />
                                            @endif
                                           
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->fname.' '.Auth::user()->lname}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->profile_image==null||Auth::user()->profile_image=='-')
                                                        <i class="fas fa-user fa-3x rounded-circle"></i>
                                                    @else
                                                         <img src="{{asset('images/profile/'.Auth::user()->profile_image)}}" alt="John Doe" />
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->fname.' '.Auth::user()->lname}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form id="form2" action="{{route('logout')}}" method="post" class="ml-3">
                                                    @csrf
                                                    <button form="form2" type="submit" class="bg-transparent border-0 " > <span><i class="zmdi zmdi-power"></i> Logout</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('content')
             <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © {{now()->year}} Woza. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('partner/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('partner/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('partner/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('partner/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('partner/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('partner/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('partner/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('partner/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('partner/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('partner/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('partner/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('partner/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('partner/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('partner/js/main.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#payment-button").prop('disabled', true);
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var options = {
      types: ['establishment'],
      componentRestrictions: {country: "ke"}
     };
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        $('#latitude').val(place.geometry['location'].lat());
        $('#longitude').val(place.geometry['location'].lng());
        
        $("#payment-button").prop('disabled', false);
        });
        }
        </script>
</body>

</html>
<!-- end document-->
