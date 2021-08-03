@extends('layouts.base')
<title>View Service</title>
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Book Service</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="light-title">Contact <strong>Details</strong></h2>

                    <div class="contact-info">
                        <div>
                            <i class="icon-phone"></i>
                            <p><a href="tel:">{{$service->contact}}</a></p>
                          
                        </div>
                        <div>
                            <i class="icon-location"></i>
                            <p><a href="tel:">{{$service->address}}</a></p>
                          
                        </div>
                        <div>
                            <i class="icon-mail-alt"></i>
                            <p><a href="mailto:#">{{$service->email}}</a></p>
                            
                        </div>
                       
                    </div><!-- End .contact-info -->
                </div><!-- End .col-md-4 -->
                <div class="col-lg-8">
                    <h2 class="title mb-1">Book Service</h2><!-- End .title mb-2 -->
                    <p class="mb-2">Enter the needed information to book your service</p>

                    <form action="{{route('confirmbooking',$service->id)}}" method="POST" class="contact-form mb-3">
                       @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="cname" class="">Service Date</label>
                                <input type="date" name="date" class="form-control" id="cname" placeholder="Name *" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-12">
                                <label for="cemail" class="">Service Time</label>
                                <input type="time" name="time" class="form-control" id="cemail" placeholder="Email *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="">Description</label>
                        <textarea name="description" class="form-control" cols="50" rows="4" id="cmessage" required placeholder="Service Description*"></textarea>
                        @guest
                        <a  href="{{route('signin')}}" class="btn btn-primary">
                            <span>Confirm Booking</span>
                            <i class="icon-long-arrow-right"></i></a>
                        @endguest
                        @auth
                        <button type="submit" class="btn btn-primary">
                            <span>Confirm Booking</span>
                            
                        </button>
                        @endauth
                      
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

            <div class="stores mb-4 mb-lg-5">
                <h2 class="title text-center mb-3">Service Location</h2><!-- End .title text-center mb-2 -->
            </div><!-- End .stores -->
        </div><!-- End .container -->
        <div id="map"></div><!-- End #map -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
    <script>
         const lat={{$service->latitude}};
       const long={{$service->longitude}};
       const name="{{$service->title}}";
        map = new google.maps.Map(document.getElementById('map'), {
            
  center: {lat: lat, lng: long},
  zoom: 15
});
const marker = new google.maps.Marker({
    position: {lat: lat, lng: long},
    map: map,
    title: name,
    type: "info",
  });
  
    </script>
@endsection