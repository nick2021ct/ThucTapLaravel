<?php
namespace App\Traits;

use App\Models\FlashSale;

trait CheckFlashSaleProduct
{
    public function calculateFlashSalePrice($product)
    {
        $flashSale = FlashSale::where('status', 1)->first();
        $flashSaleProductId = $flashSale != null ? $flashSale->flashSaleItems()->pluck('product_id')->toArray() : [];
        
        if ($flashSale != null && in_array($product->id, $flashSaleProductId)) {
            $price = discount_price($product->price, $flashSale->discount);
        } else {
            $price = $product->price;
        }

        return $price;
    }
}
