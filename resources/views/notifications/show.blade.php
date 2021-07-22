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
                        <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                            <div class="bg-overlay bg-overlay--blue"></div>
                            <h3>
                                <i class="zmdi zmdi-comment-text"></i>{{$notification->title}}</h3>
                            
                            
                            <a href="{{route('notifications.delete',$notification->id)}}" class="au-btn-plus">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </div>
                        <div class="au-inbox-wrap">
                            <div class="au-chat au-chat--border">
                                <div class="au-chat__title">
                                    <div class="au-chat-info">
                                        <div class="avatar-wrap">
                                            @if ($notification->sender->profile_image==null||$notification->sender->profile_image=='-')
                                                <div class="avatar avatar--small">
                                                   <i class="fa fa-user fa-3x"></i>
                                                </div>
                                            @else
                                                <div class="avatar avatar--small">
                                                    <img src="{{asset('images/profile/'.$notification->sender->profile_image)}}" alt="John Smith">
                                                </div>
                                            @endif
                        
                                        </div>
                                        <span class="nick">
                                            <a href="#">{{$notification->sender->fname.' '.$notification->sender->lname}}</a>
                                        </span>
                                        
                                    </div>
                                </div>
                                <div class="au-chat__content au-chat__content2 js-scrollbar5">
                                    <div class="recei-mess-wrap">
                                        <?php $date=strtotime($notification->created_date);
                                        $new= \Carbon\Carbon::parse($date);?>
                                        <span class="mess-time">{{$new->diffForHumans()}}</span>
                                        
                                    </div>
                                    <div class="au-chat-textfield border-0">
                                        <form class="au-form-icon border-0">
                                            <input readonly class="au-input au-input--full au-input--h65  border-0"  type="text" value="{{$notification->message}}">
                                           
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection