<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function index()
    {
        return view('admin.order.index',[
            'orders'=>Order::orderBy('id','desc')->get(),
        ]);
    }

    public function detail($id)
    {
        return view('admin.order.detail',[
            'order'=>Order::find($id),
        ]);
    }
    public function edit($id)
    {
        return view('admin.order.edit',[
            'order'=>Order::find($id),
        ]);
    }
    public function showInvoice($id)
    {
        return view('admin.order.invoice',[
            'order'=>Order::find($id),
        ]);
    }
    public function printInvoice($id)
    {
        return view('admin.order.print-invoice',[
            'order'=>Order::find($id),
        ]);
    }
    public function delete($id)
    {
        return $id;
    }
}
