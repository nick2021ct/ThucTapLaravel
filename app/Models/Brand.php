<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $table = "brands";

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
