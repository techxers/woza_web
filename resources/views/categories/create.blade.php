@extends('layouts.partner')

@section('title')
<title>Add Category</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Details</h3>
                            </div>
                            <hr>
                            <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="control-label mb-1">Title</label>
                                    <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title')}}">
                                </div>
                                <div class="form-group has-success">
                                    <label for="description" class="control-label mb-1">Description</label>
                                    <input id="description" name="description" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the description"
                                        autocomplete="cc-name" value="{{old('description')}}" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="0">Service</option>
                                        <option value="1">Product</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="icon" class="control-label mb-1">Icon</label>
                                    <input id="icon" name="icon" type="file" class="form-control cc-number identified visa" value="" data-val="true"
                                        data-val-required="Please select an image icon" data-val-cc-number="Please select an image icon"
                                        autocomplete="cc-number">
                                    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                </div>
                               
                                <div>
                                    <button  type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-plus fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Add Category</span>
                                        <span id="payment-button-sending" style="display:none;">Adding…</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
