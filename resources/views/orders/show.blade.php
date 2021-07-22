@extends('layouts.partner')

@section('title')
<title>View Order</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <!-- TOP CAMPAIGN-->
                    <div class="top-campaign">
                        <h3 class="title-3 m-b-30">Order {{$order->id}} </h3>
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                    <tr>
                                        <th> User Name:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$order->name!=null ? $order->name : $order->user->fname.' '.$order->user->lname}}</td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$order->user->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Address:</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <td>{{$order->delivery_address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$order->created_at}}</td>
                                      
                                    </tr>
                                    <tr>
                                        <th>Order Items:</th>
                                        <td>Item</td>
                                                <td>Quantity</td>
                                                <td>Price</td>
                                      
                                        <td>
                                        
                                            @foreach ($order->orderitems as $item)
                                        
                                           <tr class="p-5 pl-5">
                                            <td></td>
                                            <td >{{$item->product->name}}</td>
                                            <td>{{$order->orderitems->count()}}</td>
                                            <td>{{$item->unit_price}}</td>
                                            
                                           </tr>
                                               
                                            
                                            @endforeach
                                    
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="{{$order->status==0 ? 'text-primary':($order->status==1 ? 'text-info':($order->status==2 ? 'text-danger':($order->status==3 ? 'text-danger':($order->status==4 ? 'text-warning':($order->status==5 ? 'text-warning':'text-success')))))}}">{{$order->status==0 ? 'Pending':($order->status==1 ? 'Accepted': ($order->status==2 ? 'Canceled (User)':($order->status==3 ? 'Canceled (Shop)':($order->status==4 ? 'On Delivery':($order->status==5 ? 'Delivered': 'Paid')))))}}</span>
                                        </td>
                                    </tr>
                                    @if ($order->bodaid!=null)
                                        <tr>
                                            <th>Boda:</th>
                                            <td>{{$order->boda->fname.' '.$order->boda->lname}}  </td>
                                            <td>{{$order->boda->mobile}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Total Amount:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$order->amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--  END TOP CAMPAIGN-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
