@extends('layouts.base')
<title>Notifications</title>
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
               
                @forelse ($notifications as $item)
                <article class="post">
                    <div class="post-body">
                        <div class="post-date">
                            <?php 
                                $date=strtotime($item->created_date);
                                $new= \Carbon\Carbon::parse($date);
                            ?>
                            <span class="day">{{$new->format('d')}}</span>
                            <span class="month">{{$new->format('F')}}</span>
                        </div><!-- End .post-date -->

                        <h2 class="post-title">
                            <a href="{{route('dashboard')}}">{{$item->title}}</a>
                        </h2>

                        <div class="post-content">
                            <p> {{$item->message}}</p>

                            <a href="{{route('customer.notifications.delete',$item->id)}}" class="read-more">Delete <i class="fa fa-trash"></i></a>
                        </div><!-- End .post-content -->

                        <div class="post-meta">
                            <span><i class="icon-calendar"></i>{{$new}}</span>
                            <span><i class="icon-user"></i>From <a href="#">User</a></span>
                            <span><i class="icon-folder-open"></i>
                                <a href="">{{$item->type}} </a>
                            
                            </span>
                        </div><!-- End .post-meta -->
                    </div><!-- End .post-body -->
                </article><!-- End .post --> 
                @empty
                <div class="post-content">
                    <p>You have no new notifications</p>

                    
                </div><!-- End .post-content -->
                @endforelse
               
            </div><!-- End .col-lg-9 -->
        </div><!-- End .row -->
        {{$notifications->links()}}
    </div><!-- End .container -->
   
    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->
@endsection