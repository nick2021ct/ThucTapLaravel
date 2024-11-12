<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::id())->get();
        return view('user.profile_account.address.index',compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.profile_account.address.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email'=>['required'],
            'phone'=>['required','numeric'],
            'province' => ['required'],
            'district' => ['required'],
            'ward' => ['required'],
            'zip' => ['required'],
            'address_type' => ['required'],
            'specific_address'=>['required']
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::id();
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->province = $request->province;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->zip = $request->zip;
        $address->address_type = $request->address_type;
        $address->specific_address = $request->specific_address;
        $address->save();
        
        toastr()->addSuccess('Created Successfull');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = UserAddress::find($id);
        return view('user.profile_account.address.edit',compact('address'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'email'=>['required'],
            'phone'=>['required','numeric'],
            'province' => ['required'],
            'district' => ['required'],
            'ward' => ['required'],
            'zip' => ['required'],
            'address_type' => ['required'],
            'specific_address'=>['required']
        ]);

        $address = UserAddress::findOrFail($id);
        $address->user_id = Auth::id();
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->province = $request->province;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->zip = $request->zip;
        $address->address_type = $request->address_type;
        $address->specific_address = $request->specific_address;
        $address->save();
        
        toastr()->addSuccess('Updated Successfull');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();

        toastr()->addSuccess('Deleted Successfull');
        return redirect()->route('user.address.index');
    }
}
