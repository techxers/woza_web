@extends('layouts.main')
<title>Home</title>
@section('content')
@if (session('success'))
    <div class="alert alert-success ml-5 mr-5 text-center" width="50%">
    {{session('success')}}
    </div> 
@endif

    <div class="container">
        <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="products-featured-link" data-toggle="tab" href="#products-featured-tab" role="tab" aria-controls="products-featured-tab" aria-selected="true">Shops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="products-sale-link" data-toggle="tab" href="#products-sale-tab" role="tab" aria-controls="products-sale-tab" aria-selected="false">Services</a>
            </li>
        </ul>
    </div><!-- End .container -->
    
    <div class="container-fluid">
       
        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":5
                            },
                            "1600": {
                                "items":6,
                                "nav": true
                            }
                        }
                    }'>
                    @forelse ($shops as $item)
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            @if (Cookie::get('name') === null)
                            <a href="#address" data-toggle="modal">
                            @else
                            <a href="{{route('categories',$item->title)}}">
                            @endif
                            
                                <img src="{{asset('images/'.$item->icon)}}" alt="Product image" class="product-image" width="280" height="280">
                                <img src="{{asset('images/'.$item->icon)}}" alt="Product image" class="product-image-hover">
                            </a>
                        </figure><!-- End .product-media -->
                        <div class="product-body">
                           
                            <h3 class="product-title">
                                @if (Cookie::get('name') === null)
                                <a href="#address" data-toggle="modal">
                                @else
                                <a href="{{route('categories',$item->title)}}">
                                @endif
                                    {{$item->title}}
                                </a>
                            </h3><!-- End .product-title -->
                            <div class="product-price">
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                    </div>
                    @empty
                        
                    @endforelse
                    <!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="products-sale-tab" role="tabpanel" aria-labelledby="products-sale-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":5
                            },
                            "1600": {
                                "items":6,
                                "nav": true
                            }
                        }
                    }'>
                    @forelse ($services as $item)
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            @if (Cookie::get('name') === null)
                            <a href="#address" data-toggle="modal">
                            @else
                            <a href="{{route('services',$item->title)}}">
                            @endif
                            
                                <img src="{{asset('images/'.$item->icon)}}" alt="Product image" class="product-image">
                                <img src="{{asset('images/'.$item->icon)}}" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title">
                                @if (Cookie::get('name') === null)
                                <a href="#address" data-toggle="modal">
                                @else
                                <a href="{{route('services',$item->title)}}">
                                @endif
                          
                                    {{$item->title}}
                                </a>
                            </h3><!-- End .product-title -->
                            <div class="product-price">
                                
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                    </div>
                    @empty
                        
                    @endforelse
                    <!-- End .product -->

                    
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
           
        </div><!-- End .tab-content -->
    </div><!-- End .container-fluid -->

    <div class="mb-5"></div><!-- End .mb-5 -->


    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title">Popular Shops and Services in Woza</h2><!-- End .title -->
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">Top 10</a>
                </li>
            </ul>
        </div><!-- End .heading -->
        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">
                     @forelse ($businesses->take(10) as $item)
                     <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                @if (Cookie::get('name') === null)
                                <a href="#address" data-toggle="modal">
                                @else
                                <a href="{{route('products.shop',$item->id)}}">
                                @endif
                                    <img src="{{asset('images/'.$item->logo)}}" alt="Product image" class="product-image">
                                    <img src="{{asset('images/'.$item->logo)}}" alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="">{{$item->category}}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title">
                                    @if (Cookie::get('name') === null)
                                    <a href="#address" data-toggle="modal">
                                    @else
                                    <a href="{{route('products.shop',$item->id)}}">
                                    @endif
                                        {{$item->title}}
                                    </a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                  Kshs {{$item->pricing}}
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div>
                     @empty
                     
                         No shops or services to display
                   
                     @endforelse

                       <!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="container">
        <hr class="mt-1 mb-6">
    </div><!-- End .container -->
    
  
</main><!-- End .main -->

@endsection
