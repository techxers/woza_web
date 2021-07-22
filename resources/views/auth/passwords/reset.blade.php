@extends('layouts.base')

@section('title')
    <title>Reset Password</title>
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="heading text-center">
                    <h2 class="title">Create New Password</h2>
                </div><!-- End .heading -->
                <form action="{{route('password.update')}}" method="POST">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-danger">
                                <li>{{$item}}</li>
                            </div>  
                        @endforeach
                    @endif
                    @csrf
                     <input type="hidden" name="token" value="{{ session('token')!=null ? session('token') :$token }}">
                    
                    <input type="email" class="form-control" placeholder="Email Address" value="{{$email}}" name="email" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation" required>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">RESET PASSWORD</button>
                        
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->

           
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
@endsection
