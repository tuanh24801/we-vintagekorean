<?php

namespace App\Http\Livewire\Client\Product;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $allCart;
    public $display = 'none';

    public function mount(){
        $this->allCart = Cart::content();
    }

    public function addToCart($product_id){
        $product = Product::findOrFail($product_id);
        foreach ($product->images as $productImage) {
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->selling_price, 'weight' => 0, 'options' => ['image' => $productImage->image]]);
        }
        $this->display = 'block';
        $this->allCart = Cart::content();
    }

    public function openCart(){
        $this->allCart = Cart::content();
    }

    public function closeCart(){
        $this->display = 'none';
    }

    public function clickCart(){
        if($this->display == 'block'){
            $this->display = 'none';
        }else{
            $this->display = 'block';
        }
    }

    public function destroyCart(){
        Cart::destroy();
    }

    public function render()
    {
        $this->allCart = Cart::content();
        $products = Product::orderBy('id', 'ASC')->where('status', 0)->paginate(28);
        return view('livewire.client.product.index', compact('products'));
    }
}
