<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.index');
    }

    public function create(Request $request)
    {
        Brand::saveBrand($request);
        return back()->with('message','Brand Added Successfully');
    }
    public function manage()
    {
        return view('admin.brand.manage',[
            'brands'=>Brand::get(),
        ]);
    }
    public function edit($id)
    {
        return view('admin.brand.edit',[
            'brand'=>Brand::find($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        Brand::updateBrand($request,$id);
        return redirect()->route('brand.manage')->with('message','Brand info updated Successfully');
    }

    public function Delete($id)
    {
        Brand::deleteBrand($id);
        return redirect()->route('brand.manage')->with('message','Brand info Deleted Successfully');
    }

}
