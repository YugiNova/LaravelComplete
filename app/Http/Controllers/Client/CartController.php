<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        // dd(session()->get('cart'));
        $cart = session()->get('cart') ?? [];
        return view('client.pages.shoping_cart', compact('cart'));
    }

    public function calculateTotalPrice(array $cart)
    {
        $totalPrice = 0;
        $totalProduct = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['qty'] * $item['price'];
            $totalProduct += $item['qty'];
        }
        return [$totalPrice,$totalProduct];
    }

    public function addProductToCart($product, $qty = 1)
    {
        $product = Product::find($product);

        if ($product) {
            $cart = session()->get('cart') ?? [];
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => number_format($product->price, 2),
                'image_url' => $product->image_url,
                // 'qty' => ($cart[$product->id]['qty'] ?? 0) + 1
                'qty' => ($cart[$product->id]['qty'] ?? 0) + $qty,
            ];
            session()->put('cart', $cart);
            $totalProduct = count($cart);
            $totalPrice = $this->calculateTotalPrice($cart);
            return response()->json(['message' => 'Add product to cart success', 'totalProduct' => $totalProduct, 'totalPrice' => $totalPrice]);
        } else {
            return response()->json(['message' => 'Product not found'], 400);
        }
    }

    public function deleteCartItem($product) {
        $cart = session()->get('cart') ?? [];
        if(array_key_exists($product,$cart)){
            unset($cart[$product]);
            session()->put('cart', $cart);
            $totalProduct = count($cart);
            $totalPrice = $this->calculateTotalPrice($cart)[0];

            return response()->json(['message' => 'Delete product frpm cart success', 'totalProduct' => $totalProduct, 'totalPrice' => $totalPrice]);
        }
        else {
            return response()->json(['message' => 'Product not found'], 400);
        }
    }

    public function updateCartItem($product,$qty) {
        $cart = session()->get('cart') ?? [];
        if(array_key_exists($product,$cart)){
            $cart[$product]['qty'] = $qty;
            if(!$qty){
                unset($cart[$product]);
            }
            session()->put('cart', $cart);
            $totalProduct = count($cart);
            $totalPrice = $this->calculateTotalPrice($cart)[0];

            return response()->json(['message' => 'Update product frpm cart success', 'totalProduct' => $totalProduct, 'totalPrice' => $totalPrice]);
        }
        else {
            return response()->json(['message' => 'Product not found'], 400);
        }
    }

    public function deleteCart(){
        session()->put('cart',[]);
        return response()->json(['message'=>'Delete cart successfull']);
    }
}
