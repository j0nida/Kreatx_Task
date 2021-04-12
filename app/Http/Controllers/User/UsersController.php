<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("user.dashboard");
    }


    public function show()
    {
        //
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
        return view(
            "user.edit",
            [
                'user' => User::findOrFail($id),
                'departments' => Department::all(),
            ]
        );
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
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            "age" => ["numeric", "min:18", "max:60"],
            "salary" => ["numeric"],
            "photo" => ["image", "nullable"]
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->age = $request->age;
        $user->salary = $request->salary;

        if ($request->hasFile('photo')) {

            $path = $request->file('photo')->store('public/images');
            $user->photo = basename($path);
        }
        $user->save();
        $request->session()->flash('success', 'Your profile has been successfully updated!');
        return redirect()->route('employee.profile', $id);
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

        request()->session()->flash('success', 'Your account has been successfully deleted');
        return redirect()->route('login');
    }
}
