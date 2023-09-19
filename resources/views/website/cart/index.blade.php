@extends('website.master')
@section('title')
    Product Cart Page
@endsection
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">

                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Unit Price</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Total</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
{{--                @dd($cart_products)--}}
                @php $sum = 0 @endphp
                @foreach($cart_products as $products)
                <div class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="product-details.html"><img src="{{asset($products->image)}}" alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="">
                                    {{$products->name}}</a></h5>
                            <p class="product-des">
                                <span><em>Category:</em>{{$products->category??null}}</span>
                                <span><em>Brand:</em>{{$products->brand??null}}</span>
                            </p>
                        </div>

                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Tk.{{$products->price}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <form action="{{route('update-cart-product',['id'=>$products->__raw_id])}}" method="POST">
                                @csrf
                            <div class="input-group">
                                <input type="number" name="qty" value="{{$products->qty}}" min="1" class="form-control" required>
                                <input type="submit" class="btn btn-sm btn-info" value="update">
                            </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Tk.{{$products->total}}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" onclick="return confirm('Are you sure to delete this')" href="{{route('remove-cart-product',['id'=>$products->__raw_id])}}"><i class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
                    @php $sum = $sum + $products->total @endphp
                @endforeach


            </div>
            <div class="row">
                <div class="col-12">

                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>Tk.{{$sum}}</span></li>
                                        <li>Tax(15%)<span>Tk.{{$tax=round(($sum*15)/100)}}</span></li>
                                        <li>Shipping<span>Tk.{{$shipping = 100}}</span></li>
                                        <li class="last">Total Pay<span>Tk.{{$sum+$tax+$shipping}}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{route('checkout')}}" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
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
