<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Str;

class POSController extends Controller
{
    public function index()
    {

        // if(session()->has('pos')){
        //     session()->forget('pos');
        // }


        $products = Product::where('status', 1)->get();

        $pos = FacadesSession::get('pos');
        return view('admin.pos.index',compact('products','pos'));
    }

    public function addToPOS(Request $request)
    {
    $pos = session()->get('pos', []);
    $product = Product::findOrFail($request->product_id);

    $price = $product->price;

    $quantity = $request->qty;

    if($quantity == null){
        toastr()->addError('please add quantity first');
        return redirect()->back();
    }
    $variants = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
            }
        }


        if (isset($pos['product'][$product->id]) && $pos['product'][$product->id]['variants'] == $variants) {
            $pos['product'][$product->id]['quantity']++;
        } else {
        $pos['product'][$product->id] = [
            'id' => $request->product_id,
            'name' => $product->name,
            'price' => $price,
            'quantity' => $quantity,
            'variants'=>  $variants,
            'product_total'=> $price * $quantity
        ];
    }
    $total = $this->caculateTotal($pos);
    
    
    session()->put('pos', [
        'product' => $pos['product'],
        'total' => $total,
    ]);


    return redirect()->back();
    }   

    public function removeFromPOS($id)
    {
        $pos = session()->get('pos');

        
        if (isset($pos['product'][$id])) {
            unset($pos['product'][$id]);
            
        }
        $total = $this->caculateTotal($pos);
        session()->put('pos', [
            'product' => $pos['product'],
            'total' => $total,
        ]);
        return redirect()->back();
    }
    public function checkout(Request $request)
    {
    $pos = session()->get('pos', []);
    $total = array_sum(array_column($pos['product'], 'product_total'));

    if(!$request->has('amount_paid') || !is_numeric($request->amount_paid)){
        toastr()->addError('Input must be numeric');
        return redirect()->back();
    }
    elseif ($request->amount_paid < $total) {
        toastr()->addError('The amount given is not enough.');
        return redirect()->back();
    }else{

       $order = new Order;
    $order->order_code = 'ODR-'.uniqid().Str::random(20);
    $order->subtotal = $total;
    $order->discount = 0;
    $order->total = $total;
    $order->payment_method = 'cash';
    $order->status = 'completed';
    $order->save();

    foreach ($pos['product'] as $product) {
        $orderProduct = new OrderProduct;
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product['id'];
        $orderProduct->quantity = $product['quantity'];
        $orderProduct->variants = json_encode($product['variants']);
        $orderProduct->product_total = $product['product_total'];
        $orderProduct->save();
    }
    session()->forget('pos');
    toastr()->addSuccess('Checkout completed');
    return redirect()->back();
    }
    
    }

    public function caculateTotal($pos)
{
    if(empty($pos['product'])){
        $total = 0;
    } else {
        $total = array_sum(array_column($pos['product'], 'product_total'));
    }
    
    return $total;
}
}
