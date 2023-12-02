<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myUserController;
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
Route::get('user',[myUserController::class,'index']);
Route::get('add-user',[myUserController::class,'create']);
Route::post('add-user',[myUserController::class,'store']);
Route::get('edit-user/{id}',[myUserController::class,'edit']);
Route::get('delete-user/{id}',[myUserController::class,'delete']);
Route::put('update-user/{id}',[myUserController::class,'update']);
Route::get('active-user/{id}',[myUserController::class,'active']);
