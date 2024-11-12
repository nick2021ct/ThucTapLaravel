<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Flasher\Laravel\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use SearchableTrait;
    use HasFactory;

    protected $table='product_variants';

    public function variantItems()
    {

        return $this->hasMany(ProductVariantItem::class, 'product_variant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
