<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';

    protected $fillable = ['product_id','color_id'];

    // public function product(){
    //     return $this->belongsTo(Post::class, 'product_id','id');
    // }


}
