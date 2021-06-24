@extends('layouts.main')
<title>View Service</title>
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Bookings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false">Change Password</a>
                            </li>
        
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <div class="page-content">
                                    <div class="container">
                                        <table class="table table-wishlist table-mobile">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Stock Status</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                    
                                            <tbody>
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img src="assets/images/products/table/product-1.jpg" alt="Product image">
                                                                </a>
                                                            </figure>
                    
                                                            <h3 class="product-title">
                                                                <a href="#">Beige knitted elastic runner shoes</a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    <td class="price-col">$84.00</td>
                                                    <td class="stock-col"><span class="in-stock">In stock</span></td>
                                                    <td class="action-col">
                                                        <div class="dropdown">
                                                        <button class="btn btn-block btn-outline-primary-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-list-alt"></i>Select Options
                                                        </button>
                    
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">First option</a>
                                                            <a class="dropdown-item" href="#">Another option</a>
                                                            <a class="dropdown-item" href="#">The best option</a>
                                                          </div>
                                                        </div>
                                                    </td>
                                                    <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                                                </tr>
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img src="assets/images/products/table/product-2.jpg" alt="Product image">
                                                                </a>
                                                            </figure>
                    
                                                            <h3 class="product-title">
                                                                <a href="#">Blue utility pinafore denim dress</a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    <td class="price-col">$76.00</td>
                                                    <td class="stock-col"><span class="in-stock">In stock</span></td>
                                                    <td class="action-col">
                                                        <button class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</button>
                                                    </td>
                                                    <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                                                </tr>
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img src="assets/images/products/table/product-3.jpg" alt="Product image">
                                                                </a>
                                                            </figure>
                    
                                                            <h3 class="product-title">
                                                                <a href="#">Orange saddle lock front chain cross body bag</a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    <td class="price-col">$52.00</td>
                                                    <td class="stock-col"><span class="out-of-stock">Out of stock</span></td>
                                                    <td class="action-col">
                                                        <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                                                    </td>
                                                    <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table><!-- End .table table-wishlist -->
                                        <div class="wishlist-share">
                                            <div class="social-icons social-icons-sm mb-2">
                                                <label class="social-label">Share on:</label>
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                                <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </div><!-- End .wishlist-share -->
                                    </div><!-- End .container -->
                                </div>
                                <p>No order has been made yet.</p>
                                <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                <p>No booking made available yet.</p>
                                <a href="category.html" class="btn btn-outline-primary-2"><span>BOOK SERVICE</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Delivery Address</h3><!-- End .card-title -->

                                                <p>You have not set up this type of address yet.<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a></p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Phone Number *</label>
                                    <input type="text" class="form-control" required>
                                   

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" required>

                                  

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-password-link">
                                <form action="#">
                                    <label>Current password </label>
                                    <input type="password" class="form-control">

                                    <label>New password </label>
                                    <input type="password" class="form-control">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2">

                                    <button type="submit" class="btn btn-outline-primary-2">
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