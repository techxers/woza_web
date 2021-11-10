@extends('layouts.base')
<title> Search Results</title>
@section('content')

<main class="main">
    <div class="category-banner-container bg-gray">
        <?php $i=random_int(1,20);?>
        <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url({{asset('woza/assets/images/splash/splash'.$i.'.jpg')}});">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                        <h4 class="ml-lg-5 mb-2 ls-10">{{$query}}<br>Search Results</h4>
                    </div>
                    <div class="pl-lg-5 col-md-4 offset-md-0 offset-1 pt-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Search</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$query}}</li>
            </ol>
        </nav>
        <div class="row main-content-wrap">
           
            <div class="col-lg-12 main-content">
                <div class="row">
                    @forelse ($searchproducts as $item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    
                                    <a href="{{url('shop/'.$item->business_id.'/products?product='.$query)}}">
                                    <img src="{{asset('images/products/'.$item->image)}}">
                                        
                            
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-hot}}">PRODUCT</div>
                                    </div>
                                
                                        <a href="{{route('products.shop',$item->business_id)}}" class="btn btn-primary btn-block text-white" title="Quick View">View Product</a>
                                
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                       
                                                <a href="{{route('products.shop',$item->business_id)}}" class="product-category">{{$item->shop->title}}</a>  
                                        </div>
                                    </div>
                                    <h2 class="product-title">
                                            <a href="{{url('shop/'.$item->business_id.'/products?product='.$query)}}">{{$item->name}}</a>
                                        
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">Kshs
                                          
                                            {{$item->selling_price}}
                                       
                                        </span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-sm-4 -->
                    @empty
                        
                    @endforelse

                
                </div><!-- End .row -->
                <div class="row">
                    @forelse ($searchproducts as $item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                  
                                        <a href="{{url('shop/'.$item->business_id.'/products?product='.$query)}}">
                                        <img src="{{asset('images/products/'.$item->image)}}">
                                    
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-hot">PRODUCT</div>
                                    </div>
                                
                                        <a href="{{route('products.shop',$item->business_id)}}" class="btn btn-primary btn-block text-white" title="Quick View">View Product</a>
                                  
                                    
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            
                                                <a href="{{route('products.shop',$item->business_id)}}" class="product-category">{{$item->shop->title}}</a>
                                            
                                        </div>
                                    </div>
                                    <h2 class="product-title">
                                       
                                            <a href="{{url('shop/'.$item->business_id.'/products?product='.$query)}}">{{$item->name}}</a>

                                        
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">Kshs
                                         
                                            {{$item->selling_price}}
                                            
                                        </span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-sm-4 -->
                    @empty
                     
                    @endforelse

                
                </div><!-- End .row -->
                <div class="row">
                    @forelse ($services as $item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                   
                                        
                            
                                        <a href="{{route('service',$item->id)}}">
                                        <img src="{{asset('images/'.$item->logo)}}">
            
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-sale">SERVICE</div>
                                    </div>
                                  
                                        <a href="{{route('service',$item->id)}}"class="btn btn-primary btn-block text-white" title="Quick View">View Service</a>
                                  
                                    
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                          
                                                <a href="{{route('service',$item->id)}}">{{$item->category}}</a>
                                              
                                        </div>
                                    </div>
                                    <h2 class="product-title">
                                       
                                            <a href="{{route('service',$item->id)}}">{{$item->title}}</a>
                                      
                                        
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">Kshs
                                           
                                            {{$item->pricing}}
                                        
                                        </span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-sm-4 -->
                    @empty
                        <div class="content-align-center m-5 p-5">
                            
                        </div>
                    @endforelse

                
                </div><!-- End .row -->
                <div class="row">
                    @forelse ($shops as $item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                   
                               
                                        <a href="{{route('products.shop',$item->id)}}">
                                        <img src="{{asset('images/'.$item->logo)}}"> 
                                
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-sale">SHOP</div>
                                    </div>
                                    
                                        <a href="{{route('products.shop',$item->id)}}"class="btn btn-primary btn-block text-white" title="Quick View">View Shop</a>
                                    
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                           
                                                <a href="{{route('products.shop',$item->id)}}">{{$item->category}}</a>
                                            
                                        </div>
                                    </div>
                                    <h2 class="product-title">
                                        
                                            <a href="{{route('products.shop',$item->id)}}">{{$item->title}}</a>
                                      
                                        
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">Kshs
                                            
                                            {{$item->pricing}}
                                           
                                        </span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-sm-4 -->
                    @empty
                        
                    @endforelse
                        @if ($searchproducts==null && $services==null && $shops==null)
                            <div class="content-align-center m-5 p-5">
                                <h6 class="alert alert-danger">We could not find a match for "{{$query}}". Try searching using a different keyword or name.</h6>
                                <a href="/" class="btn btn-primary btn-sm"><i class="icon-home m-2"></i>Home</a>
                            </div>
                        @endif
                
                </div><!-- End .row -->
                
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        
                    </div><!-- End .widget -->

                    
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

   
</main><!-- End .main -->


@endsection
