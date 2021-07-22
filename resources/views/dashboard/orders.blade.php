@extends('layouts.base')

@section('title')
    <title>Woza::Dashboard</title>
@endsection
<style>
    tbody .product-col {
    font-size: 100% !important;
}
</style>
@section('content')
<main class="main">
  
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                      <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                    <div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
                    <h2 class="side-menu-title bg-gray ls-n-25">Dashboard</h2>
                    <nav class="side-nav">
                        <ul class="menu menu-vertical sf-arrows" role="tablist">     
                            <li class="active"><a href="{{route('myorders')}}"><i class="fa fa-shopping-cart mr-2"></i> Orders</a></li>
                            <li>
                                <a class="nav-link" href="{{route('mybookings')}}" > <i class="fa fa-calendar fa-1x mr-2"></i>Bookings</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('myaddress')}}"> <i class="fa fa-address-card mr-2"></i> Addresses</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('myaccount')}}"> <i class="fa fa-user mr-2"></i> Account Details</a>
                            </li>
                            <li>
                                <a class="nav-link"  href="{{route('changepassword')}}"> <div class="fa fa-key mr-2"></div> Change Password</a>
                            </li>
                            
                        </ul>
                    </nav>
                </div><!-- End .side-menu-container -->
               
            </aside><!-- End .col-lg-3 -->
                    <div class="col-md-9 col-lg-9">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $item)
                                {{$item}} <br>
                            @endforeach
                        </div>
                        @endif
                      
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <div class="product-size-content">
                                    <div class="container">
                                        <table class="table table-size" >
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Shop</th>
                                                    <th>amount (Kshs)</th>
                                                    <th>Order Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $item)
                                                <tr>
                                                    <td class="product-col ">
                                                        {{$item->id}}         
                                                    </td>
                                                    <td class="product-col">
                                                        <a href="{{route('products.shop',$item->business_id)}}">{{$item->shop->title}}</a>
                                                    </td>
                                                    <td class="product-col"> {{$item->amount}}</td>
                                                    <td class="product-col">
                                                        <span class="{{$item->status==0 ? 'text-primary':($item->status==1 ? 'text-info':($item->status==2 ? 'text-danger':($item->status==3 ? 'text-danger':($item->status==4 ? 'text-warning':($item->status==5 ? 'text-warning':'text-success')))))}}">{{$item->status==0 ? 'Pending':($item->status==1 ? 'Processing':($item->status==2 ? 'Canceled by You':($item->status==3 ? 'Canceled by shop':($item->status==4 ? 'On delivery':($item->status==5 ? 'Delivered':'Completed')))))}}</span></td>
                                                    <td class="product-col">
                                                        <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-list-alt"></i>Select Options
                                                        </button>
                                                        @if ($item->status==0 ||$item->status==1||$item->status==4||$item->status==5)
                                                        <div class="dropdown-menu">
                                                           
                                                                <a class="dropdown-item btn btn-danger text-danger" href="{{route('cancel',$item->id)}}">Cancel Order</a>
                                                           
                                                          </div>
                                                          @endif
                                                        </div>
                                                    </td>
                                            
                                                </tr>
                                                @empty
                                                <td>
                                                    <p>No order has been made yet.</p>
                                                <a href="/" class="btn btn-primary"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                                                @endforelse
                                                </td>
                                            </tbody>
                                        </table><!-- End .table table-wishlist -->
                                        {{$orders->links()}}
                                
                                    </div><!-- End .container -->
                                </div>
                               
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection