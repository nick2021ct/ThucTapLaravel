<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Validator;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $searchTerm = $request->input(key: 'search');

        $product = Product::findOrFail($request->product);
        $product_variants = ProductVariant::search($searchTerm,['name'])->with('variantItems')->where('product_id',$request->product)->paginate(5);
        return view('admin.products.product-variant.index',compact('product_variants','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => ['required','integer'],
            'name' => ['required'],
            'status'=>['required']
        ]);
        

        $variant = new ProductVariant();
        $variant->product_id = $request->product_id;
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr()->addSuccess('Created successfull');
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
        $product_variant = ProductVariant::findOrFail($id);
        return view('admin.products.product-variant.edit',compact('product_variant'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'status'=>['required']
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr()->addSuccess('Updated successfull');
        return to_route('admin.product_variant.index',['product'=>$variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();
        toastr()->addSuccess('Deleted successfull');
        return to_route('admin.product_variant.index',['product'=>$variant->product_id]);
    }

    public function changeStatus($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->status = $variant->status == 1 ? 0 : 1;
        $variant->save();
        return response(["status"=>"success","message"=>"Status changed successfully"]);
    }
}
