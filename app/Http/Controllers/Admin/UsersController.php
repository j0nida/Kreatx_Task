<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class UsersController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(10);
        return view("admin.user.index", ['users' => $users]);
    }

    public function edit($user_id)
    {

        return view(
            "admin.user.edit",
            [
                'user' => User::findOrFail($user_id),
                'departments' => Department::all(),
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.user.create", [
            'departments' => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => "required|string|max:255",
            'email' => "required|string|email|unique:users",
            "age" => "required|numeric|min:18|max:60",
            "salary" => "required|numeric",
            'role' => 'required',
            'department_id' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'role' => strtolower($request->role),
            'salary' => $request->salary,
            "age" => $request->age,
        ]);

        $request->session()->flash('success', 'User has been successfully created!');
        return redirect()->route('users');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
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
        $request->session()->flash('success', 'User\'s profile has been successfully updated!');
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        request()->session()->flash('success', 'Employee record has been successfully deleted');
        return redirect()->route('users');
    }
}
