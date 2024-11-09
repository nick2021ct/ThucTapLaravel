<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('checkout')) {
            $checkOutInfo = Session::get('checkout');
            $productsTakenId = [];
            foreach ($checkOutInfo['product_taken'] as $product) {
                $productsTakenId[] = $product['id'];
            }
            $products = Product::whereIn('id', $productsTakenId)->get()->keyBy('id');
            $addresser = Auth::check() ? UserAddress::where('user_id', auth()->id())->get() : null;
            return view('user.checkout', compact('addresser', 'checkOutInfo','products'));
        }else{
            return redirect()->route('home');
        }

    }

    public function cash_method(Request $request)
    {
        $checkoutInfo = Session::get('checkout');
        $order = new Order;
        $order->user_id = Auth::check() ? Auth::user()->id : null;
        $order->order_code = 'ODR-'.uniqid().Str::random(20);
        $order->subtotal = $checkoutInfo['subtotal'];
        $order->discount = $checkoutInfo['discount_value']  ?? 0;
        $order->total = $checkoutInfo['total'];
        $order->payment_method = 'cash';     
        $order->save();

        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'shipping_address_id'=>'required',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'province'=>'required',
                'district'=>'required',
                'ward'=>'required',
                'zip'=>'required',
                'address_type'=>'required',
                'specific_address'=>'required'
            ]);
        }
        if ($validator->fails()) {
            $order->delete();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->addressCheckout($request,$order->id);
        $this->productCheckout($order->id);

        Session::forget('checkout');
        toastr()->addSuccess('Checkout Successfully');
        return redirect()->route('home');
        
    }

    public function productCheckout($orderId)
    {
        $checkoutInfo = Session::get('checkout');
        foreach ($checkoutInfo['product_taken'] as $product) {
            $orderProducts = new OrderProduct;
            $orderProducts->order_id = $orderId;
            $orderProducts->product_id = $product['id'];
            $orderProducts->quantity = $product['qty'];
            $orderProducts->product_total = $product['product_total'];
            $orderProducts->variants = json_encode($product['variants']);
            $orderProducts->save();
        }
    }

    public function addressCheckout(Request $request, $orderId)
    {
        $orderAddress = new OrderAddress;
        $orderAddress->order_id =  $orderId;
        if(Auth::check()){
            $userAddress = UserAddress::findOrFail($request->shipping_address_id);
            $orderAddress->name = $userAddress->name;
            $orderAddress->email = $userAddress->email;
            $orderAddress->phone = $userAddress->phone;
            $orderAddress->province = $userAddress->province;
            $orderAddress->district = $userAddress->district;
            $orderAddress->ward = $userAddress->ward;
            $orderAddress->zip = $userAddress->zip;
            $orderAddress->address_type = $userAddress->address_type;
            $orderAddress->specific_address = $userAddress->specific_address;
        }else{
            $orderAddress->name = $request->name;
            $orderAddress->email = $request->email;
            $orderAddress->phone = $request->phone;
            $orderAddress->province = $request->province;
            $orderAddress->district = $request->district;
            $orderAddress->ward = $request->ward;
            $orderAddress->zip = $request->zip;
            $orderAddress->address_type = $request->address_type;
            $orderAddress->specific_address = $request->specific_address;
        }
        $orderAddress->save();
    }

    /**
     * Show the form for creating a new resource.
     */
  
}
