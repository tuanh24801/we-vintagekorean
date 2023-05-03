<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Index extends Component
{

    use WithPagination;
    use WithFileUploads;


    protected $paginationTheme = 'bootstrap';
    public $product_id,$name,$description,$original_price,$selling_price,$image,$image_;

    protected $rules = [
        'name' => 'required',
        'description' => 'nullable|string',
        'original_price' => 'required|integer',
        'selling_price' => 'required|integer',
        'image' => 'image',
    ];

    protected $messages = [
        'name.required' => 'Tên sản phẩm không được bỏ trống',
        'description.string' => 'Sai định dạng chuỗi mô tả',
        'original_price.required' => 'Giá bán gốc không được bỏ trống',
        'original_price.integer' => 'Giá bán gốc phải là kiểu số',
        'selling_price.required' => 'Giá bán khuyến mại không được bỏ trống',
        'selling_price.integer' => 'Giá bán khuyến mại phải là kiểu số',
        // 'image.required' => 'Ảnh sản phẩm không được bỏ trống',
        'image.image' => 'Ảnh sản phẩm phải là định dạng ảnh .jpg, .png,...',
    ];

    public function resetInput(){
        $this->name = null;
        //
        $this->description = null;
        $this->original_price = null;
        $this->selling_price = null;
        $this->image = null;
        $this->image_ = null;
    }

    public function storeProduct(){
        $validateData = $this->validate();
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->name;
        $product->meta_title = $this->name;
        $product->meta_keyword = $this->name;
        $product->meta_description = $this->name;
        $product->description = $this->description;
        $product->original_price = $this->original_price;
        $product->selling_price = $this->selling_price;
        $product->image = time().'.'.$this->image->getClientOriginalExtension();
        $this->image->storeAs('public/product_images', time().'.'.$this->image->getClientOriginalExtension());
        $product->save();
        session()->flash('message','Thêm sản phẩm thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->cleanupOldTempImages();
    }

    public function editProduct(int $product_id){
        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
        $this->name = $product->name;
        $this->description = $product->description;
        $this->original_price = $product->original_price;
        $this->selling_price = $product->selling_price;
        $this->image_ = $product->image;
    }

    public function editImage(int $product_id){
        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
        $this->image_ = $product->image;
    }

    public function updateProduct(){
        $rules = [
            'name' => 'required',
            'description' => 'nullable|string',
            'original_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];
        $validateData = $this->validate($rules);
        $product = Product::findOrFail($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->name;
        $product->meta_title = $this->name;
        $product->meta_keyword = $this->name;
        $product->meta_description = $this->name;
        $product->description = $this->description;
        $product->original_price = $this->original_price;
        $product->selling_price = $this->selling_price;
        $product->update();
        session()->flash('message','Sửa sản phẩm thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->cleanupOldTempImages();
    }

    public function updateImage(){
        $rules = [
            'image' => 'image',
        ];
        $validateData = $this->validate($rules);
        $product = Product::findOrFail($this->product_id);
        if (File::exists(public_path('storage\product_images\\').$product->image)) {
            File::delete(public_path('storage\product_images\\').$product->image);
        }
        $product->image = time().'.'.$this->image->getClientOriginalExtension();
        $this->image->storeAs('public/product_images', time().'.'.$this->image->getClientOriginalExtension());
        $product->update();
        session()->flash('message','Sửa ảnh sản phẩm thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->product_id = null;
        $this->cleanupOldTempImages();
    }

    public function changeStatus(int $product_id){
        $product = Product::findOrFail($product_id);
        if($product->status == 1){
            $product->status = 0;
        }else{
            $product->status = 1;
        }
        $product->update();
        session()->flash('message','Cập nhật trạng thái thành công');
        $this->resetInput();
    }

    public function deleteProduct(int $product_id){
        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
    }

    public function destroyProduct(){
        $product = Product::findOrFail($this->product_id);
        if (File::exists(public_path('storage\product_images\\').$product->image)) {
            File::delete(public_path('storage\product_images\\').$product->image);
        }
        $product->delete();
        session()->flash('message','Đã xóa sản phẩm');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->product_id = null;
    }

    public function cleanupOldTempImages()
    {
        $oldFiles = Storage::files('livewire-tmp');
        foreach ($oldFiles as $file) {
            Storage::delete($file);
        }
    }

    public function render()
    {
        $products = Product::orderBy('id','DESC')->paginate(4);
        return view('livewire.admin.product.index', compact('products'));
    }
}
