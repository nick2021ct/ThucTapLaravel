<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flashSale = FlashSale::where('status', 1)->first();
        $flashSaleProductId = $flashSale != null ? $flashSale->flashSaleItems()->pluck('product_id')->toArray() : [];
        $products = Product::where('status',1)->whereNotIn('id', $flashSaleProductId)->get();
        $flashSaleProduct = Product::where('status',1)->where('id', $flashSaleProductId)->get();
        return view('user.home',compact('products','flashSaleProduct','flashSale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flashSale = FlashSale::where('status', 1)->first();
        $flashSaleProductId = $flashSale != null ? $flashSale->flashSaleItems()->pluck('product_id')->toArray() : [];
        $product = Product::findOrFail($id);
        $isFlashSaleProduct = in_array($product->id, $flashSaleProductId);

        $product = Product::findOrFail($id);

        return view('user.detail',compact('product','flashSale','isFlashSaleProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
