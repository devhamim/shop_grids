<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\TemporaryUserData;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use function Nette\Utils\data;
use Session;
use Cookie;
use App\Models\Order;

class SslCommerzPaymentController extends Controller
{
    public $user_data_id;

    public function exampleEasyCheckout()
    {
        return view('website.checkout.exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('website.checkout.exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        if (Session::get('customer_id')){
            $this->customer = Customer::find(Session::get('customer_id'));
            TemporaryUserData::newUser($this->customer->id,$this->customer->name);
        }
        else{
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required|unique:customers,email',
                'mobile'=>'required|unique:customers,mobile',
                'delivery_address'=>'required',
            ]);

            $this->customer = Customer::newCustomer($request);
//            return $this->customer;


            Session::put('customer_id',$this->customer->id);
            Session::put('customer_name',$this->customer->name);
            TemporaryUserData::newUser($this->customer->id,$this->customer->name);
//            Cookie::forever('customer_id', $this->customer->id);
//            Cookie::forever('customer_name', $this->customer->name);
//            Cookie::queue('customer_id', $this->customer->id, 120);
//            Cookie::make('customer_id', $this->customer->id, 60);
//
//            dd(Cookie::get('customer_id'));



        }

        $post_data = array();
        $post_data['total_amount'] = Session::get('order_total'); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $this->customer->name;
        $post_data['cus_email'] = $this->customer->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $this->customer->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
//                'name' => $post_data['cus_name'],
//                'email' => $post_data['cus_email'],
//                'phone' => $post_data['cus_phone'],
//                'amount' => $post_data['total_amount'],
//                'status' => 'Pending',
//                'address' => $post_data['cus_add1'],
//                'transaction_id' => $post_data['tran_id'],
//                'currency' => $post_data['currency']
                'customer_id' => $this->customer->id,
                'order_date' => date('Y-m-d'),
                'order_timestamp' => strtotime(date('Y-m-d')),
                'order_total' => $post_data['total_amount'],
                'tax_total' => Session::get('tax_total'),
                'shipping_total' => Session::get('shipping_total'),
                'delivery_address' => $request->delivery_address,
                'payment_type' => $request->payment_type,
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $new_order = Order::orderBy('id', 'DESC')->first();
        OrderDetail::newOrderDetail($new_order->id);


//        OrderDetail::newOrderDetail(Order::orderBy('id','desc')->first()->id);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }


    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

//        $post_data = array();
        if (Session::get('customer_id')){
            $this->customer = Customer::find(Session::get('customer_id'));
        }
        else{
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required|unique:customers,email',
                'mobile'=>'required|unique:customers,mobile',
                'delivery_address'=>'required',
            ]);

            $this->customer = Customer::newCustomer($request);

            Session::put('customer_id',$this->customer->id);
            Session::put('customer_name',$this->customer->name);
            TemporaryUserData::newUser($this->customer->id,$this->customer->name);
        }

        $post_data = array();
        $post_data['total_amount'] = Session::get('order_total'); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique


        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'customer_id' => $this->customer->id,
                'order_date' => date('Y-m-d'),
                'order_timestamp' => strtotime(date('Y-m-d')),
                'order_total' => $post_data['total_amount'],
                'tax_total' => Session::get('tax_total'),
                'shipping_total' => Session::get('shipping_total'),
                'delivery_address' => $request->delivery_address,
                'payment_type' => $request->payment_type,
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);
        $new_order = Order::orderBy('id', 'DESC')->first();
//        OrderDetail::newOrderDetail($update_product->id);
        OrderDetail::newOrderDetail($new_order->id);


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
//        return (Session::get('customer_id'));
//        return Session::all();
//        dd($this->user_data_id);

        echo "Transaction is Successful";
        $user_data = TemporaryUserData::orderBy('id', 'DESC')->first();
        Session::put('customer_id',$user_data->user_id);
        Session::put('customer_name',$user_data->user_name);

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
//            ->select('transaction_id', 'status', 'currency', 'amount')->first();
            ->select('transaction_id', 'order_status', 'currency', 'order_total')->first();

        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['order_status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
                return redirect('/complete-order')->with('message','Congratulation... your order info post successfully. please wait, we will contact with you soon.');

            }
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
            return redirect('/complete-order')->with('message','Congratulation... your order info post successfully. please wait, we will contact with you soon.');

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
//            ->select('transaction_id', 'status', 'currency', 'amount')->first();
            ->select('transaction_id', 'order_status', 'currency', 'order_total')->first();

        if ($order_details->order_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
//            ->select('transaction_id', 'status', 'currency', 'amount')->first();
            ->select('transaction_id', 'order_status', 'currency', 'order_total')->first();

        if ($order_details->order_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
//                ->select('transaction_id', 'status', 'currency', 'amount')->first();
                ->select('transaction_id', 'order_status', 'currency', 'order_total')->first();

            if ($order_details->order_status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['order_status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
