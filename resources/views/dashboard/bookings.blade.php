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
                <li class="breadcrumb-item active" aria-current="page">My Bookings</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    {{-- <aside class="col-md-2 col-lg-2">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li> --}}
                            {{-- <li class="nav-item border border-primary border-5 rounded mb-1">
                                <a class="nav-link active" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false"><i class="fa fa-shopping-cart mr-2"></i> Orders</a>
                            </li>
                            <li class="nav-item border border-primary border-5 rounded mb-1">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false"> <i class="fa fa-calendar fa-1x mr-2"></i>Bookings</a>
                            </li>
                            <li class="nav-item border border-primary border-5 rounded mb-1">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false"> <i class="fa fa-address-card mr-2"></i> Addresses</a>
                            </li>
                            <li class="nav-item border border-primary border-5 rounded mb-1">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false"> <i class="fa fa-user mr-2"></i> Account Details</a>
                            </li>
                            <li class="nav-item border border-primary border-5 rounded mb-1">
                                <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false"> <div class="fa fa-key mr-2"></div> Change Password</a>
                            </li>
        
                        </ul>
                    </aside><!-- End .col-lg-3 --> --}}
                      <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                    <div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
                    <h2 class="side-menu-title bg-gray ls-n-25">Dashboard</h2>
                    <nav class="side-nav">
                        <ul class="menu menu-vertical sf-arrows" role="tablist">     
                            <li ><a href="{{route('myorders')}}"><i class="fa fa-shopping-cart mr-2"></i> Orders</a></li>
                            <li class="active">
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
                            <div class="tab-pane fade show active" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                <div class="page-content">
                                    <div class="container">
                                        <table class="table table-size table-mobile">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Service Provider </th>
                                                    <th>Service Date</th>
                                                    <th>Order Status</th>
                                                    <th>oPTIONS</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody>
                                                @forelse ($bookings as $item)
                                                <tr>
                                                    <td class="product-col">
                                                        {{$item->id}}         
                                                    </td>
                                                    <td class="product-col">
                                                        <a href="{{route('service',$item->service_provider_id)}}">{{$item->business->title}}</a>
                                                    </td>
                                                    <td class="product-col"> {{$item->service_date.' '.$item->service_time}}</td>
                                                    <td class="product-col"><span class="{{$item->status==0 ? 'text-primary':($item->status==1 ? 'text-warning':($item->status==2 ? 'text-danger':'text-success'))}}">
                                                        {{$item->status==0 ? 'Pending':($item->status==1 ? 'Accepted':($item->status==2 ? 'Canceled':'Completed'))}}</span></td>
                                                    <td class="product-col">
                                                        <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-list-alt"></i>Select Options
                                                        </button>
                                                        @if ($item->status==0 ||$item->status==1||$item->status==4||$item->status==5)
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item btn btn-success text-primary " href="{{route('booking.reschedule',$item->id)}}">Reschedule</a>
                                                            <a class="dropdown-item btn btn-danger text-danger  " href="{{route('booking.cancel',$item->id)}}">Cancel Booking</a>
                                                          </div>
                                                          @endif
                                                        </div>
                                                    </td>
                                            
                                                </tr>
                                                @empty
                                                <p>No booking made yet.</p>
                                                <a href="/" class="btn btn-outline-primary-2"><span>BOOK SERVICE</span><i class="icon-long-arrow-right"></i></a>
                                                @endforelse
                                               
                                            </tbody>
                                        </table><!-- End .table table-wishlist -->
                                        {{-- {{$bookings->links()}} --}}
                                    {{$bookings->links()}}
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