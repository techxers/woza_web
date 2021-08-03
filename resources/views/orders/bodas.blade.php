@extends('layouts.partner')

@section('title')
<title>Bodas</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Available Bodas</h3>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>
                                    ID
                                    </th>
                                    <th>User name</th>
                                    <th>PHONE</th>
                                    <th>Location (Metres Away)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse ($mybodas as $item)
                                <tr class="tr-shadow">
                                    <td class="mt-5 p-5" >
                                        {{$item->userId}}
                                    </td>
                                    <td>{{ $item->fname.' '.$item->lname}}</td>
                                    <td>
                                        <span class="block-email">{{$item->mobile}}</span>
                                    </td>
                                    <td class="desc">
                                        {{$item->distance}}
                                    </td>
                                    <td> 
                                        <form id="boda" action="{{route('order.deliver')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="boda" value="{{$item->userId}}">
                                            <input type="hidden" name="order" value="{{$order}}">
                                        </form>
                                        <button form="boda" type="submit" class="btn btn-primary">Order</button>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @empty
                                <tr >
                                    <td colspan="7">You have bodas near you</td>
                                </tr>     
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection