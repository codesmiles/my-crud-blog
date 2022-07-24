<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
Route::post("/upload",[PostController::class,"store"]);
Route::get("/post/{id}",[PostController::class,"show"]);
Route::post("/post/{id}",[PostController::class,"update"]);
Route::delete("/post/{id}",[PostController::class,"destroy"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
