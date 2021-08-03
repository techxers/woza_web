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
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                            <li >
                                <a class="nav-link" href="{{route('myaddress')}}"> <i class="fa fa-address-card mr-2"></i> Addresses</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('myaccount')}}"> <i class="fa fa-user mr-2"></i> Account Details</a>
                            </li>
                            <li class="active">
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
                            <div class="tab-pane fade show active" id="tab-password" role="tabpanel" aria-labelledby="tab-password-link">
                                <form action="{{route('password.change')}}" method="POST">
                                   @csrf
                                    <label>Old password </label>
                                    <input type="password" class="form-control" name="old">

                                    <label>New password </label>
                                    <input type="password" class="form-control" name="password">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2" name="password_confirmation">

                                    <button type="submit" class="btn btn-primary">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection