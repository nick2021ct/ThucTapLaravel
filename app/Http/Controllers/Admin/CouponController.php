<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');
        $coupons = Coupon::search($searchTerm,['name'])->paginate(5);
        return view('admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $validator = Validator::make($request->all(),[
            'name'=>'required',
                'code'=>'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'discount_type'=>'required',
                'discount_value'=>'required|integer|gt:0',
                'status'=>'required',
        ]);

        $validator->after(function ($validator) use ($request){
            if($request->discount_type == 1 && $request->discount_value > 100){
                $validator->errors()->add('discount_value','The discount value cannot exceed 100 when the discount type is percentage');
            }
         
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $code = new Coupon();
        $code->name = $request->name;
        $code->code = $request->code;
        $code->start_date = $request->start_date;
        $code->end_date = $request->end_date;
        $code->discount_type = $request->discount_type;
        $code->discount_value = $request->discount_value;
        $code->status = $request->status;
        $code->save();

        toastr()->addSuccess('Created Successfully');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
                'code'=>'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'discount_type'=>'required',
                'discount_value'=>'required|integer|gt:0',
                'status'=>'required',
        ]);

        $validator->after(function ($validator) use ($request){
            if($request->discount_type == 1 && $request->discount_value > 100){
                $validator->errors()->add('discount_value','The discount value cannot exceed 100 when the discount type is percentage');
            }
            if($request->start_date > $request->end_date){
                $validator->errors()->add('start_date','The start date cannot be greater than the end date');
            }
            if($request->start_date < today()){
                $validator->errors()->add('start_date','The start date cannot be less than today');
            }
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $code = Coupon::findOrFail($id);
        $code->name = $request->name;
        $code->code = $request->code;
        $code->start_date = $request->start_date;
        $code->end_date = $request->end_date;
        $code->discount_type = $request->discount_type;
        $code->discount_value = $request->discount_value;
        $code->status = $request->status;
        $code->save();

        toastr()->addSuccess('Updated Successfully');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $code = Coupon::findOrFail($id);
        $code->delete();
        toastr()->addSuccess('Deleted Successfully');
        return redirect()->route('admin.coupon.index');
    }

    public function changeStatus($id)
    {
        $code = Coupon::findOrFail($id);
        $code->status = $code->status == 1 ? 0 : 1;
        $code->save();
        return response(["status"=>"success","message"=>"Status changed successfully"]);
    }
}
