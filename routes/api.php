<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TMainDataController;
use App\Http\Controllers\Api\TThematicDataController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware('isAdmin')->name('Admin');
    Route::delete('/admin/{id}', [AdminController::class, 'delete'])->middleware('isAdmin')->name('Admin');
    Route::patch('/user/{id}', [UserController::class, 'updateProfile']);
    //masih error "create role"
    Route::post('/role/create', [RoleController::class, 'create']);
    Route::post('/auth/logout', [UserController::class, 'logout']);
    // return $request->user();
});
//MemberController@index
//Main Data
Route::get('/maindata', [TMainDataController::class, 'index']);
Route::get('/maindata/show/{id}', [TMainDataController::class, 'show']);
Route::post('/maindata/store', [TMainDataController::class, 'store']);
Route::patch('/maindata/update/{id}', [TMainDataController::class, 'update']);
Route::delete('/maindata/delete/{id}', [TMainDataController::class, 'delete']);
//Theamtic Data
Route::post('/thematicdata/store', [TThematicDataController::class, 'store']);

//login + register
Route::post('/auth/register', [AdminController::class, 'register']);
Route::post('/auth/login', [UserController::class, 'login']);
