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
    public function index()
    {
        $coupons = Coupon::paginate(5);
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
                'quantity'=>'required|integer',
                'max_use'=>'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'discount_type'=>'required',
                'discount_value'=>'required|integer',
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
        $code->quantity = $request->quantity;
        $code->max_use = $request->max_use;
        $code->start_date = $request->start_date;
        $code->end_date = $request->end_date;
        $code->discount_type = $request->discount_type;
        $code->discount_value = $request->discount_value;
        // $code->total_use ;
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
            'name'=>['required'],
                'code'=>['required'],
                'quantity'=>['required','integer'],
                'max_use'=>['required','integer'],
                'start_date'=>['required'],
                'end_date'=>['required'],
                'discount_type'=>['required'],
                'discount_value'=>['required','integer'],
                'status'=>['required'],
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
        $code->quantity = $request->quantity;
        $code->max_use = $request->max_use;
        $code->start_date = $request->start_date;
        $code->end_date = $request->end_date;
        $code->discount_type = $request->discount_type;
        $code->discount_value = $request->discount_value;
        // $code->total_use ;
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
}
