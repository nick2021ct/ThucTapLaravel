<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    protected $table= 'return_products';

    public function orderReturn()
    {
        return $this->belongsTo(OrderReturn::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class, 'order_products_id');
}
}
