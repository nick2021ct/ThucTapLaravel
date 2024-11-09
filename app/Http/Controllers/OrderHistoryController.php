<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $orders = Order::where('user_id',Auth::user()->id)->get();
            return view('user.dashboard.orders.index',compact('orders'));
        }
        else{
            return view('user.dashboard.orders.check_order_code');
        }
    }

    public function showAuth($id)
    {
        $order = Order::findOrFail($id);
        $orderProduct = OrderProduct::where('order_id',$id)->get();
        $orderAddress = OrderAddress::where('order_id',$id)->first();

        return view('user.dashboard.orders.order_auth',compact('orderProduct','orderAddress','order'));
    }

    public function show(Request $request)
    {
        $order = Order::where('order_code',$request->order_code)->first();
        $orderProduct = OrderProduct::where('order_id',$order->id)->get();
        $orderAddress = OrderAddress::where('order_id',$order->id)->first();
        return view('user.dashboard.orders.order',compact('orderProduct','orderAddress','order'));

    }

    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        if($order->status !== 'canceled'){
        if(in_array($order->status,['shipped','completed'])){
            toastr()->addError('Order cannot be canceled once the status has been delivered, completed');
        }
        else{
            toastr()->addSuccess('Order canceled successfully');
            $order->status = "canceled";
            $order->save();
        }
        }else{
            toastr()->addSuccess('Order reorder successfully');
            $order->status = "pending";
            $order->save();
        }

        return redirect()->back();
    }
}
