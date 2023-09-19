@extends('admin.master')
@section('title')
    Edit Brand
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
                    <li class="breadcrumb-item active">Edit Brand</li>
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
                    <h4 class="card-title">Edit Brand Form</h4>
                    <hr>
                    <h4 class="text-success text-center">{{session('message')}}</h4>
                    {{--                <h6 class="card-subtitle">Use Bootstrap's predefined grid classes for horizontal form</h6>--}}
                    <form class="form-horizontal p-t-20" method="POST" action="{{route('brand.update',['id'=>$brand->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Brand Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="exampleInputuname3" name="name" value="{{$brand->name}}" placeholder="Brand Name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 control-label">Brand Description<span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <textarea type="email" class="form-control" id="exampleInputEmail3" name="description" placeholder="Category Description">{{$brand->description}}</textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-3 control-label" for="web">Brand Image</label>
                            <div class="col-sm-9">

                                <input type="file" id="input-file-now" name="image" class="dropify" />
                                <img src="{{asset($brand->image)}}" height="70px" width="70px" alt="">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="inputPassword4" class="col-sm-3 control-label">Publication Status</label>
                            <div class="col-sm-9">



                                <input type="radio" name="status" id="published" value="1" {{$brand->status==1?'checked':''}}> <label for="published" class="me-2">Published</label>
                                <input type="radio" name="status" id="unpublished" value="2" {{$brand->status==2?'checked':''}}> <label for="unpublished">Unpublished</label>

                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">Update New Brand</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
