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
Route::post('/products', [ProductController::class, 'new'])->name('new_product');
Route::put('/products/{id}', [ProductController::class, 'edit'])->name('edit_product');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('delete_product');

Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::post('/clients', [ClientController::class, 'new'])->name('new_client');
Route::put('/clients/{id}', [ClientController::class, 'edit'])->name('edit_client');
Route::delete('/clients/{id}', [ClientController::class, 'delete'])->name('delete_client');

Route::get('/users', [App\Http\Controllers\UsersController::class], 'index')->name('index_users');

Route::get('/requests', function () {
    return view('base.requests');
})->name('requests');
