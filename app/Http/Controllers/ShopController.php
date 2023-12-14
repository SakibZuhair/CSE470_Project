<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {

        $brands = Brand::orderBy("name",'ASC')->get();
        $products = Product::orderBy('created_at','DESC')->paginate(12);
        
        return view('layouts.shop',['products'=>$products,'brands'=>$brands]);
    }

    public function productDetails($slug) {
        $product = Product::where('slug',$slug)->first();
        $rproducts = Product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(8);
        return view('layouts.details',['product'=>$product,'rproducts'=>$rproducts]);
    }
}