<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        return view('admin.sub-category.index',[
            'categories' => Category::get(),
        ]);
    }

    public function create(Request $request)
    {

        SubCategory::saveSubCategory($request);
        return back()->with('message','Sub Category Added Successfully');
    }
    public function manage()
    {
        return view('admin.sub-category.manage',[
            'sub_categories'=>SubCategory::all(),
        ]);
    }
    public function edit($id)
    {
        return view('admin.sub-category.edit',[
            'categories' => Category::get(),
            'sub_category'=>SubCategory::find($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        SubCategory::updateSubCategory($request,$id);
        return redirect()->route('sub-category.manage')->with('message','Sub Category info updated Successfully');
    }

    public function Delete($id)
    {
        SubCategory::deleteSubCategory($id);
        return redirect()->route('sub-category.manage')->with('message','Sub Category info Deleted Successfully');
    }
}
