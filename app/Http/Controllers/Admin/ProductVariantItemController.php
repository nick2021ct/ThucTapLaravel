<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $productId, string $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);

        return view('admin.products.product-variant-item.create',compact('variant','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'variant_id'=>['integer','required'],
            'name'=>['required'],
            'status'=>['required']
        ]);
        
        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr()->addSuccess('Created Successfully');
        return to_route('admin.product_variant.index',['product'=>$request->product_id]);
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
        
        $variantItems = ProductVariantItem::findOrFail($id);
        return view('admin.products.product-variant-item.edit',compact('variantItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name'=>['required'],
            'status'=>['required']
        ]);
        
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->name = $request->name;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr()->addSuccess(message: 'Updated Successfully');
        return to_route('admin.product_variant.index',['product'=>$request->product_id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->delete();
        toastr()->addSuccess(message: 'Deleted Successfully');
        return redirect()->back();

    }

    public function changeStatus($id)
    {
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->status = $variantItem->status == 1 ? 0 : 1;
        $variantItem->save();
        return response(["status"=>"success","message"=>"Status changed successfully"]);
    }
}
