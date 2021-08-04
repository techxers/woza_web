@extends('layouts.base')

@section('title')
    <title>Woza::Home</title>
@endsection

@section('content')
<main class="main">
    <div class="container mb-2">
        <div class="info-boxes-container row row-joined mb-2 font2">
            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>AFFORDABLE & QUICK DELIVERY </h4>
                    <p class="text-body">Affordable delivery within few minutes </p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-money"></i>

                <div class="info-box-content">
                    <h4>GUARANTEE QUALITY</h4>
                    <p class="text-body">100% guarantee on quality of products and services</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p class="text-body">24/7 customer support and service.</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->
        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="home-slider owl-carousel owl-theme owl-carousel-lazy mb-2" data-owl-options="{
                    'loop': false,
                    'dots': true,
                    'nav': false
                }">
                    @foreach ($featured_shops as $item)

                    <div class="home-slide  home-slide1 banner banner-md-vw banner-sm-vw" style="background-color: rgb(227,95,33)">
                    <?php $i=random_int(1,20);?>
                            <img class="owl-lazy slide-bg" src="{{asset('woza/assets/images/splash/splash'.$i.'.jpg')}}" data-src="{{asset('woza/assets/images/splash/splash'.$i.'.jpg')}}" alt="slider image">
                        <div class="banner-layer banner-layer-middle text-uppercase">
                            <h4 class=" m-b-2 " style="color: rgb(18,36,74)" ><strong>{{$item->description}}</strong></h4>
                            <h2 class="text-white m-b-3">{{$item->title}}</h2>
                            <h3 class="text-uppercase m-b-3 text-white" >{{$item->category}}</h3>
                            <h5 class=" text-white d-inline-block mb-0 align-top mr-5">Starting At <b class="coupon-sale-text bg-secondary text-white d-inline-block">Kshs <em>{{(int)$item->pricing + 1}}</em></b></h5>
                            <a href="{{route('products.shop',$item->id)}}" class="btn btn-dark btn-md ls-10">View Shop</a>
                        </div><!-- End .banner-layer -->
                    </div><!-- End .home-slide -->
                    @endforeach
                </div><!-- End .home-slider -->

                <div class="banners-container m-b-2 owl-carousel owl-theme" data-owl-options="{
                    'dots': false,
                    'margin': 20,
                    'loop': false,
                    'responsive': {
                        '480': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        }
                    }
                }">
                @foreach ($featured_products as $item)

                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{route('products.shop',$item->business_id)}}">
                                <img src="{{asset('images/products/'.$item->image)}}">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                            </div>
                           
                            <a href="{{route('products.shop',$item->business_id)}}" class="btn-quickview" title="Quick View">Quick View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="{{route('products.shop',$item->business_id)}}" class="product-category h1">{{$item->category->title}}</a>
                                </div>
                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h1 class="product-title">
                                <a href="{{route('products.shop',$item->business_id)}}">{{$item->name}}</a>
                            </h1>
                            
                            <div class="price-box">
                                <h2 class="m-b-4 text-primary"><sup class="text-dark"><del> {{$item->selling_price+(random_int(1,10)/100)*$item->selling_price}}</del></sup>{{$item->selling_price}} <sup>/=</sup></h2>
                              
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                @endforeach    
                </div>
                <h2 class="section-title ls-n-10 m-b-4">Products</h2>
                <div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
                    @forelse ($shops->take(162) as $item)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                @if (Cookie::get('name') === null)
                                <a href="#address" data-toggle="modal" data-target="#address">
                                @else
                                <a href="{{route('categories',$item->title)}}">
                                @endif
                    
                                    <img class="" src="{{asset('images/'.$item->icon)}}">
                                </a>
                                <div class="label-group">
                                    <div class="product-label label-hot">PRODUCT</div>
                                </div>
                               
                                @if (Cookie::get('name') !== null)
                                
                                 <a href="{{route('categories',$item->title)}}" class="btn-quickview" title="Quick View">View Category</a>
                              
                                @endif
                               
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        @if (Cookie::get('name') === null)
                                        <a href="#address" data-toggle="modal" data-target="#address" class="product-category">category</a>
                                        @else
                                        <a href="{{route('categories',$item->title)}}" class="product-category">category</a>
                                        @endif
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    @if (Cookie::get('name') === null)
                                    <a href="#address" data-toggle="modal" data-target="#address"> {{$item->title}}</a>
                                    @else
                                    <a href="{{route('categories',$item->title)}}"> {{$item->title}}</a>
                                    @endif
                                </h2>
                                
                            </div><!-- End .product-details -->
                        </div>
                    @empty
                        <li>No Categories to display</li>
                    @endforelse
                
                </div><!-- End .featured-proucts -->
                <h2 class="section-title ls-n-10 m-b-4">Services</h2>
                <div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
                    @forelse ($services as $item)
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="{{route('services',$item->title)}}">
                                    <img class="" src="{{asset('images/'.$item->icon)}}">
                                </a>
                                <div class="label-group">
                                    <div class="product-label label-sale">SERVICE</div>
                                </div>
                               
                                <a href="{{route('services',$item->title)}}" class="btn-quickview" title="Quick View">View Category</a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{route('services',$item->title)}}" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{route('services',$item->title)}}"> {{$item->title}}</a>
                                </h2>
                                
                            </div><!-- End .product-details -->
                        </div>
                    @empty
                        <li>No Categories to display</li>
                    @endforelse
                
                </div><!-- End .featured-proucts -->
                <hr class="mt-1 mb-4">
                <div class="feature-boxes-container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-earphones-alt" style="border: solid 1px rgb(227,95,33); color:rgb(227,95,33)"></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Customer Support</h3>
                                    <h5 class="m-b-3" style=" color:rgb(227,95,33) ">Need Assistance?</h5>

                                    <p>We provide 24/7 customer support and assistance.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-credit-card" style="border: solid 1px rgb(227,95,33); color:rgb(227,95,33) "></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Secured Payment</h3>
                                    <h5 class="m-b-3" style=" color:rgb(227,95,33) ">Safe & Fast</h5>

                                    <p>Easy and convinient payment options.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-3 feature-box-simple text-center">
                                <i class="icon-action-undo" style="border: solid 1px rgb(227,95,33); color:rgb(227,95,33)"></i>

                                <div class="feature-box-content">
                                    <h3 class="m-b-1">Orders and Bookings</h3>
                                    <h5 class="m-b-3" style=" color:rgb(227,95,33) ">Easy & Available</h5>

                                    <p>Make an order or a booking anytime anywhere.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .feature-boxes-container -->
            </div><!-- End .col-lg-9 -->
            
            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                <div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
                    <h2 class="side-menu-title bg-gray ls-n-25">Browse</h2>

                    <nav class="side-nav">
                        <ul class="menu menu-vertical sf-arrows">
                            <li class="active"><a href="/"><i class="icon-home"></i>Home</a></li>
                            <li>
                                <a href="#" class="sf-with-ul"><i class="sicon-badge"></i>Services</a>
                                <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                    <div class="row">
                                        @foreach ($services as $item)
                                        <div class="col-lg-4">
                                            <a href="#" class="nolink">{{$item->title}}</a>
                                            <ul class="submenu">
                                                @foreach ($item->businesses->take(4) as $service)
                                                    <li><a href="{{route('service',$service->id)}}">{{$service->title}}</a></li> 
                                                    
                                                @endforeach
                                                <li><a href="{{route('services',$item->title)}}"> <strong>View More..</strong> </a> </li>
                                            </ul>
                                        </div> 
                                        @endforeach
                                    </div>
                                </div><!-- End .megamenu -->
                            </li>
                            <li>
                                <a href="product.html" class="sf-with-ul"><i class="sicon-basket"></i>Products</a>
                                <div class="megamenu megamenu-fixed-width">
                                    <div class="row">
                                        @foreach ($shops as $item)
                                        <div class="col-lg-3">
                                            <a href="#" class="nolink">{{$item->title}}</a>
                                            <ul class="submenu">
                                                @foreach ($item->businesses->take(4) as $service)
                                                    <li><a href="{{route('products.shop',$service->id)}}">{{$service->title}}</a></li> 
                                                @endforeach
                                            </ul>
                                        </div><!-- End .col-lg-4 -->
                                       @endforeach
                                    </div><!-- End .row -->
                                </div><!-- End .megamenu -->
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul"><i class="sicon-users"></i>My Account</a>
                                <ul>
                                    @if (Session::has('cart'))
                                        <li><a href="{{route('products.cart')}}">Shopping Cart</a></li>
                                        <li><a href="{{route('checkout')}}">Checkout</a></li>
                                    @endif
                                   @auth
                                   <li>
									<a href="#">{{Auth::user()->fname}}</a>
									<ul>
										<li><a href="{{route('dashboard')}}" class="ml-5"><i class="fa fa-user-circle " aria-hidden="true"></i><span class="ml-3 mb-1" style="">Dashboard</span></a></li>
										
										<li><button form="signout" type="submit" class=" btn btn-sm btn-primary w-100 rounded" > <i class="fa fa-arrow-circle-right  mr-2" aria-hidden="true"></i>
										<span class=" " style="">Logout</span></button> </li> 
										<form id="signout" style="margin: none !important;display:none;" action="{{route('logout')}}" method="post" >
											@csrf 
										</form>
									</ul>
								</li>
                                   @endauth
                                    @guest
                                        <li><a href="{{route('signin')}}" class="login-link">Login</a></li>
                                        <li><a href="{{route('password.forgot')}}">Forgot Password</a></li>
                                    @endguest
                                    
                                </ul>
                                	
                            </li>
                           
                            <li><a href="{{route('about')}}"><i class="sicon-book-open"></i>About Us</a></li>
                            
                        </ul>
                    </nav>
                </div><!-- End .side-menu-container -->
                <div class="widget widget-banners px-5 pb-3 text-center">
                    <div class="owl-carousel owl-theme">
                        @foreach ($featured_products as $item)
                        <div class="banner d-flex flex-column align-items-center">
                            <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
                            <h4 class="sale-text font1 text-uppercase m-b-3"> {{$item->selling_price}}<sup>/=</sup><sub>only</sub></h4>
                            <p>{{$item->name}}</p>
                            <a href="{{route('products.shop',$item->business_id)}}" class="btn btn-dark btn-md font1">View Sale</a>
                        </div><!-- End .banner -->

                        @endforeach
                    </div><!-- End .banner-slider -->
                </div><!-- End .widget -->
                <div class="widget widget-newsletters bg-gray text-center">
                    <h3 class="widget-title text-uppercase">Become A Woza Partner</h3>
                    <p class="mb-2">Allow your customers to access your products and services online. </p>
                    <form action="{{route('partner.signup')}}" method="get">
                        <div class="form-group position-relative sicon-envolope-letter">
                            <input type="email" class="form-control" name="newsletter-email" placeholder="Email address">
                        </div><!-- Endd .form-group -->
                        <input type="submit" class="btn btn-primary btn-md" value="Subscribe">
                    </form>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection