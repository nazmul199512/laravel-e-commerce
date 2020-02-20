<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use Cart;


use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   public function login(){
       return view('pages.login');
   }

   public function customer_registration(Request $request){
       $data = array();
       $data['customer_name']=$request->customer_name;
       $data['customer_email']=$request->customer_email;
       $data['password']=md5($request->password);
       $data['mobile_number']=$request->mobile_number;

       $customer_id=DB::table('tbl_customer')
           ->insertGetId($data);
       Session::put('customer_id',$customer_id);
       Session::put('customer_name',$request->customer_name);

       return Redirect::to('/checkout');

   }

   public  function customer_login(Request $request){

       $customer_email = $request->customer_email;
       $password = md5($request->password);
       $result = DB::table('tbl_customer')
           ->where('customer_email',$customer_email)
           ->where('password',$password)
           ->first();
       if($result){
           Session::put('customer_id',$result->customer_id);

          return Redirect::to('/checkout');
       }else{
           return Redirect::to('/login');
       }

   }

   public function customer_logout(){
       Session::flush();
       return Redirect::to('/');
   }


   public function checkout(){
       return view('pages.checkout');
   }


   public function save_shipping(Request $request){
       $data =array();
       $data['shipping_email'] = $request->shipping_email;
       $data['shipping_first_name'] = $request->shipping_first_name;
       $data['shipping_last_name'] = $request->shipping_last_name;
       $data['shipping_address'] = $request->shipping_address;
       $data['shipping_mobile_number'] = $request->shipping_mobile_number;
       $data['shipping_city'] = $request->shipping_city;

      $shipping_id= DB::table('tbl_shipping')
       ->insertGetId($data);
       Session::put('shipping_id',$shipping_id);
       return Redirect::to ('/payment');

   }

   public function payment(){
       return view('pages.payment');
   }


   public function order_place(Request $request){

       $payment_method = $request->payment_method;

       $payment_data=array();
       $payment_data['payment_method']=$payment_method;
       $payment_data['payment_status']= 'pending';

       $payment_id=DB::table('tbl_payment')
           ->insertGetId($payment_data);


       $order_data=array();
       $order_data['customer_id']=Session::get('customer_id');
       $order_data['shipping_id']=Session::get('shipping_id');
       $order_data['payment_id']=$payment_id;
       $order_data['order_total']=Cart::total();
       $order_data['order_status']='pending';


       $order_id=DB::table('tbl_order')
           ->insertGetId($order_data);


       $contents=Cart::content();

       $order_details=array();

       foreach ($contents as $content){
           $order_details['order_id']=$order_id;
           $order_details['product_id']=$content->id;
           $order_details['product_name']=$content->name;
           $order_details['product_price']=$content->price;
           $order_details['product_sales_quantity']=$content->qty;

           DB::table('tbl_order_details')
               ->insert($order_details);


       }

       if($payment_method=='handcash'){
           Cart::destroy();
          return view('pages.handcash');


       }elseif ($payment_method=='cart'){

           echo"cart";


       }elseif ($payment_method=='paypal'){
           echo "PayPal";
       }
       else
           echo 'not selected';



   }


   public function manage_order(){
       $all_order_info =  DB::table('tbl_order')

           ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
           ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
           ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
           ->select('tbl_order.*', 'tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
           ->get();


       $manage_order= view('admin.manage_order')
           ->with('all_order_info',$all_order_info);
       return view('admin_layout')
           ->with('admin.manage_order', $manage_order);
   }


    public function inactive_order($order_id){
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 'Delivered']);
        Session::put('message','Product  Delivered  !!');
        return Redirect::to('manage-order');
    }


    public function active_order($order_id)
    {

        return Redirect::to('manage-order');

    }

    public function delete_order($order_id){
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->delete();
        Session::get('message','Order Deleted successfully !');
        return Redirect::to('/manage-order');

    }



}
