@extends('layouts.partner')

@section('title')
<title>Orders</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Orders</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="" method="get">
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="status">
                                        <option value="" {{$status==null ? 'selected':''}}>All</option>
                                        <option value="0" {{$status==0 ? 'selected':''}} >Pending</option>
                                        <option value="1" {{$status==1 ? 'selected':''}}>Processing</option>
                                        <option value="2" {{$status==2 ? 'selected':''}}>Canceled (User)</option>
                                        <option value="3" {{$status==3 ? 'selected':''}}>Canceled (Shop)</option>
                                        <option value="5" {{$status==5 ? 'selected':''}}>Delivered</option>
                                        <option value="6" {{$status==6 ? 'selected':''}}>Paid</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <button class="au-btn-filter" type="submit">
                                    <i class="zmdi zmdi-filter-list"></i>filter
                                </button>
                            </form>
                        </div>
                        <div class="table-data__tool-right">
                            
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
                                    <th>
                                    ID
                                    </th>
                                    <th>User name</th>
                                    <th>PHONE</th>
                                    <th>delivery address</th>
                                    <th>date</th>
                                    <th>status</th>  
                                    <th>amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                <tr class="tr-shadow">
                                    <td class="mt-5 p-5" >
                                        {{$item->id}}
                                    </td>
                                    <td>{{$item->name!=null ? $item->name : $item->user->fname.' '.$item->user->lname}}</td>
                                    <td>
                                        <span class="block-email">{{$item->user->mobile}}</span>
                                    </td>
                                    <td class="desc">{{Str::limit($item->delivery_address,10)}}</td>
                                   
                                    <td>{{$item->created_at}}</td>

                                    <td>
                                    <span class="{{$item->status==0 ? 'text-primary':($item->status==1 ? 'text-info':($item->status==2 ? 'text-danger':($item->status==3 ? 'text-danger':($item->status==4 ? 'text-warning':($item->status==5 ? 'text-warning':'text-success')))))}}">{{$item->status==0 ? 'Pending':($item->status==1 ? 'Accepted': ($item->status==2 ? 'Canceled (User)':($item->status==3 ? 'Canceled (Shop)':($item->status==4 ? 'On Delivery':($item->status==5 ? 'Delivered': 'Paid')))))}}</span>
                                    </td>
                                    <td>{{$item->amount}}</td>
                                    <td>
                                        <ul class="nav nav-pills ">
                                            <li class="nav-item dropdown  ">
                                                <a class="nav-link dropdown-toggle btn btn-info text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Options</a>
                                                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" href="{{route('order.show',$item->id)}}">View</a>
                                                    @if ($item->status==0||$item->status==1||$item->status==4||$item->status==5)
                                                        <a class="dropdown-item" href="{{route('order.accept',$item->id)}}">Accept</a>
                                                        <a class="dropdown-item" href="{{route('order.process',$item->id)}}">Process</a>
                                                        <a class="dropdown-item" href="{{route('order.boda',$item->id)}}">Deliver</a>
                                                        <a class="dropdown-item" href="{{route('order.paid',$item->id)}}">Paid</a>
                                                        <a class="dropdown-item" href="{{route('order.cancel',$item->id)}}">Cancel</a>
                                                        
                                                    @endif
                                                </div>
                                            </li>     
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @empty
                                <tr >
                                    <td colspan="7">You have not received any orders</td>
                                </tr>     
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                    {{$orders->links()}}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection