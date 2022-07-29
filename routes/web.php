<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users',App\Http\Controllers\UserController::class)
    ->except('create','show','edit');
Route::resource('/clients',App\Http\Controllers\ClientController::class)
    ->except('create','show','edit');
Route::get('/brands/json',[App\Http\Controllers\BrandController::class,'json']);
Route::resource('/brands',App\Http\Controllers\BrandController::class)
    ->except('create','show','edit');
Route::get('/categories/json',[App\Http\Controllers\CategoryController::class,'json']);
Route::resource('/categories',App\Http\Controllers\CategoryController::class)
    ->except('create','show','edit');
Route::get('/products/json',[App\Http\Controllers\ProductController::class,'json']);
Route::resource('/products',App\Http\Controllers\ProductController::class)
    ->except('create','show','edit');
//Route::get('/users/json',[App\Http\Controllers\UserController::class,'json']);
//Route::get('/clients/json',[App\Http\Controllers\ClientController::class,'json']);