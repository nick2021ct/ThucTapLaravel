<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = Order::with('user')->paginate(5);
        return view('admin.orders.index',compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function changeOrderStatus(Request $request,$id)
    {
        $order = Order::findOrFail($id);

        if(in_array($order->status,['shipped','completed']) && $request->status == 'canceled'){
            return response(['status' => 'error','message' => 'Cannot change status from ' . $order->status . ' to ' . $request->status . '.']);
        }else{
            $order->status = $request->status;
            $order->save();
            return response(['status'=>'success','message'=>'Status changed successfully']);
        }
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderProduct = OrderProduct::with('product')->where('order_id', $id)->get();
        $orderAddress = OrderAddress::where('order_id',$id)->first();

        return view('admin.orders.show',compact('orderProduct','orderAddress','order'));
    }

    public function changeOrderAddress(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'zip' => 'nullable|string|max:10',
            'address_type' => 'required|string',
            'specific_address' => 'required|string|max:255',
        ]);

        $orderAddress = OrderAddress::where('order_id',$id)->first();
        $orderAddress->order_id = $id;
        $orderAddress->name = $request->name;
        $orderAddress->email = $request->email;
        $orderAddress->phone = $request->phone;
        $orderAddress->province = $request->province;
        $orderAddress->district = $request->district;
        $orderAddress->ward = $request->ward;
        $orderAddress->zip = $request->zip;
        $orderAddress->address_type = $request->address_type;
        $orderAddress->specific_address = $request->specific_address;
        $orderAddress->save();
        toastr()->addSuccess('Order address changed successfully');
        return redirect()->back();
    }
   
}
