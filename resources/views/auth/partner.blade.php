@extends('layouts.base')

@section('title')
    <title>Register Partner</title>
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="heading">
                    <h2 class="title">Register as a Partner</h2>
                </div><!-- End .heading -->
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger">
                            <li>{{$item}}</li>
                        </div>       
                    @endforeach
                @endif
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_type" value="1">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
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
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    <input type="number" name="id" class="form-control" placeholder="ID Number" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

        

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Create Account</button> <a href="{{route('login')}}" class="forget-pass"> Already Registered?</a> <br>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
@endsection