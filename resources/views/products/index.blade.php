@extends('layouts.partner')

@section('title')
<title>My Shop</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
           
            
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <h3 class="title-5 m-b-35">Products</h3>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('products.create')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product</a>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>name</th>
                                    <th>Category</th>
                                    <th>description</th>
                                    <th>Available Quantity</th>
                                    <th> stock status</th>
                                    <th>price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $item)
                                    <tr class="tr-shadow">
                                        <td><img class="rounded-circle" src="{{asset('images/products/'.$item->image)}}" alt=""></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{isset($item->category) ? $item->category->title : 'General'}} </td>
                                        <td class="desc">{{$item->description}}</td>
                                        <td>{{$item->qut}}</td>
                                        <td>
                                            <span class="status--process">Available</span>
                                        </td>
                                        <td>{{$item->selling_price}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('products.edit',$item->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{route('products.destroy',$item->id)}}" method="post">
                                                    @csrf @method('delete')
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                                
                                               
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @empty
                                    <td>You have not added any products</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$products->links()}}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection