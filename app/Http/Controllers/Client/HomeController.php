<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $products = Product::latest()->take(8)->get();
        // $categories = ProductCategory::latest()->take(8)->get()->filter(function($categories){
        //     return $categories->products->count();
        // });
        return view('client.pages.home',compact('products'));
    }
}
