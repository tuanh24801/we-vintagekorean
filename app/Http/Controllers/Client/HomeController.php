<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Color;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index(Request $request){
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // dd(Cart::content());
        Cart::setGlobalTax(0);
        $allCart = Cart::content();
        $colors = Color::all();
        $productColors = ProductColor::all();
        $products = Product::orderBy('id','desc')->where('status',0)->paginate(12);
        return view('clients.home.index', compact('products','colors','allCart'));
    }
}
