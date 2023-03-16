<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ExcelController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TMainDataController;
use App\Http\Controllers\Api\TThematicDataController;
use App\Http\Controllers\Api\TTopicDataController;
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
    Route::get('/role', [RoleController::class, 'index']);
    Route::post('/role/store', [RoleController::class, 'store']);
    Route::post('/auth/logout', [UserController::class, 'logout']);
    // return $request->user();
    //Dataset
    Route::post('/dataset/excel/import', [ExcelController::class, 'import']);
    Route::get('/dataset/excel/{id}', [ExcelController::class, 'indexList']);
    Route::get('/dataset/excel', [ExcelController::class, 'indexDataset']);
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
Route::get('/thematicdata', [TThematicDataController::class, 'index']);
Route::get('/thematicdata/show/{id}', [TThematicDataController::class, 'show']);
Route::patch('/thematicdata/update/{id}', [TThematicDataController::class, 'update']);
Route::delete('/thematicdata/delete/{id}', [TThematicDataController::class, 'delete']);

//Topic Data
Route::get('/topicdata', [TTopicDataController::class, 'index']);
Route::get('/topicdata/show/{id}', [TTopicDataController::class, 'show']);
Route::post('/topicdata/store', [TTopicDataController::class, 'store']);
Route::patch('/topicdata/update/{id}', [TTopicDataController::class, 'update']);
Route::delete('/topicdata/delete/{id}', [TTopicDataController::class, 'delete']);

// Route::post('/dataset/excel/import', 'App\Http\Controllers\Api\ExcelController@import');

//login + register
Route::post('/auth/register', [AdminController::class, 'register']);
Route::post('/auth/login', [UserController::class, 'login']);
