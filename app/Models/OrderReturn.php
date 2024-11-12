<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $table= 'order_returns';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function returnProducts()
    {
        return $this->hasMany(ReturnProduct::class);
    }

}
