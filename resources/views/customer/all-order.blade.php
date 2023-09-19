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
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Order No</th>
                                <th>Order Date</th>
                                <th>Order Total</th>
                                <th>Delivery Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_date}}</td>
                                <td>{{$order->order_total}}</td>
                                <td>{{$order->delivery_address}}</td>
                                <td>{{$order->order_status==0?'Pending':'Approved'}}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-success">Details</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
