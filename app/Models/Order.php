<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $table = 'orders';



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderReturn()
    {
        return $this->hasOne(OrderReturn::class);
    }
    
}
