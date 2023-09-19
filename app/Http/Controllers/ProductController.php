<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OtherImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    public function index()
    {
        return view('admin.product.index',[
            'categories'=>Category::get(),
            'sub_categories'=>SubCategory::get(),
            'brands'=>Brand::get(),
            'units'=>Unit::get(),
        ]);
    }

    public function getSubcategoryByCategory()
    {
        $sub_categories = SubCategory::where('category_id',$_GET['id'])->where('status',1)->get();
        return response()->json($sub_categories);
    }

    public function create(Request $request)
    {

        $this->product = Product::newProduct($request);

        OtherImage::newOtherImage($request, $this->product->id);
        return back()->with('message','Product Added Successfully');
    }
    public function manage()
    {
        return view('admin.product.manage',[
            'products'=>Product::get(),
        ]);
    }

    public function detail($id)
    {

        return view('admin.product.detail',[
            'product'=>Product::find($id),
        ]);
    }

    public function edit($id)
    {
        $product_data = Product::find($id);
        return view('admin.product.edit',[
            'product'=>Product::find($id),
            'categories'=>Category::get(),
            'sub_categories'=>SubCategory::where('category_id',$product_data->category_id)->get(),
            'brands'=>Brand::get(),
            'units'=>Unit::get(),
        ]);
    }
    public function update(Request $request, $id)
    {


        $this->product =Product::updateProduct($request,$id);
        if($request->other_images){

            OtherImage::updateOtherImage($request,$this->product->id);
        }
        return redirect()->route('product.manage')->with('message','Product info updated Successfully');
    }

    public function Delete($id)
    {
        Product::deleteProduct($id);
        OtherImage::deleteOtherImage($id);
        return redirect()->route('product.manage')->with('message','Product info Deleted Successfully');
    }
}
