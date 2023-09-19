@extends('admin.master')
@section('title')
    Order Information
@endsection

@section('body')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Order Information</li>
                </ol>
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Information</h4>


            <div class="table-responsive m-t-40 " >
                <table class="table table-striped border">
                    <tr>
                        <th>Order ID</th>
                        <td>{{$order->id}}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{$order->order_date}}</td>
                    </tr>
                    <tr>
                        <th>Order Total</th>
                        <td>{{$order->order_total}}</td>
                    </tr>
                    <tr>
                        <th>Tax Total</th>
                        <td>{{$order->tax_total}}</td>
                    </tr>
                    <tr>
                        <th>Shipping Total</th>
                        <td>{{$order->shipping_total}}</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td>{{$order->order_status}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Address</th>
                        <td>{{$order->delivery_address}}</td>                    </tr>
                    <tr>
                        <th>Delivery Status</th>
                        <td>{{$order->delivery_status}}</td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>{{$order->payment_type == 1 ? 'Cash on Delivery':'Online Payment'}}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{$order->payment_status}}</td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{$order->currency}}</td>
                    </tr>
                    <tr>
                        <th>Transaction Id</th>
                        <td>{{$order->transaction_id}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Information</h4>


            <div class="table-responsive m-t-40 " >
                <table  class="table table-striped border">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->customer->name}}</td>
                        <td>{{$order->customer->mobile}}</td>
                        <td>{{$order->customer->email}}</td>
                        <td>{{$order->customer->delivery_address}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Product Information</h4>


            <div class="table-responsive m-t-40 " >
                <table  class="table table-striped border">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Order Amount</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $orderDetails)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$orderDetails->product_name}}</td>
                                <td>{{$orderDetails->product_price}}</td>
                                <td>{{$orderDetails->product_qty}}</td>
                                <td>{{$orderDetails->product_price * $orderDetails->product_qty}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
