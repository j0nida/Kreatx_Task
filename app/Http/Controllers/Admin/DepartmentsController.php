<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DepartmentsController extends Controller
{
    //

    public function index(){
        $depts = Department::with('children')->whereNull('parent_id')->get();


        return view("admin.department.index", ['depts'=>$depts]);
    }

    public function details(){
        $depts =Department::paginate(3);
        return view("admin.department.details",["depts"=>$depts]);
    }

    public function edit($dept_id){
        
        return view("admin.department.edit",['department' => Department::findOrFail($dept_id)]);
    }
     
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
        $this->validate($request,[
            'name' => ['string', 'max:255'],
            'description' => [ 'string',"nullable"],
        ]);

        $dept=Department::findOrFail($id);
        $dept->name=$request->name;
        $dept->description=$request->desc;
        $dept->save();
        $request->session()->flash('success', 'Department has been successfully updated!');
        return redirect()->route('departments.details');
    }


      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.department.create",[
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
            'description' => "required|string",
        ]);
        $dept = Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->department_id, 
        ]);

        $request->session()->flash('success', 'Department has been successfully created!');
        return redirect()->route('departments');
    }

    /*

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dept=Department::findOrFail($id);
        if($dept->users()->exists()){
            request()->session()->flash('error', 'Can not delete department that contains users!');
            return redirect()->route('departments.details');
        }else{
            DB::table("departments")->where("parent_id",$id)->delete();
            $dept->delete();
            request()->session()->flash('success', 'Department record has been successfully deleted');
            return redirect()->route('departments.details');
        }
    }

    public function users($id){

        $users=User::where("department_id",$id)->get();

        return view("admin.department.employee",["users"=>$users]);
    }

    
    


}
