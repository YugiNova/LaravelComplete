<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(string $slug){
        $product = Product::where('slug',$slug)->first();
        // $categories = ProductCategory::latest()->take(8)->get()->filter(function($categories){
        //     return $categories->products->count();
        // });
        return view('client.pages.shop_details',compact('product'));
    }
}
