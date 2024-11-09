<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $table = 'flash_sales';
    public function products()
    {
        return $this->belongsToMany(Product::class, 'flash_sale_items', 'flash_sale_id', 'product_id');
    }

    public function flashSaleItems()
    {
        return $this->hasMany(FlashSaleItem::class);
    }
}
