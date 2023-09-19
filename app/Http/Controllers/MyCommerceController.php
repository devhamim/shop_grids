<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class MyCommerceController extends Controller
{
    //
    public function index()
    {

//        return (Session::get('customer_id'));
        return view('website.home.index',[
            'products'=>Product::orderBy('id','desc')->take(8)->get(['id','category_id','name','selling_price','image']),
            'categories'=>Category::get(),
        ]);
    }
    public function category($id)
    {
        return view('website.category.index',[
            'products'=>Product::where('category_id',$id)->orderBy('id','desc')->get(),
        ]);
    }
    public function detail($id)
    {
        return view('website.detail.index',[
            'product'=>Product::find($id),
        ]);
    }

}
