<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'deptCount' => Department::count(),   
            'userCount' => User::count()
        ]);
    }

    public function profile()
    {

        return view('admin.profile', ['user' => Auth::user()]);
    }
}
