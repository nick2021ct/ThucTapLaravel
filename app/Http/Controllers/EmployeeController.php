<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input(key: 'search');
        $employees = User::search($searchTerm,['name'])->where("role","employee")->paginate(5);

        return view('admin.employees.index',compact('employees'));
    }


    public function create()
    {
        
    }

 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            toastr()->addError(message: $validator->errors()->first());
            return redirect()->back()->withInput();

        }
        $employee = new User;

        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->role = "employee";
        $employee->save();

        toastr()->addSuccess(message: 'create employee successfully');
        return redirect()->back();

    }

    public function destroy(string $id)
    {
        $employee =  User::findOrFail($id);
        $employee->delete();
        toastr()->addSuccess(message: 'delete employee successfully');
        return redirect()->back();

    }
    public function changeStatus($id)
    {
        $employee =  User::findOrFail($id);
        $employee->status = $employee->status == 'active' ? 'inactive' : 'active';
        $employee->save();

        return response(["status"=>"success","message"=>"Status changed successfully"]);
    }

}
