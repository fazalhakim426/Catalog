<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductUnit;
class Product extends Model
{
    use HasFactory;
    public $fillable = [ 
        'name','cost','price','description'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'productId');
    }
    public function unit()
    {
        return $this->hasOne(ProductUnit::class,'productId');
    }
}
