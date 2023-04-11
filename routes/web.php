<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sobre', function () {
    return view('base.sobre');
})->name('sobre');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show-product');
Route::get('/products/new', [ProductController::class, 'create'])->name('create-product');
Route::post('/products', [ProductController::class, 'new'])->name('new-product');
Route::put('/products/{id}', [ProductController::class, 'edit'])->name('edit-product');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('delete-product');

Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('show-client');
Route::get('/clients/new', [ClientController::class, 'create'])->name('create-client');
Route::post('/clients', [ClientController::class, 'new'])->name('new-client');
Route::put('/clients/{id}', [ClientController::class, 'edit'])->name('edit-client');
Route::delete('/clients/{id}', [ClientController::class, 'delete'])->name('delete-client');

Route::get('/requests', function () {
    return view('base.requests');
})->name('requests');
