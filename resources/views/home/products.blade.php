@extends('layouts.main')
<title>Shop Products</title>
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{$shop->title}}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                               
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                          
                         
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->
                    @if (session('error'))
                        <div class="alert alert-danger m-5 text-center">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="products mb-3">
                        @forelse ($shop_products as $item)
                        <div class="product product-list">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <figure class="product-media">
                                        <a href="">
                                            <img src="{{asset('images/products/'.$item->image)}}" alt="Product image" class="product-image">
                                        </a>
                                    </figure><!-- End .product-media -->
                                </div><!-- End .col-sm-6 col-lg-3 -->
                                <div class="col-6 col-lg-3 order-lg-last">
                                    <div class="product-list-action">
                                        <div class="product-price">
                                           Kshs {{$item->selling_price}}
                                        </div><!-- End .product-price -->
                                        <a href="{{route('product.addtocart',['shop'=>$shop->id,'id'=>$item->id])}}" class="btn-product btn-cart"><span>add to cart</span></a>
                                    </div><!-- End .product-list-action -->
                                </div><!-- End .col-sm-6 col-lg-3 -->

                                <div class="col-lg-6">
                                    <div class="product-body product-action-inner">
                                        <div class="product-cat">
                                            <a href="#">{{$item->category->title}}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="">{{$item->name}}</a></h3><!-- End .product-title -->

                                        <div class="product-content">
                                            <p>{{$item->description}} </p>
                                        </div><!-- End .product-content -->
                                        
                                        <div class="product-nav product-nav-thumbs">
                                            <a href="#" class="active">
                                                <img src="{{asset('images/products/'.$item->image)}}" alt="product desc">
                                            </a>
                                            <a href="#">
                                                <img src="{{asset('images/products/'.$item->image)}}" alt="product desc">
                                            </a>

                                            <a href="#">
                                                <img src="{{asset('images/products/'.$item->image)}}" alt="product desc">
                                            </a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .product -->
                        @empty
                            <div class="content-align-center ml-5 pl-5 p-5">
                                <h6>We could not find any products in the shop "{{$shop->title}}"  </h6>
                                <a href="/" class="btn btn-success">Try other shops</a>
                            </div>
                        @endforelse
                      
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                           {{$shop_products->links()}}
                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                       

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Product Categories
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        @foreach ($shop_categories as $item)
                                        <div class="filter-item">
                                            <div class="custom-control ">
                                                <a href="{{url('shop/'.$shop->id.'/products?category='.$item->id)}}">{{$item->title}}</a>
                                                <label></label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{$item->products->where('business_id',$shop->id)->where('category_id',$item->id)->count()}}</span>
                                        </div><!-- End .filter-item -->
                                        @endforeach
                                        
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
