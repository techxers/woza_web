@extends('layouts.base')

@section('title')
    <title>Checkout</title>
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <ul class="checkout-progress-bar">
            <li class="active">
                <span>Shipping</span>
            </li>
            <li>
                <span>Payments Confirmation &amp; Checkout </span>
            </li>
        </ul>
        <div class="row">
            <div class="col-lg-8">
                <ul class="checkout-steps">
                    <form action="{{route('confirm')}}" id="confirm" method="POST">
                        @csrf
                    <li>
                        <h2 class="step-title">Shipping Details</h2>
                            <div class="form-group required-field">
                                <label>First Name </label>
                                <input type="text" class="form-control" name="fname"  value="{{Auth::user()->fname}}" required>
                            </div><!-- End .form-group -->
                            <div class="form-group required-field">
                                <label>Last Name </label>
                                <input type="text" class="form-control" name="lname"  value="{{Auth::user()->lname}}" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Delivery Address </label> <a href="#" data-toggle="modal" data-target="#address">Select your address</a>
                                <input type="text" name="address"  value="{{Cookie::get('name')}}" class="form-control">
                            </div><!-- End .form-group -->

                            <div class="form-group ">
                                <label>Street Address </label>
                                <input type="text" name="street" placeholder="street name, House Number" class="form-control">
                               
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Phone  </label>
                                <input type="text" class="form-control" name="phone" value="{{Auth::user()->mobile}}" required>
                            </div><!-- End .form-group -->
                      
                    </li>

                    <li>
                        <div class="checkout-step-shipping">
                            <h2 class="step-title">Payment Methods</h2>

                            <table class="table table-step-shipping">
                                <div class="form-group required-field">
                                    <label>Total Amount  </label>
                                    <input type="text" class="form-control" name="amount" readonly value="Kshs {{$totalPrice}}" required>
                                </div><!-- End .form-group -->
                                
                                <tbody>
                                    @if ($business->paymenttype!=null)
                                        
                                 
                                    @if ($business->paymenttype->cash==true)
                                        <tr>
                                            <td><input type="radio" name="payment_method" value="cash"></td>
                                            <td><strong>Cash</strong></td>
                                            <td>Pay Cash on Delivery</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if ($business->paymenttype->mpesa==true)
                                    <tr>
                                        <td><input type="radio" name="payment_method" value="mpesa"></td>
                                        <td><strong>Mpesa</strong></td>
                                        <td>{{$business->paymenttype->mpesa_type=='phone' ? 'Mpesa Direct' :($business->paymenttype->mpesa_type=='paybill' ? 'Paybill ' : 'Till')}}</td>
                                        <td> {{$business->paymenttype->mpesa_type=='phone' ? 'Phone Number: '.$business->paymenttype->phone :($business->paymenttype->mpesa_type=='paybill' ? 'Business Number:'.$business->paymenttype->paybill: 'Till Number: '.$business->paymenttype->till)}}</td>
                                        @if ($business->paymenttype->mpesa_type=='paybill')
                                            <td>{{'Account Number:  '.$business->paymenttype->account_number}}</td>
                                        @endif 
                                    </tr>
                                    @endif
                                    @else
                                    <tr>
                                        <td><input type="radio" name="payment_method" value="cash"></td>
                                        <td><strong>Cash</strong></td>
                                        <td>Pay Cash on Delivery</td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- End .checkout-step-shipping -->
                    </li>
                </form>
                </ul>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">{{ Session::get('cart')->totalQty}} products in Cart</a>
                    </h4>

                    <div class="collapse" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>
                                @foreach ($products as $item)
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{asset('images/products/'.$item['item']['image'])}}" alt="product">
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="product.html"> {{$item['item']['name']}}</a>
                                            </h2>

                                            <span class="product-qty">Qty:{{$item['qty']}}</span>
                                        </div>
                                    </td>
                                    <td class="price-col">Kshs {{$item['item']['selling_price']}}</td>
                                </tr>
                                @endforeach
                            </tbody>	
                        </table>
                    </div><!-- End #order-cart-section -->
                </div><!-- End .order-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-steps-action">
                    <button form="confirm" class="btn btn-primary float-right">NEXT</button>
                </div><!-- End .checkout-steps-action -->
            </div><!-- End .col-lg-8 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->
@endsection