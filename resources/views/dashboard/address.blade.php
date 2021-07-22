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
                <li class="breadcrumb-item active" aria-current="page">Delivery Address</li>
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
                            <li ><a href="{{route('myorders')}}"><i class="fa fa-shopping-cart mr-2"></i> Orders</a></li>
                            <li>
                                <a class="nav-link" href="{{route('mybookings')}}" > <i class="fa fa-calendar fa-1x mr-2"></i>Bookings</a>
                            </li>
                            <li class="active">
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
                            <div class="tab-pane fade show active" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="card card-dashboard">
                                            <div class="card-header">
                                                Address
                                                <a href="#" class="card-edit">Edit</a>
                                            </div><!-- End .card-header -->
                                            <div class="card-body">
                                                <h3 class="card-title">Delivery Address</h3><!-- End .card-title -->
                                                @if ($address!=null)
                                                <p>{{$address->address}}</p>
                                                <a href="#address" data-toggle="modal">Edit <i class="icon-edit"></i></a></p>
                                                @else 
                                                    <p>You have not set up this type of address yet.<br>
                                                    <a href="#address" data-toggle="modal">Add <i class="icon-edit"></i></a></p>
                                                @endif    
                                               
                                                
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection