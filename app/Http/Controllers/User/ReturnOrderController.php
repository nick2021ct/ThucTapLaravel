<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReturnOrderController extends Controller
{



    public function returnOrder($id)
    {

        //         if(session()->has('order_return_info')){
        //     session()->forget('order_return_info');
        // }
        $order = Order::findOrFail($id);
        $orderAddress = OrderAddress::where('order_id',$id)->first();
        $orderProduct = OrderProduct::where('order_id',$id)->get();
        $order_return_info = Session::get('order_return_info');
        return view('user.profile_account.orders.return',compact('orderProduct','order','order_return_info','orderAddress'));
    }

    public function selectProduct(Request $request,$id)
    {
        $product_total = $request->price * $request->quantity;
        
        $order_return_info = session()->get('order_return_info',[]);

        $orderProducts = OrderProduct::findOrFail($id);

        $order_return_info['product'][$orderProducts->product->id] = [
            'product_id' => $orderProducts->product->id,
            'name' => $orderProducts->product->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'variants' => $orderProducts->variants,
            'product_total' => $product_total,
        ];

        $total_refund = $this->caculateTotalRefund($order_return_info);

        $order_return_info['total_refund'] = $total_refund ;        

            
        session()->put('order_return_info',$order_return_info);

        toastr()->addSuccess('Select product successfully');
        return redirect()->back();

    }

    public function unselectProduct($id)
    {
        

        $order_return_info = session()->get('order_return_info',[]);
        unset($order_return_info['product'][$id]);

        $total_refund = $this->caculateTotalRefund($order_return_info);

        $order_return_info['total_refund'] = $total_refund ;

        session()->put('order_return_info',$order_return_info);
        toastr()->addSuccess('Unselect product successfully');
        return redirect()->back();
        
    }

    
    public function submitReturn(Request $request,$id)
    {
        $request->validate([
            'return_reason'=> 'required'
        ]);

        $order_return_info = session()->get('order_return_info',[]);
        $order = Order::findOrFail($id);
        $order->status = 'return_order';
        $order->save();

        $order_return = new OrderReturn;
        $order_return->order_id = $id;
        $order_return->total_refund = $order_return_info['total_refund'] ?? 0;
        $order_return->return_reason = $request->return_reason;
        $order_return->status = 'pending';
        $order_return->save();

        foreach ($order_return_info['product'] as $product) {
            $return_product = new ReturnProduct;
            $return_product->order_return_id = $order_return->id;
            $return_product->order_products_id = $product['product_id'];
            $return_product->quantity = $product['quantity'];
            $return_product->price = $product['price'];
            $return_product->variants = $product['variants'];
            $return_product->product_total = $product['product_total'];
            $return_product->save();
        }

        session()->forget('order_return_info');
        
        toastr()->addSuccess('Return order request successful');
        return redirect()->route('home');
    }

    public function caculateTotalRefund($order_return_info)
    {
        if (empty($order_return_info['product'])) { 
            $order_return_info['total_refund'] = 0;  

        }
        $total_refund = array_sum(array_column($order_return_info['product'], 'product_total')) ;
        return $total_refund;
    }
}
