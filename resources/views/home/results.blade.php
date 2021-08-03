@extends('layouts.base')
<title> Search Results</title>
@section('content')
<h3 style="margin-left: 45%;margin-top:5%;" class="text-success">{{$query}}</h3>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="banner-group-1 mt-1 mb-1">
        
            <div class="container">
             
                <div class="cat-section mt-4 mb-3">
                    <div class="row">
                        @forelse ($results as $item)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-8col">
                                <div class="cat bg-white pt-1 mb-2">
                                    <div class="cat-image d-flex justify-content-center align-items-center">
                                        <a href="{{url('shop/'.$item->business_id.'/products?product='.$query)}}"><img class="rounded-circle" src="{{asset('images/products/'.$item->image)}}" width="100" height="100"></a>
                                    </div>
                                    <div class="cat-content text-center">
                                        <a href="{{route('products.shop',$item->business_id)}}" class="cat-title">{{$item->name}}</a>
                                        <h4 class="cat-count letter-spacing-normal d-block font-weight-light">Kshs {{$item->selling_price}}</h4>
                                        <a href="{{route('products.shop',$item->business_id)}}" class="cat-title">{{$item->shop->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="content-align-center">
                            <h6>We could not find a match for "{{$query}}"</h6>
                            <a href="/" class="btn btn-success">View all shops</a>
                        </div>
                          
                        @endforelse
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
