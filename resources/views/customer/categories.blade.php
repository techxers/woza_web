@extends('layouts.base')

@section('title')
    <title>Product Categories</title>
@endsection

@section('content')
<main class="main">
    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                        <h4 class="ml-lg-5 mb-2 ls-10">{{$id}}<br>Shops</h4>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Shops</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$id}}</li>
            </ol>
        </nav>
        <div class="row mx-0 divide-line up-effect">
            @forelse ($categories as $item)
            <div class="col-6 col-sm-4 col-md-3 product-default inner-quickview inner-icon">
                <figure>
                    <a href="{{route('products.shop',$item->id)}}">
                        <img class="rounded-circle" src="{{asset('images/'.$item->logo)}}">
                    </a>
                    <div class="label-group">
                        <div class="product-label label-hot">{{$item->category}}</div>
                       
                    </div>
                   
                    <a href="{{route('products.shop',$item->id)}}" class="btn-quickview" title="Quick View">View Shop</a> 
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="{{route('products.shop',$item->id)}}" class="product-category">category</a>
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
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div><!-- End .product-default -->
            @empty
            <div class="product-details m-5 p-5">    
                    <h4 class="product-title ">
                        @if ($places!=null)
                            <p class="alert alert-danger">Sorry there are no {{$id}} shops currently. Try another time</p>
                        @else
                            <p class="alert alert-danger"> No  {{$id}} shops found within your area</p>
                        @endif
                    </h4>
                    @if ($places!=null)
                        <a href="/" class="btn btn-primary" >Home</a>
                    @else
                        <a href="?places=others" class="btn btn-primary" >Try other shops</a>
                    @endif
                    
                </div><!-- End .product-details -->
           
            @endforelse
            
        </div><!-- End .row -->

         <nav class="toolbox toolbox-pagination border-0">
            <ul class="pagination toolbox-item">
                <li class="page-item disabled">
                    <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><span class="page-link">...</span></li>
                <li class="page-item">
                    <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                </li>
            </ul>
        </nav> 
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- margin -->
</main><!-- End .main -->
@endsection