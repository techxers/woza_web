@extends('layouts.base')

@section('title')
    <title>Checkout</title>
@endsection

@section('content')
    
		<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Checkout</li>
					</ol>
				</div><!-- End .container -->
			</nav>

			<div class="container">
                <ul class="checkout-progress-bar">
                    <li >
                        <span>Shipping</span>
                    </li>
                    <li class="active">
                        <span>Payments Confirmation &amp; Checkout </span>
                    </li>
                </ul>
				<div class="row">
					

					<div class="col-lg-8 order-lg-first">
					
						<div class="checkout-payment">
							<h2 class="step-title"> Payment Method: {{$data[7]=='mpesa' ? 'Mpesa' :' Cash'}} </h2>

						
								<form id="confirm-order" action="{{route('placeorder')}}" method="POST">
									@csrf
									
									@if ($data[7]=='mpesa')
									<h4>Confirm Payment</h4>
									<label >Enter confirmation code received from Mpesa to complete payments</label>
									<div id="new-checkout-address" class="show">
									<div class="form-group required-field">
										<label>Code </label>
										<input type="text" value="{{old('code')}}" name="code" class="form-control" required>
									</div><!-- End .form-group -->
								</form>
							</div><!-- End #new-checkout-address -->

							
						</div><!-- End .checkout-payment -->
						@else<div class="checkout-payment">
						
									<h5 >Please make payments for your after delivery</h5>
							
						</div><!-- End .checkout-payment -->	
						@endif
						<div class="clearfix">
							<button form="confirm-order" type="submit" class="btn btn-primary float-left">Place Order</button>
						</div><!-- End .clearfix -->
						
					</div><!-- End .col-lg-8 -->
				</div><!-- End .row -->
			</div><!-- End .container -->

			<div class="mb-6"></div><!-- margin -->
		</main><!-- End .main -->
@endsection