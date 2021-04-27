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
        $users = User::where('deleted',0)->paginate(10);
        return view("admin.user.index", ['users' => $users]);
    }

    public function edit($user_id)
    {
        $user=User::findOrFail($user_id);
        if($user->deleted==0){
        return view(
            "admin.user.edit",
            [
                'user' => $user,
                'departments' => Department::where('deleted',0)->get(),
            ]
        );
        }else{
            request()->session()->flash('error', 'This user does not exist');
            return redirect()->route('users');
        }
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
            'departments' => Department::where('deleted',0)->get(),
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
            'name' => 'required','string','max:255',
            'email' => [
                'required','string', 'email',
                Rule::unique('users')
                ->where(function ($query) {
                    return $query->where('deleted', 0);
                })
            ],
            "age" => 'required','numeric','min:18','max:60',
            "salary" => 'required','numeric',
            'role' => 'required',
            'department_id' => 'required',
            'password' => 'required','confirmed','min:8'
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
        if($user->deleted==0){
            
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            'email' => [
                'string', 'email',
                Rule::unique('users')
                ->where(function ($query) {
                    return $query->where('deleted', 0);
                })
                ->ignore($user), "nullable"
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
        if($user->deleted==0){

        $user->deleted=1;
        $user->save();
        request()->session()->flash('success', 'Employee record has been successfully deleted');
        return redirect()->route('users');
        }else{
            request()->session()->flash('error', 'This user does not exist');
            return redirect()->route('users');
        }
    }
}
