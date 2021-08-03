@extends('layouts.partner')

@section('title')
<title>Dashboard</title>
@endsection

@section('content')
           <!-- MAIN CONTENT-->
           <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">overview</h2>
                                <a href="{{route('products.create')}}" class="au-btn au-btn-icon au-btn--blue">
                                    <i class="zmdi zmdi-plus"></i>add product</a>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c1">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-account-o"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$customers}}</h2>
                                            <span>customers Served</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c2">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$sales->count()}}</h2>
                                            <span>Products Sold</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c3">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$bookings->count()}} </h2>
                                            <span>Bookings Served <br> <small></small></span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 ">
                            <div class="overview-item overview-item--c4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-card"></i> <br>
                                        </div>
                                        <div class="text">
                                            <h2> {{$sales->sum('amount') + $bookings->sum('amount') }} </h2>
                                            <span>Total Earnings</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Recent Sales</h2>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>date</th>
                                            <th>order ID</th>
                                            <th> customer name</th>
                                            <th class="text-right">total amount</th>
                                            <th class="text-right">No of Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sales->take(8) as $item)
                                        <tr>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->user->fname.' '.$item->user->lname}}</td>
                                            <td class="text-right">{{$item->amount}}</td>
                                            <td class="text-right">{{$item->orderitems->count()}}</td>
                                        </tr>
                                        @empty
                                            <td>Your shop has not recorded any sales</td>
                                        @endforelse
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    
                        <div class="col-lg-12">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-account-calendar"></i>Notifications</h3>
                                </div>
                                <div class="au-task js-list-load au-task--border">
                                    <div class="au-task__title">
                                        <p>Notifications for {{Auth::user()->fname.' '.Auth::user()->lname}}</p>
                                    </div>
                                    <div class="container">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{session('success')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="au-task-list js-scrollbar3 mt-3">
                                        @forelse (Auth::user()->receivednotifications->take(5) as $item)
                                        <a href="{{route('notifications.show',$item->id)}}">
                                        <div class="au-task__item au-task__item--danger w-100" >
                                           <div class="au-task__item-inner w-100">
                                                <h5 class="task ">{{$item->title}}</h5>
                                                <p class="text-success">{{$item->message}}</p>
                                                <?php $date=strtotime($item->created_date);
                                                $new= \Carbon\Carbon::parse($date);?>
                                                <span>{{$new->diffForHumans()}}</span>
                                                <a href="{{route('notifications.delete',$item->id)}}">
                                                    <i class="zmdi zmdi-delete zmdi-hc-1x text-danger"></i>
                                                </a>
                                           </div>
                                          
                                        </div>
                                    </a>
                                        @empty
                                            <h5 class="task ml-5">
                                                <a href="#">You have no notifications</a>
                                            </h5>
                                        @endforelse
                                    </div>
                                    <div class="au-task__footer">
                                        
                                        <a href="{{route('notifications.index')}}" class="btn btn-primary">Load More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
@endsection