@extends('layouts.partner')

@section('title')
<title>Business Profile</title>
@endsection

@section('content')
           <!-- MAIN CONTENT-->
           <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $item)
                                {{$item}}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('partner.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Business </strong>
                                        <small> Profile</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="business" class=" form-control-label">Business Name</label>
                                            <input type="text" id="business" name="title" value="{{old('title')}}" placeholder="Enter your business name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Description</label>
                                            <input type="text" id="vat" name="description" placeholder="Enter a brief description about your business" value="{{old('description')}}" class="form-control">
                                        </div>
                                        <label for="">Business Contact</label>
                                        <div class="row form-group">
                                            
                                            <div class="col-md-3">
                                                <select name="country_code" id="" class="form-control" >
                                                    @foreach ($countries as $item)
                                                        <option style="padding-right:20px" value="{{$item ->phonecode}}" {{$item ->phonecode==254 ? 'selected':''}} > +{{$item ->phonecode.' '.$item->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="singin-email" name="contact" placeholder="Business contact" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">Email</label>
                                                    <input type="email" name="email" id="city" placeholder="Enter your business email address"value="{{old('email')}}"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address" class=" form-control-label">Address</label>
                                                    <input type="text" id="address" name="address" placeholder="Type to select address" value="{{old('address')}}"  class="form-control">
                                                </div>
                                            </div>
                                                <input type="hidden" name="latitude" id="latitude" value=""  class="form-control">
                                                <input type="hidden" name="longitude" id="longitude" value=""  class="form-control">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Pricing</label>
                                                    <input type="number" name="pricing" id="postal-code" placeholder="Pricing for your services" value="{{old('pricing')}}"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Category</label>
                                            <select name="category" id=""  class="form-control">
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="open_time"  class=" form-control-label">Opening Time</label>
                                            <input type="time" id="open_time" name="open_time" placeholder="Opening time" value="{{old('open_time')}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="close_time"  class=" form-control-label">Closing Time</label>
                                            <input type="time" id="close_time" name="close_time" placeholder="Closing Time" value="{{old('close_time')}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="logo"  class=" form-control-label">Logo</label>
                                            <input type="file" id="logo" name="logo" placeholder="Country name" class="form-control">
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                <span id="payment-button-amount">Create Business Profile</span>
                                                
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
@endsection
