<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;
use App\Http\Requests\ProductFormRequest;
use App\Http\Requests\ProductFormUpdateRequest;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        return view('admin.products.index');
    }

    public function create(){
        $colors = Color::all();
        return view('admin.products.create', compact('colors'));
    }

    public function store(ProductFormRequest $request){
        $validateData = $request->validated();
        // dd($validateData['name']);
        $name = $validateData['name'];
        $slug = 'Đầm-vin-nhật-hàn-2023-'.$name;
        $description = $validateData['description'];
        $original_price = $validateData['original_price'];
        $selling_price = $validateData['selling_price'];
        $meta_title = 'Đầm vin nhật hàn 2023 '.$name;
        $meta_keyword = 'Đầm vin nhật hàn 2023 '.$name;
        $meta_description = 'Đầm vin nhật hàn 2023 '.$name;

        $product = new Product();
        $product->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'original_price' => $original_price,
            'selling_price' => $selling_price,
            'meta_title' => $meta_title,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
        ]);

        $product = Product::orderBy('id', 'desc')->first();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $uploadPath = 'storage/product_images/';
            $extention = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extention;
            $file->move($uploadPath, $fileName);
            $finalImagePathName = $uploadPath.$fileName;
            $product->images()->create([
                'product_id' => $product->id,
                'image' => $finalImagePathName,
            ]);
        }

        if($request->colors){
            foreach ($request->colors as $key => $color) {
                // echo $product->id;
                // echo $key;
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $key
                ]);
            }
        }
        return redirect('we-admin/products')->with('message', 'Thêm sản phẩm thành công');
    }

    public function edit(Product $product){
        $colors = Color::all();
        return view('admin.products.edit', compact('product','colors'));
        // dd($product);
    }

    public function update(ProductFormUpdateRequest $request, Product $product){
        $validateData = $request->validated();

        if(isset($validateData['name'])){
            $product->name = $validateData['name'];
        }
        if(isset($validateData['description'])){
            $product->description = $validateData['description'];
        }
        if(isset($validateData['original_price'])){
            $product->original_price = $validateData['original_price'];
        }
        if(isset($validateData['selling_price'])){
            $product->selling_price = $validateData['selling_price'];
        }
        if($request->hasFile('image')){
            foreach ($product->images as $product_image) {
                if (File::exists(public_path($product_image->image))) {
                    File::delete(public_path($product_image->image));
                }
                $product_image->delete();
            }
            $file = $request->file('image');
            $uploadPath = 'storage/product_images/';
            $extention = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extention;
            $file->move($uploadPath, $fileName);
            $finalImagePathName = $uploadPath.$fileName;
            $product->images()->create([
                'product_id' => $product->id,
                'image' => $finalImagePathName,
            ]);
        }
        if(isset($request->colors)){
            if(!empty($request->colors)){
                foreach ($product->productColors as $productColors) {
                    $productColors->delete();
                }
                foreach ($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $key
                    ]);
                }
            }
        }
        $product->update();
        return redirect('we-admin/products')->with('message', 'Sửa sản phẩm thành công');
    }

}
