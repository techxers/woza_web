@extends('layouts.base')

@section('title')
    <title>Shop Products</title>
@endsection

@section('content')
<main class="main">
    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                        <h4 class="ml-lg-5 mb-2 ls-10">{{$shop->title}}<br>Shop</h4>
                       
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
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Shops</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$shop->title}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 order-lg-1">
                <nav class="toolbox">
                    <div class="toolbox-left">
                    </div><!-- End .toolbox-left -->
                    <div class="toolbox-right">   
                    </div><!-- End .toolbox-right -->
                </nav>
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}<br>
                    </div>
                    @endforeach
                @endif
                <div class="row pb-4">
                    @forelse ($shop_products as $item)
                    <div class="col-12 product-default left-details product-list mb-4">
                        <figure>
                            <a href="product.html">
                                <img src="{{asset('images/products/'.$item->image)}}">
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">{{$item->category->title}}</a>
                            </div>
                            <h2 class="product-title">
                                <a href="product.html">{{$item->name}}</a>
                            </h2>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <p class="product-description"> {{$item->description}}</p>
                            <div class="price-box">
                                <span class="product-price">   Kshs {{$item->selling_price}}</span>
                            </div><!-- End .price-box -->
                            <div class="product-action">
                                
                                <a href="{{route('product.addtocart',['shop'=>$shop->id,'id'=>$item->id])}}"  class="btn btn-icon btn-add-cart text-white" ><i class="icon-shopping-cart"></i>ADD TO CART</a>
                                
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                    @empty
                    <div class="price-box m-3">
                        <h4 class="product-title ">
                            <p class="alert alert-danger">We could not find any products in this shop at this time. Try searching for other related shops </p>
                            
                        </h4>
                        <a href="{{route('categories',$shop->category)}}" class="btn btn-primary btn-md">View related shops</a>
                    </div>
                    @endforelse
                   
                </div>

                <nav class="toolbox toolbox-pagination">
                    <div class="toolbox-item toolbox-show">
                        
                    </div><!-- End .toolbox-item -->

                    {{-- <ul class="pagination toolbox-item">
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
                    </ul> --}}
                </nav>
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-shop col-lg-3 mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Product Categories</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($shop_categories as $item)
                                    <li><a href="{{url('shop/'.$shop->id.'/products?category='.$item->id)}}">{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                   
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- margin -->
</main><!-- End .main -->
@endsection