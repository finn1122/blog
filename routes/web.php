<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EndPointController;
use App\Http\Controllers\FacturaController;



use App\Models\Product;
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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource("products",ProductController::class);


//Route::get('products/index',[ProductController::class, 'index'])->name('products.index');

Route::get('crear',[ProductController::class, 'crear'])->name('products.crear');

Route::get('products/create',[ProductController::class, 'create'])->name('products.create');


Route::resource('brands', BrandController::class);

Route::get('endpoint',[EndPointController::class, 'index'])->name('endpoint.index');

Route::get('endpoint/actualizar',[EndPointController::class, 'actualizar'])->name('endpoint.actualizar');

Route::get('facturas/index',[FacturaController::class, 'index'])->name('facturas.index');






