@extends('layouts.partner')

@section('title')
<title>Notifications</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
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
                                @forelse ($notifications as $item)
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
                                <button class="au-btn au-btn-load js-load-btn">load more</button>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection