@extends('layouts.main')
<title> Cart</title>
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if (Session::has('cart'))
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach ($products as $item)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{asset('images/products/'.$item['item']['image'])}}" alt="Product image">
                                                    </a>
                                                </figure>
    
                                                <h3 class="product-title">
                                                    <a href="#">{{$item['item']['name']}}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">Kshs {{$item['item']['selling_price']}}</td>
                                        <td class="quantity-col">
                                                {{$item['qty']}}  
                                            <!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="total-col">Kshs {{$item['price']}}</td>
                                        <td class="remove-col"><a href="{{route('reduce',$item['item']['id'])}}" class="btn-remove"><i class="fa fa-minus"></i></a></td>
                                        <td class="remove-col"><a href="{{route('remove',$item['item']['id'])}}"  class="btn-remove"><i class="icon-close"></i></a></td>
                                        
                                    </tr>    
                                    @endforeach
                                @else
                                    <div class="ml-5">
                                        <p>No Items in the cart </p>
                                        <a href="/" class="btn btn-success btn-order mt-3">Go Shopping</a>
                                    </div>                                       
                                @endif
                               
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        @if (Session::has('cart'))
                        <div class="summary summary-cart">
                         
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
                            <table class="table table-summary">
                                <tbody>
                                  
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>Kshs {{$totalPrice}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Delivery:</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $fee=0;
                                    foreach ($products as $item)
                                    {
                                        $fee+=$item['item']['shipping_charge'];
                                    }
                                   
                                    ?>
                                    <tr class="summary-shipping-row">
                                        <td>
                                            
                                       <small>Total Delivery Fee</small> 
                                            
                                        </td>
                                        <td>Kshs {{$fee}}</td>
                                    </tr><!-- End .summary-shipping-row -->
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>Kshs {{$fee + $totalPrice}}</td>
                                    </tr><!-- End .summary-total -->
                                  
                                </tbody>
                            </table><!-- End .table table-summary -->
                            @guest
                            <a  href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            @endguest
                            @auth
                                <a href="{{route('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            @endauth
                        </div><!-- End .summary -->

                        <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        @endif
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection