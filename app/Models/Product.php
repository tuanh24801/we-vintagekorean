<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\ProductColor;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name','slug', 'description', 'original_price', 'selling_price','status',
                            'image', 'meta_title', 'meta_keyword', 'meta_description'];

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id');
    }


    public function productColors(){
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }



}
