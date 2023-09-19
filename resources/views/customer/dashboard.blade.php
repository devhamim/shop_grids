@extends('website.master')
@section('title')
    Dashboard
@endsection
@section('body')



    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>

                        <li>Dashboard</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        @include('customer.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-body">
                        <h1>My Dashboard</h1>
                        <input type="hidden" id="customer_id" name="customer_id" value="{{Session::get('customer_id')}}">
                        <input type="hidden" id="customer_name" name="customer_name" value="{{Session::get('customer_name')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        console.log(document.getElementById('customer_id').value)
        localStorage.setItem('customer_id',document.getElementById('customer_id').value)
        localStorage.setItem('customer_name',document.getElementById('customer_name').value)
    </script>
@endsection
