@extends('layouts.partner')

@section('title')
<title>Profile</title>
@endsection

@section('content')
           <!-- MAIN CONTENT-->
           <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title mb-3">Profile</strong>
                                </div>
                                <div class="card-body ">
                                    <div class="mx-auto d-block w-50">
                                        @if (Auth::user()->profile_image==null||Auth::user()->profile_image=='-')
                                           <div class="mx-auto w-25" ><i class="fa fa-user fa-3x"></i></div>
                                        @else
                                        <img  class="rounded-circle mx-auto d-block w-25" src="{{asset('images/profile/'.Auth::user()->profile_image)}}" alt="Card image cap">
                                        @endif
                                        
                                        <h5 class="text-sm-center mt-2 mb-1">{{Auth::user()->fname.' '.Auth::user()->lname}}</h5>
                                        <div class="location text-sm-center">
                                            <i class="fa fa-warehouse mr-3"> </i>{{Auth::user()->business->title}}</div>
                                    </div>
                                    <hr>
                                    <div class="card-text text-sm-center">
                                        <a href="#">
                                            <span class="mr-2"><i class="fa fa-phone pr-1"></i>{{Auth::user()->mobile}}</span>
                                        </a>
                                        <a href="#">
                                            <span class="mr-2"><i class="zmdi zmdi-email pr-1"></i>{{Auth::user()->email}}</span>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin pr-1"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pinterest pr-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           
                            <div class="card">
                                <div class="card-header">Account Profile</div>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update Profile</h3>
                                    </div>
                                    <hr>
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                       {{session('success')}}
                                    </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $item)
                                                {{$item}}<br>
                                            @endforeach
                                        </div>
                                    @endif
                                    <form action="{{route('partner.update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">First Name</label>
                                                    <input id="cc-exp" name="fname" type="text" class="form-control cc-exp" value="{{Auth::user()->fname}}" data-val="true" data-val-required="Please enter the card expiration"
                                                        data-val-cc-exp="Please enter a valid month and year" placeholder="First Name"
                                                        autocomplete="cc-exp">
                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Last Name</label>
                                                <div class="input-group">
                                                    <input id="x_card_code" name="lname" type="text" class="form-control cc-cvc" value="{{Auth::user()->lname}}" data-val="true" data-val-required="Please enter the security code"
                                                        data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control" aria-required="true" aria-invalid="false" value="{{Auth::user()->email}}">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label mb-1">Phone Number</label>
                                            <input id="cc-name" name="mobile" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter your mobile number"
                                                autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" value="{{Auth::user()->mobile}}">
                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-number" class="control-label mb-1">Profile Image</label>
                                            <input id="cc-number" name="photo" type="file" class="form-control cc-number identified visa" value="" data-val="true"
                                                data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                autocomplete="cc-number">
                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                       
                                        <div>
                                            <button id="payment-button-3" type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                <span id="update">Update Account Profile</span>
                        
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <form action="{{route('business.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Business </strong>
                                        <small> Profile</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="business" class=" form-control-label">Business Name</label>
                                            <input type="text" id="business" name="title" value="{{old('title') ? old('title') : $business->title}}" placeholder="Enter your business name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Description</label>
                                            <input type="text" id="vat" name="description" placeholder="Enter a brief description about your business" value="{{old('description') ? old('description'): $business->description}}" class="form-control">
                                        </div>
                                        <label for="">Business Contact</label>
                                        <div class="row form-group">
                                            
                                            <div class="col-md-3">
                                                <select name="country_code" id="" class="form-control" >
                                                    @foreach ($countries as $item)
                                                        <option style="padding-right:20px"  value="{{$item ->phonecode}}" {{$item->phonecode==$business->countrycode ? 'selected':''}} > +{{$item ->phonecode.' '.$item->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{old('contact') ? old('contact') : $business->contact }}" id="singin-email" name="contact" placeholder="Business contact" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">Email</label>
                                                    <input type="email" name="email" id="city" placeholder="Enter your business email address"value="{{old('email') ? old('email') : $business->email}}"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address" class=" form-control-label">Address</label>
                                                    <input type="text" id="address" name="address" placeholder="Type to select address" value="{{old('address') ? old('address') : $business->address}}"  class="form-control">
                                                </div>
                                            </div>
                                                <input type="hidden" name="latitude" id="latitude" value="{{old('latitude') ? old('latitude') : $business->latitude}} "  class="form-control">
                                                <input type="hidden" name="longitude" id="longitude" value="{{old('longitude') ? old('longitude') : $business->longitude}} "  class="form-control">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Pricing</label>
                                                    <input type="number" name="pricing" id="postal-code" placeholder="Pricing for your services" value="{{old('pricing') ? old('pricing'): $business->pricing}}"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Category</label>
                                            <select name="category" id=""  class="form-control">
                                                @foreach ($categories as $item)
                                                    <option {{$business->category_id==$item->id ? 'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="open_time"  class=" form-control-label">Opening Time</label>
                                            <input type="time" id="open_time" name="open_time" placeholder="Opening time" value="{{old('open_time') ? old('open_time') : $business->open_time}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="close_time"  class=" form-control-label">Closing Time</label>
                                            <input type="time" id="close_time" name="close_time" placeholder="Closing Time" value="{{old('close_time') ? old('close_time') : $business->close_time}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="logo"  class=" form-control-label">Logo</label>
                                            <input type="file" id="logo" name="logo" placeholder="Country name" class="form-control">
                                        </div>
                                        <div>
                                            <button  type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                <span id="payment-button-amount">Update Business Profile</span>
                                                
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Payment</strong> Methods
                                </div>
                                <div class="card-body card-block">
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{session('error')}}
                                        </div> 
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $item)
                                                {{$item}}<br>
                                            @endforeach
                                        </div> 
                                    @endif
                                    
                                    <form id="paymentmethods" action="{{route('payments.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">Payment Methods</label>
                                            </div>
                                           
                                            <div class="col col-md-9">
                                                <div class="form-check">
                                                    <div class="checkbox">
                                                        <label for="checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="checkbox1" {{$business->paymenttype->cash==true ? 'checked':''}} name="cashmethod" value="cash" class="form-check-input">Cash
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label for="checkbox2" class="form-check-label ">
                                                            <input type="checkbox" id="mpesacheck" name="mpesamethod" {{$business->paymenttype->mpesa==true ? 'checked':''}} value="mpesa" class="form-check-input" onchange="valueChanged()"> M-Pesa
                                                        </label>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="mpesa" style="display: {{$business->paymenttype->mpesa==false ? 'none':''}}">
                                            <div class="col col-md-3">
                                                <label for="select" class=" form-control-label">M-Pesa Method</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <select name="mpesatype" id="select" class="form-control">
                                                    <option value="0">Please select</option>
                                                    <option value="1"  {{$business->paymenttype->mpesa_type=='phone'? 'selected':''}}>Direct to Phone</option>
                                                    <option value="2" {{$business->paymenttype->mpesa_type=='paybill'? 'selected':''}}>Paybill</option>
                                                    <option value="3" {{$business->paymenttype->mpesa_type=='till'? 'selected':''}}>Till Number</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="phone" style="display: {{$business->paymenttype->phone==null ? 'none':''}}">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Direct to Phone</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="text-input" value="{{old('phone') ? old('phone') : $business->paymenttype->phone}}" name="phone" placeholder="Phone Number" class="form-control">
                                                <small class="form-text text-muted">Enter the phone number you will be receiving payments</small>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="paybill" style="display: {{$business->paymenttype->paybill==null ? 'none':''}}">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label">Paybill</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="email-input" value="{{old('paybill') ? old('paybill') : $business->paymenttype->paybill}}" name="paybill" placeholder="Enter Paybill" class="form-control">
                                                
                                            </div>
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label">Account Number</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="email-input" name="account" value="{{old('paybill') ? old('paybill') : $business->paymenttype->account_number}}" placeholder="Enter Account Number" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group" id="till" style="display: {{$business->paymenttype->till==null ? 'none':''}}">
                                            <div class="col col-md-3">
                                                <label for="password-input" class=" form-control-label">Till Number</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="number" id="password-input" value="{{old('till') ? old('till') : $business->paymenttype->till}}" name="till" placeholder="Enter Till Number" class="form-control">
                                                <small class="help-block form-text">Enter your till number</small>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" form="paymentmethods" class="btn btn-primary ">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            function valueChanged()
            {
                if($('#mpesacheck').is(":checked"))   
                    $("#mpesa").show();
                else
                    $("#mpesa").hide();
            }
        
            $("#select").change(function(){
            if($(this).val()==0)
            {    
                $("#phone").hide();
                        $("#paybill").hide();
                        $("#till").hide();
            }
            if($(this).val()==1)
            {    
                $("#phone").show();
                $("#paybill").hide();
                $("#till").hide();
            }
            if($(this).val()==2){
                $("#phone").hide();
                $("#paybill").show();
                $("#till").hide();
            } 
            if($(this).val()==3){
                $("#phone").hide();
                $("#paybill").hide();
                $("#till").show();
            } 
            
            });
                    
    </script>
@endsection
