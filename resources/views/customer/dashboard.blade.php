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
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                            <li class="active"><a href="/"><i class="fa fa-shopping-cart mr-2"></i> Orders</a></li>
                            <li>
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false"> <i class="fa fa-calendar fa-1x mr-2"></i>Bookings</a>
                            </li>
                            <li>
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false"> <i class="fa fa-address-card mr-2"></i> Addresses</a>
                            </li>
                            <li>
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false"> <i class="fa fa-user mr-2"></i> Account Details</a>
                            </li>
                            <li>
                                <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false"> <div class="fa fa-key mr-2"></div> Change Password</a>
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
                                <div class="page-content">
                                    <div class="container">
                                        <table class="table table-wishlist table-mobile">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Shop Name</th>
                                                    <th>Total Price</th>
                                                    <th>Order Status</th>
                                                    <th></th>
                                                    <th></th>
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
                                                    <td class="product-col">Kshs {{$item->amount}}</td>
                                                    <td class="product-col">
                                                        <span class="{{$item->status==0 ? 'text-primary':($item->status==1 ? 'text-info':($item->status==2 ? 'text-danger':($item->status==3 ? 'text-danger':($item->status==4 ? 'text-warning':($item->status==5 ? 'text-warning':'text-success')))))}}">{{$item->status==0 ? 'Pending':($item->status==1 ? 'Processing':($item->status==2 ? 'Canceled by You':($item->status==3 ? 'Canceled by shop':($item->status==4 ? 'On delivery':($item->status==5 ? 'Delivered':'Completed')))))}}</span></td>
                                                    <td class="product-col">
                                                        <div class="dropdown">
                                                        <button class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-list-alt"></i>Select Options
                                                        </button>
                                                        @if ($item->status==0 ||$item->status==1||$item->status==4||$item->status==5)
                                                        <div class="dropdown-menu">
                                                           
                                                                <a class="dropdown-item text-danger h6 pt-5" href="{{route('cancel',$item->id)}}">Cancel Order</a>
                                                           
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

                            <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                <div class="page-content">
                                    <div class="container">
                                        <table class="table table-wishlist table-mobile">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Service Provider </th>
                                                    <th>Service Date</th>
                                                    <th>Order Status</th>
                                                    <th></th>
                                                    <th></th>
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
                                                        <button class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-list-alt"></i>Select Options
                                                        </button>
                                                        @if ($item->status==0 ||$item->status==1||$item->status==4||$item->status==5)
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item btn text-primary h6 " href="{{route('booking.reschedule',$item->id)}}">Reschedule</a>
                                                            <a class="dropdown-item btn text-danger h6  " href="{{route('booking.cancel',$item->id)}}">Cancel Booking</a>
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

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="card card-dashboard">
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

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" name="fname" value="{{Auth::user()->fname}}" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="lname" value="{{Auth::user()->lname}}" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Phone Number *</label>
                                    <input type="text" class="form-control" name="phone" value="{{Auth::user()->mobile}}" required>
                                    <label>Email address *</label>
                                    <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" required>
                                   <div class="row">
                                        <div class="col-sm-6">
                                        <label>Profile Photo </label>
                                        <input type="file" class="form-control" name="photo">
                                        </div>
                                    </div>
                                    
                                  

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-password-link">
                                <form action="{{route('password.change')}}" method="POST">
                                   @csrf
                                    <label>Old password </label>
                                    <input type="password" class="form-control" name="old">

                                    <label>New password </label>
                                    <input type="password" class="form-control" name="password">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2" name="password_confirmation">

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