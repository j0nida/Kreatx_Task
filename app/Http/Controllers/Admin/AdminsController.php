<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Department;
use App\Models\User;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
           
        return view("admin.dashboard",[
            'deptCount' => Department::where('deleted',0)->count(),   
            'userCount' => User::where('deleted',0)->count()
        ]);
    }

    public function profile()
    {
        // if(Auth::user()->deleted==0){
            return view('admin.profile', ['user' => Auth::user()]);
        // }
        // else{
        //     request()->session()->flash('error', 'This account has been deleted');
        //     return redirect()->route('login');
        // }
    }

    public function edit()
    {

        return view(
            "admin.edit",
            [
                'user' => Auth::user(),
                'departments' => Department::all(),
            ]
        );
    }

    public function update(Request $request)
    {
        //

        $user = User::findOrFail(Auth::id());
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            'email' => [
                'string', 'email',
                Rule::unique('users')->ignore($user), "nullable"
            ],
            "age" => ["numeric", "min:18", "max:60"],
            "salary" => ["numeric"],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->salary = $request->salary;
        $user->department_id = $request->department_id;
        $user->save();
        $request->session()->flash('success', 'Admin\'s profile has been successfully updated!');
        return redirect()->route('admin.profile');
    }

    // public function destroy()
    // {
    //     //
    //     $user = User::findOrFail(Auth::user()->id);

    //     $user->delete();

    //     request()->session()->flash('success', 'Your account has been successfully deleted');
    //     return redirect()->route('login');
    // }

}
