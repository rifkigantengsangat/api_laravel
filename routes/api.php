<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PesanController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoriController;



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
Route::controller(UserController::class)->group(function() {
    Route::post('users/register', 'register');
    Route::post('users/login', 'login');
    Route::get('users/{id}/post', 'postUser');
  
});
Route::post('/comment',[PesanController::class,'store']);
Route::get('/comment/post/{id}',[PesanController::class,'index']);
Route::controller(PostController::class)->group(function() {
    Route::post('/posts', 'store');
    Route::get('/posts','index');
  
});
Route::post('/category',[CategoriController::class,'store']);
Route::get('/category',[CategoriController::class,'index']);

Route::get('/post/s={slug}',[PostController::class,'searchData']);
