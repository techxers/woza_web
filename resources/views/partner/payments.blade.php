@extends('layouts.partner')

@section('title')
<title>Payments </title>
@endsection
<style>
    #mpesa,#phone,#till,#paybill{
        display: none;
    }
</style>
@section('content')
           <!-- MAIN CONTENT-->
           <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
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
                                    
                                    <form id="paymentmethods" action="{{route('payments.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">Payment Methods</label>
                                            </div>
                                           
                                            <div class="col col-md-9">
                                                <div class="form-check">
                                                    <div class="checkbox">
                                                        <label for="checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="checkbox1" name="cashmethod" value="cash" class="form-check-input">Cash
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label for="checkbox2" class="form-check-label ">
                                                            <input type="checkbox" id="mpesacheck" name="mpesamethod" value="mpesa" class="form-check-input" onchange="valueChanged()"> M-Pesa
                                                        </label>
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row form-group" id="mpesa">
                                            <div class="col col-md-3">
                                                <label for="select" class=" form-control-label">M-Pesa Method</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <select name="mpesatype" id="select" class="form-control">
                                                    <option value="0">Please select</option>
                                                    <option value="1">Direct to Phone</option>
                                                    <option value="2">Paybill</option>
                                                    <option value="3">Till Number</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="phone">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Direct to Phone</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="text-input" name="phone" placeholder="Phone Number" class="form-control">
                                                <small class="form-text text-muted">Enter the phone number you will be receiving payments</small>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="paybill">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label">Paybill</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="email-input" name="paybill" placeholder="Enter Paybill" class="form-control">
                                             
                                            </div>
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label">Account Number</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="email-input" name="account" placeholder="Enter Account Number" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group" id="till">
                                            <div class="col col-md-3">
                                                <label for="password-input" class=" form-control-label">Till Number</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="number" id="password-input" name="till" placeholder="Enter Till Number" class="form-control">
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
