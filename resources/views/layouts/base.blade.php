<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo_6/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:15:10 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	@yield('title')

	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Porto - Bootstrap eCommerce Template">
	<meta name="author" content="SW-THEMES">
		
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{asset('images/icon/woza3.jpg')}}">
	
	
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700','Poppins:300,400,500,600,700,800', 'Playfair+Display:900' ] }
		};
		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>

	<!-- Plugins CSS File -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIlDX7c8972C1NTV4QMxHgUZrBPCN5Tdo&libraries=places"></script>
	<link rel="stylesheet" href="{{asset('woza/assets/css/bootstrap.min.css')}}">

	<!-- Main CSS File -->
	<link rel="stylesheet" href="{{asset('woza/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('icons/css/font-awesome.min.css')}}">
	<link href="{{asset('woza/assets/css/google.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('woza/assets/vendor/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('woza/assets/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
	
</head>

<body>
	<div class="page-wrapper">
		<header class="header">
			<div class="header-top  text-uppercase" style="background-color:rgb(227,95,33)">
				<div class="container">
					<div class="header-right header-dropdowns ml-0 ml-sm-auto">
						<p class="top-message mb-0 mr-lg-5 pr-3 d-none d-sm-block h6 text-white" >Welcome To Woza!</p>
						<div class="header-dropdown dropdown-expanded mr-3">
							<a href="#">Links</a>
							<div class="header-menu">
								<ul>
									<li class="h6 text-white mt-2"><a href="{{route('about')}}">About</a></li>
									<li class="h6 text-white mt-2"><a href="{{route('contact')}}">Contact</a></li>
									<li class="h6 text-white mt-2"><a href="{{route('partner.signup')}}">Join Woza Partner</a></li>
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->
						<span class="separator"></span>
						<div class="social-icons">
							<a href="#" class="social-icon social-instagram icon-instagram text-white" target="_blank"></a>
							<a href="#" class="social-icon social-twitter icon-twitter text-white" target="_blank"></a>
							<a href="#" class="social-icon social-facebook icon-facebook text-white" target="_blank"></a>
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-top -->

			<div class="header-middle text-dark">
				<div class="container">
					<div class="header-left col-lg-2 w-auto pl-0">
						<button class="mobile-menu-toggler mr-2" type="button">
							<i class="icon-menu"></i>
						</button>
						<a href="/" class="logo">
							 <span><img class="rounded-circle" src="{{asset('images/icon/woza3.jpg')}}" alt="Porto Logo" width="75"></span>
						</a>
					</div><!-- End .header-left -->

					<div class="header-right w-lg-max pl-2">
						<div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
							<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
							<form action="{{route('search')}}" method="get">
								<div class="header-search-wrapper">
									<input type="search" style="border: 1px solid rgb(227,95,33);background-color:white;" class="form-control" name="q" id="q" placeholder="Search..." required>
									<div class="select-custom" style="background-color:rgb(227,95,33);color:white">
										<select id="cat" name="type" style="background-color:white;color:rgb(227,95,33);border: 1px solid rgb(227,95,33)">
											<option value="1">Products</option>
											<option value="2">Services</option>
											<option value="3">Shop</option>
										</select>
									</div><!-- End .select-custom -->
									<button class="btn p-0 icon-search-3" type="submit" style="background-color:rgb(227,95,33);color:white;"></button>
								</div><!-- End .header-search-wrapper -->
							</form>
						</div><!-- End .header-search -->

						<div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-3 ml-xl-5">
							<i class="fa fa-map-marker bg-white"></i>
							<h6 class="pt-1 line-height-1">Delivery Address
                                
                                @if (Cookie::get('name') !== null)
                                <a href="" class="d-block text-dark ls-10 pt-1" data-toggle="modal" data-target="#address">
                                    {{Str::limit(Cookie::get('name'),10,$end='..')}}
                                </a>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#address" class="d-block text-dark ls-10 pt-1">Select your address</a>
                                @endif
                            </h6>
						</div><!-- End .header-contact -->
						@guest
						<a href="{{route('signin')}}" class="header-icon"><i class="icon-user-2"></i></a>
						@endguest
						@auth
							@if (Auth::user()->profile_image==null||Auth::user()->profile_image=='-')
								<a href="{{route('dashboard')}}" class="header-icon"><i class="icon-user-2"></i></a>
							@else
								<img src="{{asset('images/profile/'.Auth::user()->profile_image)}}" class="rounded-circle mr-3" alt="" width="5%" >
							@endif
							<ul class="menu">
									
								<li>
									<a href="#">{{Auth::user()->fname}}</a>
									<ul>
										<li><a href="{{route('dashboard')}}" class="ml-3 mr-5 mb-1"><i class="fa fa-user-circle  ml-4" aria-hidden="true"></i><span class="ml-3 mb-1" style="">DASHBOARD</span></a></li>
										
										<li><button form="signout" type="submit" class=" btn btn-md btn-primary ml-4" style="text-white" > <i class="fa fa-arrow-circle-right mr-2" aria-hidden="true"></i>
										<span class="ml-2 " style="">Logout</span></button> </li> 
										<form id="signout" style="margin: none !important;display:none;" action="{{route('logout')}}" method="post" >
											@csrf 
										</form>
									</ul>
								</li>	
							</ul>
                        @endauth
						<a href="{{route('customer.notifications.index')}}" class="header-icon"><i class=" fa fa-bell">
							 <sup class="" style="color:rgb(227,95,33);">
								 @auth
									{{Auth::user()->receivednotifications->where('status','!=',1)->count() }}
								 @endauth
								 @guest
									 0
								 @endguest
							</sup> </i></a>

						<div class="dropdown cart-dropdown">
							<a href="#" class="dropdown-toggle dropdown-arrow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
								<i class="icon-shopping-cart"></i>
								<span class="cart-count badge-circle "> {{Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
							</a>

							<div class="dropdown-menu">
								<div class="dropdownmenu-wrapper">
									<div class="dropdown-cart-header">
										<span> {{Session::has('cart') ? Session::get('cart')->totalQty : '0' }} Items</span>
										
										<a href="{{route('products.cart')}}" class="float-right">View Cart</a>
									</div><!-- End .dropdown-cart-header -->
									
									<div class="dropdown-cart-products">
										@if (Session::has('cart'))
										@foreach ($products as $item)
											<div class="product">
												<div class="product-details">
													<h4 class="product-title">
														<a href="#">{{$item['item']['name']}}</a>
													</h4>
													
													<span class="cart-product-info">
														<span class="cart-product-qty">{{$item['qty']}}</span>
														x Kshs {{$item['item']['selling_price']}}
													</span>
												</div><!-- End .product-details -->
													
												<figure class="product-image-container">
													<a href="#" class="product-image">
														<img src="{{asset('images/products/'.$item['item']['image'])}}" alt="product" width="80" height="80">
													</a>
													<a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
												</figure>
											</div><!-- End .product -->
										@endforeach
									</div><!-- End .cart-product -->
									
									<div class="dropdown-cart-total">
										<span>Total</span>
										
										<span class="cart-total-price float-right">Kshs {{$totalPrice}}</span>
									</div><!-- End .dropdown-cart-total -->
									
									<div class="dropdown-cart-action">
										<a href="{{route('checkout')}}" class="btn btn-dark btn-block">Checkout</a>
									</div><!-- End .dropdown-cart-total -->
									@else
									<strong class="cart-total-price p-5 m-5"> No items in the cart</strong>
									@endif
								</div><!-- End .dropdownmenu-wrapper -->
							</div><!-- End .dropdown-menu -->
						</div><!-- End .dropdown -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->
			@if (Route::currentRouteName()!='home.index')
			<div class="header-bottom sticky-header d-none d-lg-block">
				<div class="container">
					<nav class="main-nav w-100">
						<ul class="menu">
							<li class="{{Request::is('home*') ? 'active' : '' }}" >
								<a href="/" style="color: black;">Home</a>
							</li>
							<li class="{{Request::is('service*') ? 'active' : '' }}">
								<a href="#" style="color: black;">Services</a>
								<div class="megamenu megamenu-fixed-width megamenu-3cols">
									<div class="row">
										@forelse ($services as $item)
										<div class="col-lg-4">
											<a href="#" class="nolink">{{$item->title}}</a>
											<ul class="submenu">
												@foreach ($item->businesses->take(4) as $service)
													<li><a href="{{route('service',$service->id)}}">{{$service->title}}</a></li>
												@endforeach
											</ul>
										</div>
										@empty
											
										@endforelse
									</div>
								</div><!-- End .megamenu -->
							</li>
							<li class="{{Request::is('product*') ? 'active' : '' }}">
								<a href="#" style="color: black;">Products</a>
								<div class="megamenu megamenu-fixed-width">
									<div class="row">
										@forelse ($shops as $item)
										<div class="col-lg-3">
											<a href="#" class="nolink">{{$item->title}}</a>
											<ul class="submenu">
												@foreach ($item->businesses->take(4) as $shop)
													<li><a href="{{route('products.shop',$shop->id)}}">{{$shop->title}}</a></li>
												@endforeach
											</ul>
										</div><!-- End .col-lg-4 -->
										@empty
											
										@endforelse
										
									</div><!-- End .row -->
								</div><!-- End .megamenu -->
							</li>
							<li class="{{Request::is('account*') || Request::is('order*') ? 'active' : '' }}">
								<a href="#" style="color: black;">My Account</a>
								<ul>
									@if (Session::has('cart'))
									<li><a href="{{route('products.cart')}}">Shopping Cart</a></li>
									<li><a href="{{route('checkout')}}">Checkout</a></li>
									@endif
									@auth
									<li><a href="{{route('dashboard')}}">Dashboard</a></li>
									@endauth
									@guest
									<li><a href="{{route('signin')}}" class="login-link">Login</a></li>
									<li><a href="{{route('password.forgot')}}">Forgot Password</a></li>
									@endguest
								</ul>
							</li>
							<li class="{{Request::is('about*') ? 'active' : '' }}"><a href="{{route('about')}}" style="color: black;">About Us</a></li>
							<li class="{{Request::is('contact*') ? 'active' : '' }}"><a href="{{route('contact')}}" style="color: black;">Contact Us</a></li>
						</ul>
					</nav>
				</div><!-- End .container -->
			</div><!-- End .header-bottom -->
			@endif
		</header><!-- End .header -->
        @yield('content')
        <footer class="footer " style="background-color: rgb(227,95,33);color:white;">
			<div class="footer-middle">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title text-black" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">About Us</h4>
								<span><img class="rounded-circle" src="{{asset('images/icon/woza3.jpg')}}" alt="Porto Logo" width="75"></span>	
								{{-- <img src="{{asset('woza/assets/images/logo-footer.png')}}" alt="Logo" class="m-b-3"> --}}
								<p class="m-b-4 pb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus. Duis nec vestibulum magna, et dapibus lacus.</p>
								<a href="{{route('about')}}" class="read-more text-white">read more...</a>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget mb-2">
								<h4 class="widget-title mb-1 pb-1" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">Contact Info</h4>
								<ul class="contact-info m-b-4">
									<li>
										<span class="contact-info-label" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">Address:</span>Nairobi, Kenya
									</li>
									<li>
										<span class="contact-info-label" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">Phone:</span><a href="tel:">(123) 456-7890</a>
									</li>
									<li>
										<span class="contact-info-label" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">Email:</span> <a href="mailto:mail@example.com">woza@co.ke</a>
									</li>
								</ul>
								<div class="social-icons">
									<a href="#" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}" class="social-icon social-facebook icon-facebook text-white border-primary bg-primary"  target="_blank" title="Facebook"></a>
									<a href="#" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}" class="social-icon social-twitter icon-twitter text-white border-primary bg-primary" target="_blank" title="Twitter"></a>
									<a href="#" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}" class="social-icon social-linkedin fab fa-linkedin-in text-white border-primary bg-primary" target="_blank" title="Linkedin"></a>
								</div><!-- End .social-icons -->
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title pb-1" style="{{Route::currentRouteName()=='home.index2' ? 'color: rgb(227,95,33)':''}}">Customer Service</h4>

								<ul class="links">
									
									
									<li><a href="{{route('contact')}}">Contact Us</a></li>
									<li><a href="{{route('about')}}">About Us</a></li>
									
									<li><a href="#">Privacy</a></li>
								</ul>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<div class="container" style="color: white !important">
				<div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap text-white">
					<p class="footer-copyright py-3 pr-4 mb-0 text-white">© Woza. {{now()->year}}. All Rights Reserved</p>
				</div>
			</div><!-- End .container -->
		</footer><!-- End .footer -->
	</div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu mb-3">
					<li class="{{Request::is('home*') ? 'active' : '' }}" >
						<a href="/">Home</a>
					</li>
					<li class="{{Request::is('service*') ? 'active' : '' }}">
						<a href="#">Services</a>
						<div class="megamenu megamenu-fixed-width megamenu-3cols">
							<div class="row">
								@forelse ($services as $item)
								<div class="col-lg-4">
									<a href="#" class="nolink">{{$item->title}}</a>
									<ul class="submenu">
										@foreach ($item->businesses->take(4) as $service)
											<li><a href="{{route('service',$service->id)}}">{{$service->title}}</a></li>
										@endforeach
									</ul>
								</div>
								@empty
									
								@endforelse
							</div>
						</div><!-- End .megamenu -->
					</li>
					<li class="{{Request::is('product*') ? 'active' : '' }}">
						<a href="#">Products</a>
						<div class="megamenu megamenu-fixed-width">
							<div class="row">
								@forelse ($shops as $item)
								<div class="col-lg-3">
									<a href="#" class="nolink">{{$item->title}}</a>
									<ul class="submenu">
										@foreach ($item->businesses->take(4) as $shop)
											<li><a href="{{route('products.shop',$shop->id)}}">{{$shop->title}}</a></li>
										@endforeach
									</ul>
								</div><!-- End .col-lg-4 -->
								@empty
									
								@endforelse
								
							</div><!-- End .row -->
						</div><!-- End .megamenu -->
					</li>
					<li class="{{Request::is('account*') || Request::is('order*') ? 'active' : '' }}">
						<a href="#">My Account</a>
						<ul>
							@if (Session::has('cart'))
							<li><a href="{{route('products.cart')}}">Shopping Cart</a></li>
							<li><a href="{{route('checkout')}}">Checkout</a></li>
							@endif
							@auth
							<li><a href="{{route('dashboard')}}">Dashboard</a></li>
							@endauth
							@guest
							<li><a href="{{route('signin')}}" class="login-link">Login</a></li>
							<li><a href="{{route('password.forgot')}}">Forgot Password</a></li>
							@endguest
						</ul>
					</li>
					<li class="{{Request::is('about*') ? 'active' : '' }}"><a href="{{route('about')}}">About Us</a></li>
					<li class="{{Request::is('contact*') ? 'active' : '' }}"><a href="{{route('contact')}}">Contact Us</a></li>
				</ul>

				<ul class="mobile-menu">
					
					<li><a href="{{route('about')}}">About</a></li>
					<li><a href="{{route('contact')}}">Contact</a></li>
				</ul>
			</nav><!-- End .mobile-nav -->

			<div class="social-icons">
				<a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
				<a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
				<a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
			</div><!-- End .social-icons -->
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->
	<!-- Add Cart Modal -->
	<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body add-cart-box text-center">
			<p>You've just added this product to the<br>cart:</p>
			<h4 id="productTitle"></h4>
			<img src="#" id="productImage" width="100" height="100" alt="adding cart image">
			<div class="btn-actions">
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-body add-cart-box text-center">
				<h2>Delivery Address</h2>
			
				<form action="{{route('cookie.set')}}" method="POST">
					@csrf
					@if (Cookie::get('name') !== null)
					<div class="form-group">
						<label for="singin-email">Change location</label> <br>
					   <h4 > <b>{{Cookie::get('name')}}</b> </h4>
					</div>
					@endif
					<div class="form-group">
						<label for="txtPlaces" id="details">What is your address?</label>
		
						<input type="text" class="form-control" id="txtPlaces" name="txtPlaces" placeholder="Enter a location" autocomplete="additional-name">
				</div><!-- End .form-group -->
				<div class="form-group" id="lat_area">
					<label for="latitude"> Latitude </label>
					<input type="text" name="latitude" id="latitude" class="form-control">
				</div>
		
				<div class="form-group" id="long_area">
					<label for="latitude"> Longitude </label>
					<input type="text" name="longitude" id="longitude" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="  btn btn-primary btn-md">Confirm Address</button>
					<a href="#"><button class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button></a>
				</div> 
			
				</form>
			</div>
		  </div>
		</div>
	  </div>

	  
	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="{{asset('woza/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('woza/assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('woza/assets/js/plugins.min.js')}}"></script>

	<!-- Main JS File -->
	<script src="{{asset('woza/assets/js/main.min.js')}}"></script>
	
	<script>
        $(document).ready(function() {
        $("#lat_area").addClass("d-none");
        $("#long_area").addClass("d-none");
        $(".address-btn").prop('disabled', true);
        });
    </script>
    <script>
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var options = {
  types: ['establishment'],
  componentRestrictions: {country: "ke"}
 };
    var input = document.getElementById('txtPlaces');
    var autocomplete = new google.maps.places.Autocomplete(input,options);
    autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    $('#latitude').val(place.geometry['location'].lat());
    $('#longitude').val(place.geometry['location'].lng());
    $(".address-btn").prop('disabled', false);
    // --------- show lat and long ---------------
    // $("#lat_area").removeClass("d-none");
    // $("#long_area").removeClass("d-none");
    });
    }
    </script>
</body>
<script>
$('#address').on('shown.bs.modal', function() {
	$(document).off('focusin.modal');
});
</script>
@if (session('address'))
	<script>
		    $('#address').modal('show');
	</script>
@endif
<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo_6/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:18:46 GMT -->
</html>