<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = ['name','code','status'];

    public function products(){
        return $this->belongsToMany(Color::class, 'product_colors', 'color_id', 'product_id');
    }
}
