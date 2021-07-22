@extends('layouts.base')

@section('title')
   <title>Service</title> 
@endsection

@section('content')
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Service</a></li>
            </ol>
        </nav>
        <div class="product-single-container product-single-default">
            <div class="row">
                <div class="col-md-5 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="product-single-carousel owl-carousel owl-theme">
                            <div class="product-item">
                                <img class="product-single-image" src="{{asset('images/'.$shop->logo)}}" data-zoom-image="{{asset('images/'.$shop->logo)}}"/>
                            </div>
                            
                          
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>
                    
                </div><!-- End .product-single-gallery -->

                <div class="col-md-7 product-single-details">
                    <h1 class="product-title">{{$shop->title}}</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->

                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div><!-- End .ratings-container -->

                    <hr class="short-divider">

                    <div class="price-box">
                        <span class="product-price">Kshs {{$shop->pricing}}</span>
                    </div><!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {{$shop->description}}
                        </p>
                    </div><!-- End .product-desc -->
                    <div class="details-filter-row details-row-size  mr-5" style=" white-space: nowrap;
                    overflow: hidden;">
                        <label class="mr-5">Opening Time:</label>

                        <div class="product-nav product-nav-thumbs ml-5">
                            {{$shop->open_time}}
                        </div><!-- End .product-nav -->
                    </div><!-- End .details-filter-row -->

                    <div class="details-filter-row details-row-size mr-5" style=" white-space: nowrap;
                    overflow: hidden;">
                        <label for="size" class="mr-5">Closing Time:</label>
                        <div class="product-nav product-nav-thumbs ml-5">
                            {{$shop->close_time}}
                        </div><!-- End .product-nav -->
                    </div><!-- End .details-filter-row -->
                    <hr class="divider">

                    <div class="product-action">
                        <a href="{{route('bookservice',$shop->id)}}" class="btn btn-dark add-cart" title="Add to Cart"><i class="fa fa-calendar fa-1x mr-3"> </i>Book Service</a>
                    </div><!-- End .product-action -->

                    <hr class="divider mb-1">

                    <div class="product-single-share">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                        </div><!-- End .social-icons -->

                        
                    </div><!-- End .product single-share -->
                </div><!-- End .product-single-details -->
            </div><!-- End .row -->
        </div><!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Location</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>  {{$shop->address}}.</p>
                        
                    </div><!-- End .product-desc-content -->
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-single-tabs -->
        <div class="products-section pt-0">
            <h2 class="section-title">Related Services</h2>
            <div class="products-slider owl-carousel owl-theme dots-top">
                @forelse ($others as $item)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="product.html">
                            <img src="{{asset('images/'.$item->logo)}}">
                        </a>
                        <div class="label-group">
                            <span class="product-label label-sale">Service</span>
                        </div>
                      
                        <a href="{{route('service',$item->id)}}" class="btn-quickview" title="Quick View">Quick View</a> 
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="{{route('service',$item->id)}}" class="product-category">{{$item->category}}</a>
                            </div>
                        </div>
                        <h3 class="product-title">
                            <a href="{{route('service',$item->id)}}">{{$item->title}}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .ratings-container -->
                        <div class="price-box">
                           
                            <span class="product-price">  Kshs {{$item->pricing}}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                @empty
                @endforelse
            </div><!-- End .products-slider -->
        </div><!-- End .products-section -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection