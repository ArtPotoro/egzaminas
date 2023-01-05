<?php

use App\Http\Controllers\RestoranController;
use App\Http\Controllers\ProductController;

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

Auth::routes();

//Route::middleware(['auth', 'administrator', 'user'])->group(function (){
//    Route::post('products/filter',[\App\Http\Controllers\ProductController::class, 'filterProducts'])->name('products.filter');
//    Route::resources([
//        'restoran' => \App\Http\Controllers\RestoranController::class,
//        'products' => \App\Http\Controllers\ProductController::class
//    ]);
//
//    Route::get('restoran/{id}/products', [\App\Http\Controllers\ProductController::class, 'restoranProducts'])->name('restoranProducts');
//});

Route::middleware(['auth'])->group(function (){
    Route::resources([
        'restoran'=> RestoranController::class,
        'products'=> \App\Http\Controllers\ProductController::class,
    ]);
    Route::get('restoran/{id}/products', [ProductController::class, 'restoranProducts'])->name('restoranProducts');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
