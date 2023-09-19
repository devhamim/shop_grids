<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Session;

class CustomerOrderController extends Controller
{
    //
    private $orders;
    public function allOrder()
    {
        $this->orders=Order::where('customer_id',Session::get('customer_id'))->get();
        return view('customer.all-order',[
            'orders'=>$this->orders,
        ]);
    }
}
