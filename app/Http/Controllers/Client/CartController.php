<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(){
        // dd(Cart::content());
        Cart::setGlobalTax(0);
        $allCart = Cart::content();
        return view('clients.cart.index', compact('allCart'));
    }

    public function deleteItem($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
}
