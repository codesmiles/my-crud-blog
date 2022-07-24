<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
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
Route::get("/hello",function(){
return "<h1>Hello World<h1>";
});

Route::get("/all-post",[PostController::class,"index"]);
Route::get("/post/{id}",[PostController::class,"show"]);
Route::post("/user-register",[Controller::class,"saveUser"]);
Route::post("/user-login",[Controller::class,"userLogin"]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post("/post-upload",[PostController::class,"store"]);
    Route::post("/post/{id}",[PostController::class,"update"]);
    Route::delete("/post/{id}",[PostController::class,"destroy"]);
    Route::get("/user-logout",[Controller::class,"logout"]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
