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

    public function index()
    {
        $depts = Department::where("deleted",0)->with('childrenRecursive') ->whereNull('parent_id')->get();

        return view("admin.department.index", ['depts' => $depts]);
    }

    public function details()
    {
        $depts = Department::where('deleted', 0)->paginate(10);
        return view("admin.department.details", ["depts" => $depts]);
    }

    public function edit($dept_id)
    {
        $dept = Department::findOrFail($dept_id);
        if ($dept->deleted == 0) {
            return view("admin.department.edit", [
                'department' => $dept,
                'departments' => Department::where('deleted', 0)
                ->where('id','!=',$dept->id)
                ->get()]);
        }else{
            request()->session()->flash('error', 'This department does not exist');
            return redirect()->route('departments.details');
        }
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
            'description' => ['string', "nullable"],
        ]);

        $dept = Department::findOrFail($id);
        $dept->name = $request->name;
        $dept->description = $request->desc;
        $dept->parent_id=$request->parent_id;
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
        return view("admin.department.create", [
            'departments' => Department::where('deleted', 0)->get(),
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
            'department_id'=>"required"
        ]);
        $dept = Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->department_id,
        ]);

        $request->session()->flash('success', 'Department has been successfully created!');
        return redirect()->route('departments.details');
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
        $dept = Department::findOrFail($id);
        if ($dept->deleted == 0) {

            $children = $this->getChildren($dept);
            if($this->contains($children)==0){
                request()->session()->flash('error', 'Can not delete department that contains users!');
                return redirect()->route('departments.details');
            }else{
                foreach($children as $item){
                    $item->deleted=1;
                    $item->save();
                }
                request()->session()->flash('success', 'Department has been successfully deleted!');
                return redirect()->route('departments.details');

            }
            
        }
    }

    

    private function getChildren($department)
    {
        $departments = collect([$department]);
        foreach ($department->children as $dept) {
            $departments = $departments->merge($this->getChildren($dept));
        }
        return $departments;
    }

    private function contains($dept){
        foreach($dept as $item){
            if ($item->users()->exists()) {
                return 0;
                break;
            }
        }
        return 1;
    }

    public function users($id)
    {

        $dept = Department::findOrFail($id);
        if($dept->deleted==0){

        $users = User::where("department_id", $id)->where('deleted', 0)->get();

        return view("admin.department.employee", ["users" => $users]);
        }else{
            request()->session()->flash('error', 'This department does not exist');
            return redirect()->route('departments.details');
        }
    }
}
