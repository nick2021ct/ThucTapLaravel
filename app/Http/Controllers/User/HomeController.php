<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $brands = Brand::where('status',1)->get();

        $searchTerm = $request->input(key: 'search');
        $products = Product::query();

        $products->when($request->brands, function ($query, $brands) {
            return $query->whereIn('brand_id', $brands);
        });
    
        $products->when($request->min_price, function ($query, $minPrice) {
            return $query->where('price', '>=', $minPrice);
        });
    
        $products->when($request->max_price, function ($query, $maxPrice) {
            return $query->where('price', '<=', $maxPrice);
        });
    
        $products->when($request->state, function ($query, $sort) {
            switch ($sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        });

        $products = $products->search($searchTerm,['name'])->where('status',1)->paginate(10);

        return view('user.home',compact('products','brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);


        return view('user.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */

}
