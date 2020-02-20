<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();
class HomeController extends Controller
{
    public function index(){
        $all_published_product =  DB::table('tbl_products')
            -> join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*', 'tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_products.publication_status',1)
            ->limit(15)
            ->get();
        $manage_published_product = view('pages.home')
            ->with('all_published_product',$all_published_product);
        return view('layout')
            ->with('pages.home', $manage_published_product);

    }

    public function product_by_category($category_id){
        $product_by_category =  DB::table('tbl_products')
            -> join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->select('tbl_products.*', 'tbl_category.category_name')
            ->where('tbl_category.category_id',$category_id)
            ->where('tbl_products.publication_status',1)
            ->limit(9)
            ->get();
        $manage_product_by_category = view('pages.product_by_category')
            ->with('product_by_category',$product_by_category);
        return view('layout')
            ->with('pages.product_by_category', $manage_product_by_category);
    }

    public function product_by_manufacture($manufacture_id){
        $product_by_manufacture =  DB::table('tbl_products')
            -> join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*', 'tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_manufacture.manufacture_id',$manufacture_id)
            ->where('tbl_products.publication_status',1)
            ->limit(9)
            ->get();
        $manage_product_by_manufacture = view('pages.product_by_manufacture')
            ->with('product_by_manufacture',$product_by_manufacture);
        return view('layout')
            ->with('pages.product_by_manufacture', $manage_product_by_manufacture);
    }

    public function product_details_by_id($product_id){
        $product_by_details =  DB::table('tbl_products')
            -> join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*', 'tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_products.product_id',$product_id)
            ->where('tbl_products.publication_status',1)
            ->first();
        $manage_product_by_details = view('pages.product_details')
            ->with('product_by_details',$product_by_details);
        return view('layout')
            ->with('pages.product_details', $manage_product_by_details);

    }
}

