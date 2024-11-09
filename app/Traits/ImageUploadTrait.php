<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait{
    public function uploadImage(Request $request, $inputName, $path)
    {
        if($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $imageName = uniqid().'.'.$image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path .'/'.$imageName;
        }
    }

    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];
        if($request->hasFile($inputName)){
            $images = $request->{$inputName};

            foreach($images as $image){
                $imageName = uniqid().'.'.$image->getClientOriginalName();
                $image->move(public_path(path: $path), $imageName);
                $imagePaths[] = $path .'/'.$imageName;
            }
            return $imagePaths;
        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if($request->hasFile($inputName)){

            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $imageName = uniqid().'.'.$image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path .'/'.$imageName;
        }
        return $oldPath;
    }

    public function updateMultiImage(Request $request, $inputName, $path,$oldPaths = [])
    {
        $imagePaths = [];
        if($request->hasFile($inputName)){
            $images = $request->{$inputName};

            foreach ($oldPaths as $oldPath) {
                if (File::exists(public_path($oldPath))) {
                    File::delete(public_path($oldPath));
                }
            }

            foreach($images as $image){
                
                $imageName = uniqid().'.'.$image->getClientOriginalName();
                $image->move(public_path($path), $imageName);
                $imagePaths[] = $path .'/'.$imageName;
            }

        }
        return $imagePaths;
    }

    public function deleteImage(string $path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }

    
}