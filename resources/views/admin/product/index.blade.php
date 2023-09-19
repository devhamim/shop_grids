@extends('admin.master')
@section('title')
    Add Product
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
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product Form</h4>
                    <hr>
                    <h4 class="text-success text-center">{{session('message')}}</h4>
                    {{--                <h6 class="card-subtitle">Use Bootstrap's predefined grid classes for horizontal form</h6>--}}
                    <form class="form-horizontal p-t-20" method="POST" action="{{route('product.new')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="categoryId" class="col-sm-3 control-label">Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id" id="categoryId">
                                    <option value="" selected disabled>-- Select Category --</option>

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subCategoryId" class="col-sm-3 control-label">Sub Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="sub_category_id" id="subCategoryId" required>
                                    <option value="" selected disabled>-- Select Sub Category --</option>

{{--                                    @foreach($sub_categories as $sub_category)--}}
{{--                                        <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand_id" class="col-sm-3 control-label">Brand Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand_id" id="brand_id" required>
                                    <option value="" selected disabled>-- Select Brand --</option>

                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_id" class="col-sm-3 control-label">Unit <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="unit_id" id="unit_id" required>
                                    <option value="" selected disabled>-- Select Unit --</option>

                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 control-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-sm-3 control-label">Product Code <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Product Code" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="model" class="col-sm-3 control-label">Product Model</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="model" name="model" placeholder="Product Model">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock_amount" class="col-sm-3 control-label">Product Stock Amount <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stock_amount" name="stock_amount" placeholder="Product Stock Amount" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="regular_price" class="col-sm-3 control-label">Product Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" min="0" class="form-control" id="regular_price" name="regular_price" placeholder="Product Regular Price" required>
                                    <input type="number" min="0" class="form-control" id="selling_price" name="selling_price" placeholder="Product Selling Price" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="col-sm-3 control-label">Short Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="long_description" class="col-sm-3 control-label">Long Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control summernote" id="long_description" name="long_description" placeholder="Long Description" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="image">Feature Image <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" id="image" name="image" class="dropify" accept="image/*"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="other_image">Other Image <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" id="other_image" multiple name="other_images[]" class="dropify" accept="image/*"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword4" class="col-sm-3 control-label">Sub Publication Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">



                                <input type="radio" name="status" id="published" value="1" checked > <label for="published" class="me-2">Published</label>
                                <input type="radio" name="status" id="unpublished" value="2" > <label for="unpublished">Unpublished</label>

                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">Create New Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
