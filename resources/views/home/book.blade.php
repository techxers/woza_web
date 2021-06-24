@extends('layouts.main')
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
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">About Service</h2><!-- End .title mb-2 -->
                    <p class="mb-3">{{$service->description}}.</p>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>Contacts</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        {{$service->address}}
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:#">{{$service->contact}}</a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href="mailto:#">{{$service->email}}</a>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>Operating Hours</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Opening Time</span> <br>{{$service->open_time}} ET
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">Closing Time</span> <br>{{$service->open_time}} ET
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
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
                        <textarea name="description" class="form-control" cols="30" rows="4" id="cmessage" required placeholder="Service Description*"></textarea>
                        @guest
                        <a  href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>Confirm Booking</span>
                            <i class="icon-long-arrow-right"></i></a>
                        @endguest
                        @auth
                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>Confirm Booking</span>
                            <i class="icon-long-arrow-right"></i>
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