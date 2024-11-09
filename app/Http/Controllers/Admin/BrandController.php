<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use App\Traits\SearchableTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');

        $brands = Brand::search($searchTerm,['name'])->paginate(5);
        
        // $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required'],
            'name' => ['required'],
        ]);

        $brand = new Brand();

        $logoPath = $this->uploadImage($request, 'logo','uploads/brand');

        $brand->logo = $logoPath;
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();
        toastr()->addSuccess('Created Successfull');
        return redirect()->route('admin.brand.index');
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
         $brand = Brand::findOrFail($id);
         return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $brand = Brand::findOrFail($id);

        $logoPath = $this->updateImage($request, 'logo','uploads/brand', $brand->logo);

        $brand->logo = empty(!$logoPath) ? $logoPath : $brand->logo;
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();
        toastr()->addSuccess('Updated Successfull');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage( $brand->logo);
        $brand->delete();
        toastr()->addSuccess(message: 'Deleted Successfull');
        return redirect()->route('admin.brand.index');
    }
}
