@extends('layouts.base')

@section('title')
    <title>Login</title>
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="heading text-center">
                    <h2 class="title">Login</h2>
                
                </div><!-- End .heading -->

                <form action="{{route('login')}}" method="POST">
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
                    <div class="row">
                        <div class="col-md-4">
                            <select name="country_code" id="" class="form-control" >
                                @foreach ($countries as $item)
                                    <option style="padding-right:20px" value="{{$item ->phonecode}}" {{$item ->phonecode==254 ? 'selected':''}} > +{{$item ->phonecode.' '.$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="mobile" class="form-control" placeholder="Phone Number" required>
                        </div>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                        <a href="{{route('password.forgot')}}" class="forget-pass"> Forgot your password?</a> <br>
                       <span class="ml-5 pl-5">Not yet registered?<a href="{{route('signup')}}" class="forget-pass"> Create Account</a> 
                    </div><!-- End .form-footer -->
                </form>
                <div class="form-choice">
                    <p class="text-center">or sign in with</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('login.google')}}" class="btn btn-login btn-g">
                                <i class="icon-mail btn btn-primary btn-sm text-white"></i>
                                Login With Google
                            </a>
                        </div><!-- End .col-6 -->
                        <div class="col-sm-6">
                            <a href="{{route('login.facebook')}}" class="btn btn-login btn-f">
                                <i class=" icon-facebook btn btn-facebook btn-sm text-white " ></i>
                                Login With Facebook
                            </a>
                        </div><!-- End .col-6 -->
                    </div><!-- End .row -->
                </div><!-- End .form-choice -->
            </div><!-- End .col-md-6 -->

           
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
@endsection