<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

function format_price($price){
    return number_format($price, 0, ',', '.') . ' VND';

}
function discount_price($price,$precent)
{
   return $price - ($price * $precent/100);
}

function showProductTotal(){
    $total = 0;
    foreach(Cart::content() as $cart){
        $total += $cart->price*$cart->qty;
    }
    return $total;
}




