<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create(Request $request)
    {
        Category::saveCategory($request);
        return back()->with('message','Category Added Successfully');
    }
    public function manage()
    {
        return view('admin.category.manage',[
            'categories'=>Category::all(),
        ]);
    }
    public function edit($id)
    {
        return view('admin.category.edit',[
            'category'=>Category::find($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        Category::updateCategory($request,$id);
        return redirect()->route('category.manage')->with('message','Category info updated Successfully');
    }

    public function Delete($id)
    {
        Category::deleteCategory($id);
        return redirect()->route('category.manage')->with('message','Category info Deleted Successfully');
    }

}
