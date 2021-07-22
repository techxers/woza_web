@extends('layouts.base')
<title>About Us</title>
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us </li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <h2 class="title text-center mb-2">Who We Are</h2><!-- End .title text-center mb-2 -->
                        <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, uctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. </p>
                        
                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-puzzle-piece"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Design Quality</h3><!-- End .icon-box-title -->
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero <br>eu augue.</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-life-ring"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->
                            <p>Praesent dapibus, neque id cursus faucibus, <br>tortor neque egestas augue, eu vulputate <br>magna eros eu erat. </p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-heart-o"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Made With Love</h3><!-- End .icon-box-title -->
                            <p>Pellentesque a diam sit amet mi ullamcorper <br>vehicula. Nullam quis massa sit amet <br>nibh viverra malesuada.</p> 
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->

        <div class="bg-image pt-7 pb-5 pt-md-12 pb-md-9" style="background-image: url(assets/images/backgrounds/bg-4.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="count-container text-center">
                            <div class="count-wrapper text-white">
                                <span class="count" data-from="0" data-to="{{$customers}}" data-speed="3000" data-refresh-interval="50">{{$customers}}</span>+
                            </div><!-- End .count-wrapper -->
                            <h3 class="count-title text-white">Happy Customers</h3><!-- End .count-title -->
                        </div><!-- End .count-container -->
                    </div><!-- End .col-6 col-md-3 -->

                    <div class="col-6 col-md-3">
                        <div class="count-container text-center">
                            <div class="count-wrapper text-white">
                                <span class="count" data-from="0" data-to="{{$partners}}" data-speed="3000" data-refresh-interval="50">{{$partners}}</span>+
                            </div><!-- End .count-wrapper -->
                            <h3 class="count-title text-white">Successful Partners</h3><!-- End .count-title -->
                        </div><!-- End .count-container -->
                    </div><!-- End .col-6 col-md-3 -->

                    <div class="col-6 col-md-3">
                        <div class="count-container text-center">
                            <div class="count-wrapper text-white">
                                <span class="count" data-from="0" data-to="{{$bookings}}" data-speed="3000" data-refresh-interval="50">{{$bookings}}</span>+
                            </div><!-- End .count-wrapper -->
                            <h3 class="count-title text-white">Services Offered</h3><!-- End .count-title -->
                        </div><!-- End .count-container -->
                    </div><!-- End .col-6 col-md-3 -->

                    <div class="col-6 col-md-3">
                        <div class="count-container text-center">
                            <div class="count-wrapper text-white">
                                <span class="count" data-from="0" data-to="{{$products}}" data-speed="3000" data-refresh-interval="50">{{$products}}</span>
                            </div><!-- End .count-wrapper -->
                            <h3 class="count-title text-white">Products Sold</h3><!-- End .count-title -->
                        </div><!-- End .count-container -->
                    </div><!-- End .col-6 col-md-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .bg-image pt-8 pb-8 -->

       

        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="brands-text text-center mx-auto mb-6">
                        <h2 class="title">Become a Woza Partner.</h2><!-- End .title -->
                        <p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nis</p>
                    </div><!-- End .brands-text -->
                </div><!-- End .col-lg-10 offset-lg-1 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection