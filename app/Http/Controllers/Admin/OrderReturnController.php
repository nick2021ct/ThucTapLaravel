<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');
        $order_return = OrderReturn::search($searchTerm,['order_id'])->paginate(5);
        return view('admin.order_returns.index',compact('order_return'));
    }

    public function changeStatus(Request $request, $id)
    {
        $order_return = OrderReturn::findOrFail($id);

        if ($order_return->status == 'accepted' && $request->status == 'canceled') {
            return response([
                'status' => 'error',
                'message' => 'Cannot change status from ' . $order_return->status . ' to ' . $request->status . '.'
            ]);
        } else {
            $order_return->status = $request->status;
            $order_return->save();

            return response([
                'status' => 'success',
                'message' => 'Status changed successfully'
            ]);
        }
    }
    
}
