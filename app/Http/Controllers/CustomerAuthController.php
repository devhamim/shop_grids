<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\TemporaryUserData;
use Illuminate\Http\Request;
use Session;

class CustomerAuthController extends Controller
{
    //
    private $customer;
    public function index()
    {
        return view('customer.login');
    }

    public function register_page()
    {
        return view('customer.register');
    }

    public function login(Request $request)
    {
        $this->customer = Customer::where('email',$request->email)->first();
        if ($this->customer){
            if (password_verify($request->password,$this->customer->password)){
                Session::put('customer_id',$this->customer->id);
                Session::put('customer_name',$this->customer->name);

                return redirect('/customer-dashboard');
            }
            else{
                return back()->with('message','Invalid Password');
            }
        }
        else{
            return back()->with('message','Invalid Email');
        }
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:customers,email',
            'mobile'=>'required|unique:customers,mobile',
            'password'=>'required',
        ]);
        $this->customer = Customer::newCustomer($request);

        Session::put('customer_id',$this->customer->id);
        Session::put('customer_name',$this->customer->name);
        return redirect('/customer-dashboard');
    }
    public function logout()
    {

        $user_datas = TemporaryUserData::where('user_id',Session::get('customer_id'))->get();
        foreach ($user_datas as $user_data) {
            $user_data->delete();
        }
        Session::forget('customer_id');
        Session::forget('customer_name');

        return redirect('/');

    }

    public function dashboard()
    {
        return view('customer.dashboard',[

        ]);
    }
    public function profile()
    {
        return view('customer.profile',[

        ]);
    }

}
