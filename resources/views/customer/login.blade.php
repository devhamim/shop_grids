@extends('website.master')
@section('title')
    Login
@endsection
@section('body')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Login</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>

                        <li>Login</li>
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
                            <p class="text-danger text-center">{{session('message')}}</p>
                            <form action="{{route('customer.login')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Email Address</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3 text-center">
                                    Don't have an account? <a href="{{ route('customer.register.page') }}" class="text-info m-l-5"><b>Sign Up</b></a>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-md-3"></label>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-sm btn-success" value="Login">
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
