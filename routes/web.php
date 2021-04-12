<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->middleware("admin", "employee");

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin routes
Route::middleware("admin")->group(function () {
    Route::get("/admin", [App\Http\Controllers\Admin\AdminsController::class, "index"])->name("admin");
    Route::get("/users", [App\Http\Controllers\Admin\UsersController::class, "index"])->name("users");
    Route::get("/departments", [App\Http\Controllers\Admin\DepartmentsController::class, "index"])->name("departments");
    Route::get("/departments/details", [App\Http\Controllers\Admin\DepartmentsController::class, "details"])->name("departments.details");
    Route::get("/admin/profile", [App\Http\Controllers\Admin\AdminsController::class, "profile"])->name("admin.profile");
    Route::get("/admin/user/create", [App\Http\Controllers\Admin\UsersController::class, "create"])->name("admin.user.create");
    Route::post("/admin/user/store", [App\Http\Controllers\Admin\UsersController::class, "store"])->name("admin.user.store");
    Route::get("/admin/user/{user}/edit", [App\Http\Controllers\Admin\UsersController::class, "edit"])->name("admin.user.edit");
    Route::put("/admin/user/{user}/update", [App\Http\Controllers\Admin\UsersController::class, "update"])->name("admin.user.update");
    Route::delete("/admin/user/{user}/destroy", [App\Http\Controllers\Admin\UsersController::class, "destroy"])->name("admin.user.destroy");
    Route::get("/admin/department/{department}/edit", [App\Http\Controllers\Admin\DepartmentsController::class, "edit"])->name("admin.dept.edit");
    Route::put("/admin/department/{department}/update", [App\Http\Controllers\Admin\DepartmentsController::class, "update"])->name("admin.dept.update");
    Route::delete("/admin/department/{department}/destroy", [App\Http\Controllers\Admin\DepartmentsController::class, "destroy"])->name("admin.dept.destroy");
    Route::get("/admin/department/create", [App\Http\Controllers\Admin\DepartmentsController::class, "create"])->name("department.create");
    Route::post("/admin/department/store", [App\Http\Controllers\Admin\DepartmentsController::class, "store"])->name("department.store");
    Route::get("/department/{department}/users", [App\Http\Controllers\Admin\DepartmentsController::class, "users"])->name("dept.users");
});

//Employee routes
Route::middleware("employee")->group(function () {
    Route::get("/employee", [App\Http\Controllers\User\UsersController::class, "index"])->name("employee");
    Route::get("/employee/{user}/profile", [App\Http\Controllers\User\UsersController::class, "show"])->name("employee.profile");
    Route::get("/employee/{user}/edit", [App\Http\Controllers\User\UsersController::class, "edit"])->name("employee.edit");
    Route::put("/employee/{user}/update", [App\Http\Controllers\User\UsersController::class, "update"])->name("employee.update");
    Route::delete("/employee/{user}/delete", [App\Http\Controllers\User\UsersController::class, "destroy"])->name("employee.delete");
    Route::get("/chats", [App\Http\Controllers\User\ChatsController::class, "index"])->name("chats");
    Route::get("/messages", [App\Http\Controllers\User\ChatsController::class, "get_all_messages"])->name("messages");

    Route::get("/messagess", [App\Http\Controllers\User\ChatsController::class, "get_all_messages"])->name("messages");
    Route::post("/messagess", [App\Http\Controllers\User\ChatsController::class, "send_message"])->name("send.messages");
});
