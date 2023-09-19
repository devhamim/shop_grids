@extends('admin.master')
@section('title')
    Manage Product
@endsection

@section('body')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-tdemecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Product</li>
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
            <h4 class="card-title">Manage Product</h4>


            <div class="table-responsive m-t-40 " >
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <table class="table table-striped border">

                    <tr>
                        <th>Product ID</th>
                        <td>{{$product->id}}</td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>{{$product->name}}</td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <td>{{$product->code}}</td>
                    </tr>
                    <tr>
                        <th>Product Model</th>
                        <td>{{$product->model}}</td>
                    </tr>
                    <tr>
                        <th>Product Category</th>
                        <td>{{$product->category->name}}</td>
                    </tr>
                    <tr>
                        <th>Product Sub Category</th>

                        <td>{{$product->subCategory->name}}</td>
                    </tr>
                    <tr>
                        <th>Product Brand</th>
                        <td>{{$product->brand->name}}</td>
                    </tr>
                    <tr>
                        <th>Product unit</th>
                        <td>{{$product->unit->name}}</td>
                    </tr>
                    <tr>
                        <th>Product Stock amount</th>
                        <td>{{$product->stock_amount}}</td>
                    </tr>
                    <tr>
                        <th>Product Regular Price</th>
                        <td>{{$product->regular_price}}</td>
                    </tr>
                    <tr>
                        <th>Product Selling Price</th>
                        <td>{{$product->selling_price}}</td>
                    </tr>
                    <tr>
                        <th>Product Feature Image</th>
                        <td><img src="{{asset($product->image)}}" height="100" widtd="120" alt="{{$product->name}}"></td>
                    </tr>
                    <tr>
                        <th>Product Other Image</th>
                        <td>
                            @foreach($product->otherImages as $otherImage)
                            <td><img src="{{asset($otherImage->image)}}" height="100" widtd="120" alt="{{$product->name}}"></td>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Product Hit Count</th>
                        <td>{{$product->hit_count}}</td>
                    </tr>
                    <tr>
                        <th>Product Sell Count</th>
                        <td>{{$product->sales_count}}</td>
                    </tr>
                    <tr>
                        <th>Product Feature Status</th>
                        <td>{{$product->featured_status == 1 ? 'Featured': 'Not Featured'}}</td>
                    </tr>
                    <tr>
                        <th>Product Publication Status</th>
                        <td>{{$product->status == 1 ? 'Published': 'Unpublished'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
