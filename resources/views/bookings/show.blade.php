@extends('layouts.partner')

@section('title')
<title>View Booking</title>
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
                        <h3 class="title-3 m-b-30">booking {{$booking->id}} </h3>
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                    <tr>
                                        <th> Booker Name:</th>
            
                                        <td>{{ $booking->booker->fname.' '.$booking->booker->lname}}</td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number:</th>
                                      
                                        <td>{{$booking->booker->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Service Date:</th>
                                            
                                        <td>{{$booking->service_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>Service Time:</th>
                                       
                                        <td>{{$booking->service_date}}</td>
                                      
                                    </tr>
                                    <tr>
                                        <th>Category:</th>
                                        <td>{{$booking->category}}</td>
                                    </tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td>{{$booking->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="{{$booking->status==0 ? 'text-primary':($booking->status==1 ? 'text-warning':($booking->status==2 ? 'text-danger': 'text-success'))}}">{{$booking->status==0 ? 'Pending':($booking->status==1 ? 'Accepted': ($booking->status==2 ? 'Canceled':'Completed'))}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Charges:</th>
                                        <td>{{$booking->amount}}</td>
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
