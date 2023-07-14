<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart(){
        $cart = session()->get('cart') ?? [];
        return view('client.pages.shoping_cart', compact('cart'));
    }

    public function addProductToCart($product) {
        $product = Product::find($product);

        if($product){
            $cart = session()->get('cart') ?? [];
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => number_format($product->price,2),
                'image_url' => $product->image_url,
                'qty' => ($cart[$product->id]['qty'] ?? 0) + 1
            ];
            session()->put('cart',$cart);
            return response()->json(['message'=> 'Add product to cart success']);
        }
        else{
            return response()->json(['message'=> 'Product not found'],400);
        }
    }
}
