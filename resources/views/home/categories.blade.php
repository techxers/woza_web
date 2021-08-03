@extends('layouts.main')
<title> Product Categories</title>
@section('content')
<h3 style="margin-left: 45%;margin-top:5%;" class="text-success">{{$id}}</h3>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories',$id)}}">Shops Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$id}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="banner-group-1 mt-1 mb-1">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="container">
             
                <div class="cat-section mt-4 mb-3">
                    <div class="row">
                        @forelse ($categories as $item)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-8col">
                                <div class="cat bg-white pt-1 mb-2">
                                    <div class="cat-image d-flex justify-content-center align-items-center">
                                        <a href="{{route('products.shop',$item->id)}}"><img class="rounded-circle" src="{{asset('images/'.$item->logo)}}" width="100" height="100"></a>
                                    </div>
                                    <div class="cat-content text-center">
                                        <a href="{{route('products.shop',$item->id)}}" class="cat-title">{{$item->category}}</a>
                                        <h4 class="cat-count letter-spacing-normal d-block font-weight-light">{{$item->title}}</h4>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="content-align-center">
                            <h6>We could not find a match for "{{$id}}" within your location</h6>
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
