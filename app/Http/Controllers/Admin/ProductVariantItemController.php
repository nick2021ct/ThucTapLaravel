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
     * Display a listing of the resource.
     */
    public function index($productId,$variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        $variantItems = ProductVariantItem::where('product_variant_id',$variantId)->paginate(5);
        return view('admin.products.product-variant-item.index',compact('variantItems','product','variant'));
    }

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
        return redirect()->route('admin.product_variant_item.index',['productId'=>$request->product_id,'variantId'=>$request->variant_id]);
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
        return redirect()->route('admin.product_variant_item.index',['productId'
        =>$variantItem->productVariant->product_id,'variantId'=>$variantItem->product_variant_id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->delete();
        toastr()->addSuccess(message: 'Deleted Successfully');
        return redirect()->route('admin.product_variant_item.index',['productId'
        =>$variantItem->productVariant->product_id,'variantId'=>$variantItem->product_variant_id]);
    }
}
