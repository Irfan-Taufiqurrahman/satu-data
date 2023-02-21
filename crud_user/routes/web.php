<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::prefix('user')->name('Users.')->controller(UserController::class)->group(function (){
    Route::get('/', 'index')->name('home');
    Route::get('/create', 'create')->name('create');
    // Route::get('/show', 'show')->name('show'); detail
    Route::get('/edit/{data}', 'edit')->name('edit');

    
    Route::post('/store', 'store')->name('store');
    Route::post('/update/{data}','update')->name('update');
    Route::post('/delete/{data}','delete')->name('delete');
});