@extends('layouts.partner')

@section('title')
<title>Bookings</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-lg-12">
                    <!-- USER DATA-->
                    <div class="user-data m-b-30">
                        <h3 class="title-3 m-b-30">
                            <i class="zmdi zmdi-account-calendar"></i>Bookings</h3>
                        <div class="filters m-b-45">
                            <form action="" method="get">
                                <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                    <select class="js-select2" name="status">
                                        <option selected="selected" value="" {{$status==null ? 'selected':''}}>All</option>
                                        <option value="0" {{$status==0 ? 'selected':''}}>Pending</option>
                                        <option value="1" {{$status==1 ? 'selected':''}}>Accepted</option>
                                        <option value="2" {{$status==2 ? 'selected':''}}>Canceled</option>
                                        <option value="3" {{$status==3 ? 'selected':''}}>Completed</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <button class="au-btn-filter btn btn-primary" type="submit">
                                    <i class="zmdi zmdi-filter-list"></i>filter
                                </button>
                            </form>
                           
                        </div>
                        <div class="table-responsive table-data">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>
                                            ID
                                        </td>
                                        <td>name</td>
                                        <td>Category</td>
                                        <td>Service Date and Time</td>
                                        <td>status</td>
                                        <td>action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $item)
                                    <tr class="align-middle">
                                        <td>
                                            {{$item->id}}
                                        </td>
                                        <td>
                                            <div class="table-data__info">
                                                <h6>{{$item->booker->fname.' '.$item->booker->lname}}</h6>
                                                <span>
                                                    <a href="#">{{$item->booker->mobile}}</a>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{$item->category}}
                                        </td>
                                        <td>
                                            {{$item->service_date.' '.$item->service_time}}
                                        </td>
                                        <td>
                                            <span class="{{$item->status==0 ? 'text-primary':($item->status==1 ? 'text-warning':($item->status==2 ? 'text-danger':'text-success'))}}">{{$item->status==0 ? 'Pending':($item->status==1 ? 'Accepted': ($item->status==2 ? 'Canceled': 'Completed'))}}</span>
                                        </td>
                                        <td>
                                            <ul class="nav nav-pills">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle btn-info" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Options</a>
                                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="{{route('booking.show',$item->id)}}">View</a>
                                                        @if ($item->status==0||$item->status==1)
                                                            <a class="dropdown-item" href="{{route('booking.accept',$item->id)}}">Accept</a>
                                                            <a class="dropdown-item" href="{{route('booking.completed',$item->id)}}">Completed</a>
                                                            
                                                            
                                                        @endif
                                                    </div>
                                                </li>     
                                            </ul>
                                        </td>
                                    </tr>
                                    @empty
                                        <td colspan="4">You have no booking request</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{$bookings->links()}}
                    </div>
                  
                    <!-- END USER DATA-->
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection