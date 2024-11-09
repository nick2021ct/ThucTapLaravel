<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');
        $products = Product::search($searchTerm,['name'])->paginate(5);

         return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands  = Brand::all();
        return view('admin.products.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'thumb_image' => ['required'],
            'stock' => ['required'],
            'brand' => ['required'],
            'sku' => ['required'],
            'price' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'status' => ['required'],
            'image' => ['array', 'max:5'],
            'image.*'=>['image'],

        ]);
        
        $product = new Product();

        $imagePath = $this->uploadImage($request,'thumb_image','uploads/thumb_image');

        $product->name = $request->name;
        $product->thumb_image = $imagePath;
        $product->stock = $request->stock;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        $product->save();

        $this->uploadProductType($request,$product);
        $this->uploadProductImages($request, $product);

        toastr()->addSuccess('Created Successfull');
        return redirect()->route('admin.product.index');

    }


    public function uploadProductType(Request $request, Product $product)
    {
        $productType = new ProductType();
        $productType->product_id = $product->id;
        $productType->top = $request->has('top') ? true : false;
        $productType->best = $request->has('best') ? true : false;
        $productType->new = $request->has('new') ? true : false;
        $productType->featured = $request->has('featured') ? true : false;
        $productType->save();

    }

    public function uploadProductImages(Request $request, Product $product)
{

    if ($request->hasFile('image')) {
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads/image');

        foreach ($imagePaths as $path) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $path;
            $productImageGallery->product_id = $product->id; 
            $productImageGallery->save();
            
        }
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $product = Product::findOrFail($id);
        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brands  = Brand::all();
        $product = Product::findOrFail($id);
        $productImageGallery = ProductImageGallery::where('product_id',$product->id)->get();
        return view('admin.products.edit',compact('brands','product','productImageGallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'stock' => ['required'],
            'brand' => ['required'],
            'sku' => ['required'],
            'price' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'status' => ['required'],
            'image' => ['array', 'max:5'],
            'image.*'=>['image'],

        ]);
        
        $product =  Product::findOrFail($id);

        $imagePath = $this->updateImage($request,'thumb_image','uploads/thumb_image',$product->thumb_image);

        $product->name = $request->name;
        $product->thumb_image = $imagePath;
        $product->stock = $request->stock;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        $product->save();

        $this->updateProductType($request, $product);
        $this->updateProductImages($request, $product);


        toastr()->addSuccess('Updated Successfull');
        return redirect()->route('admin.product.index');
    }

    public function updateProductType(Request $request, Product $product)
    {

        $productType = ProductType::findOrFail($product->productType->id);
        $productType->product_id = $product->id;
        $productType->top = $request->has('top') ? true : false;
        $productType->best = $request->has('best') ? true : false;
        $productType->new = $request->has('new') ? true : false;
        $productType->featured = $request->has('featured') ? true : false;
        $productType->save();

    }

    public function updateProductImages(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $oldPaths = ProductImageGallery::where('product_id', $product->id)->pluck('image')->toArray();
            $imagePaths = $this->updateMultiImage($request, 'image', 'uploads/image', $oldPaths);
            ProductImageGallery::where('product_id', $product->id)->delete();

            foreach ($imagePaths as $path) {
                $productImageGallery = new ProductImageGallery();
                $productImageGallery->image = $path;
                $productImageGallery->product_id = $product->id; 
                $productImageGallery->save();
                
            }
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product =  Product::findOrFail($id);
        $productImageGallery =ProductImageGallery::where('product_id', $product->id)->get();
        $this->deleteImage($product->thumb_image);
        if($productImageGallery->isNotEmpty()){
            foreach($productImageGallery as $productImage){
                $this->deleteImage($productImage->image);
            }
        }
        $product->delete();
        toastr()->addSuccess('Deleted Successfull');
        return redirect()->route('admin.product.index');
    }

   
}
