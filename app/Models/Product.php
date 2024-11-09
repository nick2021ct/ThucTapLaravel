<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $table = "products";

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productType()
    {
        return $this->hasOne(ProductType::class);
    }

    public function productImageGallery()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
