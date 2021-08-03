@extends('layouts.partner')

@section('title')
<title>Categories</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
                
            <div class="row m-t-30">
                <div class="col-md-12">
                    
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <h3 class="title-5 m-b-35">Categories</h3>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('categories.create')}}" class="au-btn au-btn-icon au-btn--green au-btn--small text-white">
                                <i class="zmdi zmdi-plus"></i>Add Category</a>
                        </div>
                    </div>
                    <!-- DATA TABLE-->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div> 
                    @endif
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>icon</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>type</th>
                                    <th>no of products</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $item)
                                <tr>
                                    <td><img src="{{asset('images/'.$item->icon)}}" class="rounded-circle" width="70" alt=""></td>
                                    <td class="align-middle">{{$item->title}}</td>
                                    <td class="align-middle">{{$item->description}}</td>
                                    <td class="{{$item->type==0?'process':'text-primary'}} align-middle">{{$item->type==0?'Service':'Product'}}</td>
                                    <td class="align-middle">{{$item->products->count()}}</td>
                                    <td class="align-middle">
                                        <div class="table-data-feature">
                                            <a href="{{route('categories.edit',$item->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <form action="{{route('categories.destroy',$item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <td>You have not added any category</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$categories->links()}}
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
