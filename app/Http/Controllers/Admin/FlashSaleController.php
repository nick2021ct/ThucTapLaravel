<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');

        $flashSaleInfo = FlashSale::search($searchTerm,['name'])->paginate(5);

        return view('admin.flash_sales.index',compact('flashSaleInfo'));
    }

    public function create()
    {
        $products = Product::all();
        $flashSaleItems = FlashSaleItem::paginate(5);
        return view('admin.flash_sales.create',compact('flashSaleItems','products'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required|numeric',
            'product' => 'required',
        ]);

        $overlapping = FlashSale::where(function($query) use ($request){
            $query->where('start_date', '<=', $request->start_date)
            ->where('end_date', '>=', $request->start_date);
        })->exists();
            
        if($overlapping){
            return redirect()->back()->withErrors(['end_date' => 'Flash sale overlaps with an existing sale.'])->withInput();
        }

        $flashSaleInfor = new FlashSale();
        $flashSaleInfor->name = $request->name;
        $flashSaleInfor->start_date = $request->start_date;
        $flashSaleInfor->end_date = $request->end_date;
        $flashSaleInfor->discount = $request->discount;
        $flashSaleInfor->save();

        foreach($request->product as $productId){
            $flashSaleItem = new FlashSaleItem();
            $flashSaleItem->product_id = $productId;
            $flashSaleItem->flash_sale_id = $flashSaleInfor->id;
            $flashSaleItem->save();
        }

        toastr()->addSuccess('Created Successfully');
        return redirect()->route('admin.flash_sale.index');

    }

    public function edit($id)
    {
        
            $products = Product::all();
            $flashSaleInfo = FlashSale::findOrFail($id);
            $flashSaleItems = FlashSaleItem::paginate(5);
            return view('admin.flash_sales.edit',compact('flashSaleInfo','flashSaleItems','products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required|numeric',
            'product' => 'required',
        ]);
        

        $flashSaleInfor = FlashSale::findOrFail($id);
        $flashSaleInfor->name = $request->name;
        $flashSaleInfor->start_date = $request->start_date;
        $flashSaleInfor->end_date = $request->end_date;
        $flashSaleInfor->discount = $request->discount;
        $flashSaleInfor->save();

        $flashSaleInfor->flashSaleItems()->delete();

        foreach($request->product as $productId){
            $flashSaleItem = new FlashSaleItem();
            $flashSaleItem->product_id = $productId;
            $flashSaleItem->flash_sale_id = $flashSaleInfor->id;
            $flashSaleItem->save();
        }

        toastr()->addSuccess('Updated Successfully');
        return redirect()->route('admin.flash_sale.index'); 
    }

    public function destroy($id)
    {
        $flashSaleInfor = FlashSale::findOrFail($id);
        $flashSaleInfor->delete();
        toastr()->addSuccess('Deleted Successfully');
        return redirect()->back(); 
    }
    
   
}
