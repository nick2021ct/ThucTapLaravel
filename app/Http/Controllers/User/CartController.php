<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Traits\CheckFlashSaleProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    use CheckFlashSaleProduct;

    public function index()
    {
        if (Session::has('checkout')) {
            Session::forget('checkout');
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $this->update_cart();
        $carts = Cart::content();

        return view('user.cart', compact('carts'));
    }

    public function update_cart()
    {
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $product = Product::find($cart->id);
            if ($product != null) {

                $price = $this->calculateFlashSalePrice($product);
                
                Cart::update($cart->rowId, ['price' => $price, 'options'  => [
                    'variants' => $cart->options->variants,
                    'image' => $product->thumb_image,
                    'stock' =>  $product->stock,
                    'total' => $price * $cart->qty,
                ]]);
            } else {
                Cart::remove($cart->rowId);
            }
        }
    }


    public function add_to_cart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        if ($product->stock == 0) {
            return response()->json(['status' => 'error', 'message' => 'Product is out of stock']);
        } elseif ($product->stock < $request->qty) {
            return response()->json(['status' => 'error', 'message' => 'Quantity is not availible in our stock']);
        }


        $price = $this->calculateFlashSalePrice($product);

        $variants = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
            }
        }

        $id = $request->product_id;
        $name = $product->name;
        $qty = $request->qty;
        
        $weight = 10;
        $options = [
            'variants' => $variants,
            'image' => $product->thumb_image,
            'stock' =>  $product->stock,
            'total' => $price * $request->qty,
        ];

        Cart::add($id, $name, $qty, $price, $weight, $options);
        toastr()->addSuccess('Cart added successfully');
        return response(['status' => 'success', 'message' => 'cart added successfully']);
    }


    public function update_quantity(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        if ($product->stock == 0) {
            return response()->json(['status' => 'error', 'message' => 'Product is out of stock']);
        } elseif ($product->stock < $request->quantity) {
            return response()->json(['status' => 'error', 'message' => 'Quantity is not availible in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'product_total' => $productTotal]);
    }

    public function remove_cart($rowId)
    {
        Cart::remove($rowId);
        toastr()->addSuccess('cart removed successfully');
        return response(['status'=>'success','message'=>'cart removed successfully']);
    }

    public function remove_all_cart()
    {
        Cart::destroy();
        toastr()->addSuccess('Cart cleared successfully');
        return redirect()->back();
    }

    public function getProductTotal($rowId)
    {
        $cart = Cart::get($rowId);
        $total = ($cart->price * $cart->qty);
        return $total;
    }


    public function getCartSubTotal($rowIds)
    {
        $subtotal = 0;
        if ($rowIds != null) {
            foreach ($rowIds as $rowId) {
                $cart = Cart::get($rowId);
                if ($cart  != null) {
                    $subtotal += $cart->price * $cart->qty;
                }
            }
        } else {
            $subtotal = 0;
        }
        return $subtotal;
    }

    private function calculateDiscount($subtotal)
    {
        $discountValue = 0;
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon['discount_type'] == 'amount') {
                $discountValue = $coupon['discount_value'];
                return $discountValue;
            } elseif ($coupon['discount_type'] == 'percent') {
                $discountValue = ($subtotal * $coupon['discount_value']) / 100;
                return $discountValue;
            }
        }
    }

    public function getCartTotal(Request $request)
    {
        if (Session::has('checkout')) {
            Session::forget('checkout');
        }

        $subtotal = $this->getCartSubTotal($request->rowIds);
        $discountValue = $this->calculateDiscount($subtotal);
        $total = $subtotal-$discountValue;


        return response([
            'status' => 'success',
            'cart_total' => format_price($total),
            'subtotal' => format_price($subtotal),
            'discount_value' => format_price($discountValue),
        ]);
    }

    public function saveCheckoutSession(Request $request)
    {
        $subtotal = $this->getCartSubTotal($request->rowIds);
        $discountValue = $this->calculateDiscount($subtotal);
        $total = $subtotal-$discountValue;

        if ($total != 0) {
            $product_taken = [];
            foreach ($request->rowIds as $rowId) {
                $cart = Cart::get($rowId);
                if ($cart !== null) {
                    $product_taken[] = [
                        'id' => $cart->id,
                        'qty' => $cart->qty,
                        'product_total' => $cart->price * $cart->qty,
                        'variants' => $cart->options['variants'],
                    ];
                }
            }
            Session::put('checkout', [
                'product_taken' => $product_taken,
                'subtotal' => $subtotal,
                'total' => $total,
                'discount_value' => $discountValue,
            ]);

            return response(['status' => 'success', 'message' => 'Checkout session saved successfully']);

        }else{
            return response(['status'=>'error','message'=>'Please add some products before checkout']);
        }

    }



    public function applyCoupon(Request $request)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if ($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'coupon field is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if ($coupon == null || now() <= $coupon->start_date  || now() > $coupon->end_date ) {
            return response(['status' => 'error', 'message' => 'coupon not exist']);
        } elseif ($coupon->total_user >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'you cannot apply this coupon']);
        }

        Session::put('coupon', [
            'coupon_name' => $coupon->name,
            'coupon_code' => $coupon->code,
            'discount_type' => $coupon->discount_type == 'amount' ? 'amount' : 'percent',
            'discount_value' => $coupon->discount_value,

        ]);
        return response(['status' => 'success', 'message' => 'coupon applied successfully']);
    }

   
}
