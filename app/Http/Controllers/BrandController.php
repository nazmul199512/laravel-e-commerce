<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
#use MongoDB\Driver\Session;
session_start();
class BrandController extends Controller
{
    public function index(){

        return view('admin.add_brand');
    }

    public function  save_brand(Request $request){

        $data=array();
        $data['manufacture_id']=$request->manufacture_id;
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        $data['manufacture_status']=$request->manufacture_status;

        DB::table('tbl_manufacture')->insert($data);

        Session::put('message','Brand Added successfully !!');

        return Redirect::to('/add-brand');
    }

    public function all_brands(){
        $all_manufacture_info =  DB::table('tbl_manufacture')->get();
        $manage_manufacture = view('admin.all_brands')
            ->with('all_manufacture_info',$all_manufacture_info);
        return view('admin_layout')
            ->with('admin.all_brands', $manage_manufacture);

    }

    public function inactive_brands($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update(['manufacture_status' => 0]);
        Session::put('message','Brand Deactivate successfully !!');
        return Redirect::to('all-brands');
    }


    public function active_brands($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update(['manufacture_status' => 1]);
        Session::put('message','Brand activate successfully !!');
        return Redirect::to('all-brands');
    }

    public function edit_brand($manufacture_id){
        $manufacture_info=DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->first();
        $manufacture_info=view('admin.edit_brand')
            ->with('manufacture_info',$manufacture_info);
        return view('admin_layout')
            ->with('admin.edit_brand',$manufacture_info);
    }

    public function update_brand(Request $request, $manufacture_id){
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;

        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update($data);
        Session::get('message','Brand Updated Successfully !');
        return Redirect::to('/all-brands');
    }

    public function delete_brand($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->delete();
        Session::get('message','Brand Deleted successfully !');
        return Redirect::to('/all-brands');

    }
}
