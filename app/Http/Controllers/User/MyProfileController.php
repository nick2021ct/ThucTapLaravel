<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.profile_account.profile',compact('user'));
    }

    public function updateProfile(Request $request,$id)
    {
        $request->validate([
            'image'=>'image',
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.$id,
            'phone'=>'required|numeric|regex:/^0[0-9]{9}$/',
        ],[
            'phone.regex' => 'Phone number is not in correct format.'
        ]);
        
        $user = User::findOrFail($id);

        $imagePath = $this->updateImage($request,'image','uploads/user_image',$user->image);
        $user->name = $request->name;
        $user->image = $imagePath;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        toastr()->addSuccess('Profile Updated Successsfull');
        return redirect()->back();

    }


    public function updatePassword(Request $request,$id)
    {
        $request->validate([
            'current_password' =>['required','current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password'=> bcrypt($request->password)
        ]);
        toastr()->addSuccess('Password Updated Successsfull');
        return redirect()->back();

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
        //
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
