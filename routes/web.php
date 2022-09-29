<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('home', function(){
    return view('home');
   })->middleware('auth');
   
Route::get('admin/', [AdminController::class, 'index'])->middleware('auth')->name("admin");
Route::get('admin/userlist/', [AdminController::class, 'userlist'])->middleware('auth')->name("admin.userlist");
Route::get('admin/createuser/', [AdminController::class, 'createuser'])->middleware('auth')->name("admin.createuser");
Route::post('admin/createuser', [AdminController::class, 'postuser'])->middleware('auth')->name('admin.postuser');
Route::post('admin/makeadmin/{user}', [AdminController::class, 'makeadmin'])->name("admin.makeadmin")->middleware('auth');
Route::post('admin/banuser/{user}', [AdminController::class, 'banuser'])->name("admin.banuser")->middleware('auth');