@extends('layouts.main')
<title>View Service</title>
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Service</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{asset('images/'.$shop->logo)}}" data-zoom-image="{{asset('images/'.$shop->logo)}}" alt="product image">

                                  
                                </figure><!-- End .product-main-image -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->
                   
                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{$shop->title}}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                Kshs {{$shop->pricing}}
                            </div><!-- End .product-price -->


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
                        
                            <div class="product-details-action">
                                <a href="{{route('bookservice',$shop->id)}}" class="btn-product btn-success text-white"><i class="fa fa-calendar fa-1x mr-3"> </i> <span class="text-white text-decoration-none">  Book Service</span></a>
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{route('services',$shop->category)}}">{{$shop->category}}</a>
                                </div><!-- End .product-cat -->
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div>
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Service Information</h3>
                            <p>{{$shop->description}}. </p>
                            
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">Other Services You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
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
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                @forelse ($others as $item)
                <div class="product product-7 text-center">
                    <figure class="product-media">
                       
                        <a href="{{route('bookservice',$shop->id)}}">
                            <img src="{{asset('images/'.$item->logo)}}" alt="Product image" class="product-image">
                        </a>
                        <div class="product-action">
                            <a href="{{route('bookservice',$item->id)}}" class="btn-product btn-success text-white"><i class="fa fa-calendar fa-1x mr-3 bg-primary"> </i> <span class="text-decoration-none">  Book Service</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">{{$item->category}}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{route('service',$item->id)}}">{{$item->title}}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            Kshs {{$item->pricing}}
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @empty
                    
                @endforelse
               
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
