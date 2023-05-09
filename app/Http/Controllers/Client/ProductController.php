<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    public function index(){
        Cart::setGlobalTax(0);
        $allCart = Cart::content();
        $products = Product::orderBy('id','desc')->where('status',0)->paginate(24);
        return view('clients.products.list-product', compact('products','allCart'));
    }

    public function addCart(Request $request){
        $quantity = 1;
        $product = Product::findOrFail($request->product_id);
        foreach ($product->images as $productImage) {
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->selling_price, 'weight' => 0, 'options' => ['image' => $productImage->image]]);
        }

        return response()->json(['message' => 'Đã thêm sản phẩm vào giỏ hàng']);
        // dd();
    }

    public function destroyCart(){
        // Cart::update('38146a7ef774b54f0b74a3dec2597005', 2);
        Cart::destroy();
        return redirect()->back();
    }

    public function updateCart( $rowId,  $qty){
        // dd($rowId, $qty);
        Cart::update($rowId, $qty);
        return redirect()->back();
    }
}
