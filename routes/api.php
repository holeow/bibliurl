<?php

use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\FolderController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('folders', FolderController::class);
    Route::apiResource("bookmarks", BookmarkController::class);
    Route::get("/bookmarks/{bookmark}/tags", [TagController::class, 'gettagsofbookmark'])->name('bookmarks.tags');
    Route::get("/folders/{folder}/tags", [TagController::class, 'gettagsoffolder'])->name('folders.tags');
    Route::get("user/tags", [TagController::class, 'gettagsofuser'])->name('user.tags');
    Route::put("/bookmarks/{bookmark}/tags", [TagController::class, "updatetagsofbookmark"])->name("bookmarks.tags.update");
    Route::put("/folders/{folder}/tags", [TagController::class, "updatetagsoffolder"])->name("folders.tags.update");

});