@extends('website.master')
@section('title')
Register
@endsection
@section('body')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Register</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>

                        <li>Register</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Login Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('customer.register')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name">
                                        <span class="text-danger">{{$errors->has('name')?$errors->first('name'):''}}</span>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Email Address</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email">
                                        <span class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                        <span class="text-danger">{{$errors->has('password')?$errors->first('password'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Mobile Number</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="mobile">
                                        <span class="text-danger">{{$errors->has('mobile')?$errors->first('mobile'):''}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3 text-center">
                                    Already have an account? <a href="{{ route('customer.login.page') }}" class="text-info m-l-5"><b>Sign In</b></a>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3"></label>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-sm btn-success" value="Register">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
