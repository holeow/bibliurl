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
   
Route::get('admin/', [AdminController::class, 'index'])->middleware('auth');
Route::get('admin/userlist/', [AdminController::class, 'userlist'])->middleware('auth');
Route::get('admin/createuser/', [AdminController::class, 'createuser'])->middleware('auth');
Route::post('admin/createuser', [AdminController::class, 'postuser'])->middleware('auth');
Route::post('admin/makeadmin/{user}', [AdminController::class, 'makeadmin'])->name("admin.makeadmin")->middleware('auth');