@extends('layouts.base')

@section('title')
    <title>Shopping Cart</title>
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        @if (Session::has('cart'))
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                <tr class="product-row">
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{asset('images/products/'.$item['item']['image'])}}" alt="product">
                                            </a>
                                        </figure>
                                        <h2 class="product-title">
                                            <a href="product.html">{{$item['item']['name']}}</a>
                                        </h2>
                                    </td>
                                    <td>Kshs {{$item['item']['selling_price']}}</td>
                                    <td>
                                        <input class="vertical-quantity form-control" readonly type="text" value=" {{$item['qty']}} ">
                                    </td>
                                    <td>Kshs {{$item['price']}}</td>
                                </tr>
                                <tr class="product-action-row">
                                    <td colspan="4" class="clearfix">
                                        <div class="float-left">
                                            
                                        </div><!-- End .float-left -->
                                        
                                        <div class="float-right">
                                            <a href="{{route('reduce',$item['item']['id'])}}" title="Edit product" class="btn-remove"><i class="icon-pencil mr-2"></i><span class=" mr-3" >Reduce </span></a>
                                            <a href="{{route('remove',$item['item']['id'])}}" title="Remove product" class="btn-remove"><i class="fa fa-trash mr-2"></i><span >Remove </span></a>
                                        </div><!-- End .float-right -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4" class="clearfix">
                                        <div class="float-left">
                                            <a href="category.html" class="btn btn-outline-secondary">Continue Shopping</a>
                                        </div><!-- End .float-left -->

                                        <div class="float-right">
                                            <a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                            <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>
                                        </div><!-- End .float-right -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>Summary</h3>
                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>Kshs {{$totalPrice}}</td>
                                </tr>

                                <tr>
                                    <?php $fee=0;
                                        foreach ($products as $item)
                                        {
                                            $fee+=$item['item']['shipping_charge'];
                                        }
                                        ?>
                                    <td>Delivery Fee</td>
                                    <td>Kshs {{$fee}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Order Total</td>
                                    <td>Kshs {{$fee + $totalPrice}}</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            @auth
                            <a href="{{route('checkout')}}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                            @endauth
                            @guest
                            <a href="{{route('signin')}}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                            @endguest
                           
                        </div><!-- End .checkout-methods -->
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        @else
            <div class="p-5 align-center">
                <p class="mb-3">You have no items in the cart</p>
                <a href="/" class="btn btn-sm btn-primary">Go to Shopping</a>
            </div>
        @endif
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->
@endsection