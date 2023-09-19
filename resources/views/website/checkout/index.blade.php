@extends('website.master')
@section('title')
    Product Checkout Page
@endsection
@section('body')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <ul class="nav nav-pills">
                            <li><a href="" class="nav-link active" data-bs-target="#cash" data-bs-toggle="pill">Cash On Delivery</a></li>
                            <li><a href="" class="nav-link" data-bs-target="#online" data-bs-toggle="pill">Online</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="cash">
                                <form method="POST" action="{{route('new-cash-order')}}">
                                    @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Full Name</label>
                                            <div class="row">
                                                <div class="col-md-12 form-input form">
                                                    @if(isset($customer->id))
                                                    <input type="text" required name="name" value="{{$customer->name}}" readonly placeholder="Full Name">
                                                    @else
                                                        <input type="text" required name="name" placeholder="Full Name">
                                                        <span class="text-danger">{{$errors->has('name')?$errors->first('name'):''}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Email Address</label>
                                            <div class="form-input form">
                                                @if(isset($customer->id))
                                                    <input type="email" required name="email" value="{{$customer->email}}" readonly placeholder="Email Address">
                                                @else
                                                    <input type="email" required name="email" placeholder="Email Address">
                                                    <span class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Phone Number</label>
                                            <div class="form-input form">
                                                @if(isset($customer->id))
                                                    <input type="text" name="mobile" readonly value="{{$customer->mobile}}" required placeholder="Phone Number">
                                                @else
                                                    <input type="text" name="mobile" required placeholder="Phone Number">
                                                    <span class="text-danger">{{$errors->has('mobile')?$errors->first('mobile'):''}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Delivery Address</label>
                                            <div class="form-input form">
                                                <textarea type="text" class="pt-2" style="height: 100px" name="delivery_address" placeholder="Mailing Address"></textarea>
                                                <span class="text-danger">{{$errors->has('delivery_address')?$errors->first('delivery_address'):''}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Payment Type</label>
                                            <div class="">
                                                <label><input type="radio"  name="payment_type" value="1" checked>&nbsp; Cash on delivery</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="single-checkbox checkbox-style-3">
                                            <input type="checkbox" id="checkbox-3" checked>
                                            <label for="checkbox-3"><span></span></label>
                                            <p>I accept all term & condition.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form button">
                                            <button type="submit" class="btn">Confirm Order</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show" id="online">
                                <div class="mt-4">
                                    <h4 class="mb-3">Billing address</h4>
                                    <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                                        <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="firstName">Full name</label>
                                                @if(isset($customer->id))
                                                    <input type="text" required name="name" class="form-control" value="{{$customer->name}}" readonly placeholder="Full Name">
                                                @else
                                                    <input type="text" required name="name" class="form-control" placeholder="Full Name">
                                                    <span class="text-danger">{{$errors->has('name')?$errors->first('name'):''}}</span>
                                                @endif
                                                <div class="invalid-feedback">
                                                    Valid customer name is required.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="mobile">Mobile</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+88</span>
                                                </div>
                                                @if(isset($customer->id))
                                                    <input type="text" name="mobile" class="form-control" readonly value="{{$customer->mobile}}" required placeholder="Phone Number">
                                                @else
                                                    <input type="text" name="mobile" class="form-control" required placeholder="Phone Number">
                                                    <span class="text-danger">{{$errors->has('mobile')?$errors->first('mobile'):''}}</span>
                                                @endif
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    Your Mobile number is required.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Email <span class="text-muted">(*)</span></label>
                                            @if(isset($customer->id))
                                                <input type="email" required name="email" class="form-control" value="{{$customer->email}}" readonly placeholder="Email Address">
                                            @else
                                                <input type="email" required name="email" class="form-control" placeholder="Email Address">
                                                <span class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                                            @endif
                                            <div class="invalid-feedback">
                                                Please enter a valid email address for shipping updates.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <textarea type="text" name="delivery_address" class="form-control" id="address" placeholder="Delivery Address" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter your shipping address.
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-5 mb-3">
                                                <label for="country">Country</label>
                                                <select class="custom-select d-block w-100 form-control" id="country" name="country" required>
                                                    <option value="">Choose...</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid country.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="state">State</label>
                                                <select class="custom-select d-block w-100 form-control" id="state" required>
                                                    <option value="">Choose...</option>
                                                    <option value="Dhaka">Dhaka</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid state.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="zip">Zip</label>
                                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                                <div class="invalid-feedback">
                                                    Zip code required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>Payment Type</label>
                                                <div class="">
                                                    <label><input type="radio"  name="payment_type" value="2" checked>&nbsp; Online</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="single-checkbox checkbox-style-3">
                                                <input type="checkbox" id="checkbox-33" checked>
                                                <label for="checkbox-33"><span></span></label>
                                                <p>I accept all term & condition.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">Shopping Cart Summery</h5>
                            <div class="sub-total-price">
                                @foreach(ShoppingCart::all() as $product)
                                <div class="total-price">
                                    <p class="value">{{$product->name}}
                                        ({{$product->price}} * {{$product->qty}})
                                    </p>
                                    <p class="price">Tk.{{$product->price * $product->qty}}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Subtotal Price:</p>
                                    <p class="price">Tk.{{$total=ShoppingCart::total()}}</p>
                                </div>
                                <div class="payable-price">
                                    <p class="value">Tax Amount:</p>
                                    <p class="price">Tk.{{$tax=round((ShoppingCart::total()*15)/100)}}</p>
                                </div>
                                <div class="payable-price">
                                    <p class="value">Shipping:</p>
                                    <p class="price">Tk.{{$shipping=100}}</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Total Payable:</p>
                                    <p class="price">Tk.{{$orderTotal = $total+$tax+$shipping}}</p>
                                </div>
                                @php
                                 Session::put('order_total',$orderTotal);
                                 Session::put('tax_total',$tax);
                                 Session::put('shipping_total',$shipping);
                                @endphp
                            </div>
                            <div class="price-table-btn button">
                                <a href="{{route('checkout')}}" class="btn btn-alt">Checkout</a>
                            </div>
                        </div>
                        <div class="checkout-sidebar-banner mt-30">
                            <a href="product-grids.html">
                                <img src="{{asset('/')}}website/assets/images/banner/banner.jpg" alt="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
