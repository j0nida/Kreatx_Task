<?php

use Illuminate\Support\Facades\Route;
use App\Events\ChatMessageWasReceived;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth\login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin routes
Route::get("/admin",[App\Http\Controllers\Admin\AdminsController::class,"index"])->name("admin")->middleware("admin");
Route::get("/users",[App\Http\Controllers\Admin\UsersController::class,"index"])->name("users")->middleware("admin");
Route::get("/departments",[App\Http\Controllers\Admin\DepartmentsController::class,"index"])->name("departments")->middleware("admin");
Route::get("/departments/details",[App\Http\Controllers\Admin\DepartmentsController::class,"details"])->name("departments.details")->middleware("admin");
Route::get("/admin/profile",[App\Http\Controllers\Admin\AdminsController::class,"profile"])->name("admin.profile")->middleware("admin");
Route::get("/admin/user/create",[App\Http\Controllers\Admin\UsersController::class,"create"])->name("admin.user.create")->middleware("admin");
Route::post("/admin/user/store",[App\Http\Controllers\Admin\UsersController::class,"store"])->name("admin.user.store")->middleware("admin");
Route::get("/admin/user/{user}/edit",[App\Http\Controllers\Admin\UsersController::class,"edit"])->name("admin.user.edit")->middleware("admin");
Route::put("/admin/user/{user}/update",[App\Http\Controllers\Admin\UsersController::class,"update"])->name("admin.user.update")->middleware("admin");
Route::delete("/admin/user/{user}/destroy",[App\Http\Controllers\Admin\UsersController::class,"destroy"])->name("admin.user.destroy")->middleware("admin");
Route::get("/admin/department/{department}/edit",[App\Http\Controllers\Admin\DepartmentsController::class,"edit"])->name("admin.dept.edit")->middleware("admin");
Route::put("/admin/department/{department}/update",[App\Http\Controllers\Admin\DepartmentsController::class,"update"])->name("admin.dept.update")->middleware("admin");
Route::delete("/admin/department/{department}/destroy",[App\Http\Controllers\Admin\DepartmentsController::class,"destroy"])->name("admin.dept.destroy")->middleware("admin");
Route::get("/admin/department/create",[App\Http\Controllers\Admin\DepartmentsController::class,"create"])->name("department.create")->middleware("admin");
Route::post("/admin/department/store",[App\Http\Controllers\Admin\DepartmentsController::class,"store"])->name("department.store")->middleware("admin");
Route::get("/department/{department}/users",[App\Http\Controllers\Admin\DepartmentsController::class,"users"])->name("dept.users")->middleware("admin");

//Employee routes
Route::get("/employee",[App\Http\Controllers\User\UsersController::class,"index"])->name("employee")->middleware("employee");
Route::get("/employee/{user}/profile",[App\Http\Controllers\User\UsersController::class,"show"])->name("employee.profile")->middleware("employee");
Route::get("/employee/{user}/edit",[App\Http\Controllers\User\UsersController::class,"edit"])->name("employee.edit")->middleware("employee");
Route::put("/employee/{user}/update",[App\Http\Controllers\User\UsersController::class,"update"])->name("employee.update")->middleware("employee");
Route::delete("/employee/{user}/delete",[App\Http\Controllers\User\UsersController::class,"destroy"])->name("employee.delete")->middleware("employee");
Route::get("/chats",[App\Http\Controllers\User\ChatsController::class,"index"])->name("chats")->middleware("employee");
Route::get("/messages",[App\Http\Controllers\User\ChatsController::class,"get_all_messages"])->name("messages")->middleware("employee");

Route::get("/messagess",[App\Http\Controllers\User\ChatsController::class,"get_all_messages"])->name("messages")->middleware("employee");
Route::post("/messagess",[App\Http\Controllers\User\ChatsController::class,"send_message"])->name("send.messages")->middleware("employee");


Route::get('/t', function () {

    broadcast(new ChatMessageWasReceived("hello"));
        return view('test');
});