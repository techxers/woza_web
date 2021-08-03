@extends('layouts.partner')

@section('title')
<title>Edit Product</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Product</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">{{$product->name}}</h3>
                            </div>
                            <hr>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $item)
                                       <p> {{$item}} </p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Product Name</label>
                                    <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name') ? old('name'): $product->name}}">
                                </div>
                                <div class="form-group has-success">
                                    <label for="description" class="control-label mb-1">Product Description</label>
                                    <input id="description" name="description" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the description"
                                        autocomplete="cc-name" value="{{old('description') ? old('description'):$product->description}}" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="type">Product Category</label>
                                    <select name="category" id="type" class="form-control">
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}" {{$product->category_id == $item->id ? 'selected':' ' }}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="buying_price" class="control-label mb-1">Buying Price</label>
                                    <input id="buying_price" name="buying_price" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{old('buying_price') ? old('buying_price') : $product->purchase_price}}">
                                </div>
                                <div class="form-group has-success">
                                    <label for="selling_price" class="control-label mb-1">Selling Price</label>
                                    <input id="selling_price" name="selling_price" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the Selling Price"
                                        autocomplete="cc-name" value="{{old('selling_price') ? old('selling_price') : $product->selling_price}}" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="type">Product Unit</label>
                                    <select name="unit" id="type" class="form-control">
                                        <option value="piece" {{$product->selling_type=='piece' ? 'selected':''}}>Piece</option>
                                        <option value="kg" {{$product->selling_type=='kg' ? 'selected':''}}>Kilograms</option>
                                        <option value="litre" {{$product->selling_type=='litre' ? 'selected':''}}>Litres</option>
                                        <option value="gm" {{$product->selling_type=='gm' ? 'selected':''}}>Grams</option>
                                        <option value="ml" {{$product->selling_type=='ml' ? 'selected':''}}>Mili Litres</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="control-label mb-1">Product Quantity</label>
                                    <input id="quantity" name="quantity" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{old('quantity') ? old('quantity'):$product->qut}}">
                                </div>
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <input id="size" name="size" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{old('size') ? old('size'):($product->size==0 ? ' ':$product->size)}}">
                                </div>
                                <div class="form-group has-success">
                                    <label for="shipping_charge" class="control-label mb-1">Shipping Charge</label>
                                    <input id="shipping_charge" name="shipping_charge" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the shipping_charge"
                                        autocomplete="cc-name" value="{{old('shipping_charge') ? old('shipping_charge') : $product->shipping_charge}}" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                </div>
                                <div class="container">
                                    <div class="form-group">
                                        <label for="image" class="control-label mb-1">Image</label>
                                        <input id="image" name="image" type="file" class="form-control cc-number identified visa"  data-val="true"
                                            data-val-required="Please select an image" data-val-cc-number="Please select an image"
                                            autocomplete="cc-number">
                                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                               
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-plus fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Update Product</span>
                                        <span id="payment-button-sending" style="display:none;">Updating…</span>
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
