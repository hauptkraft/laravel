<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\TestController;

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

Route::get("/search", [TestController::class, 'search']);

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('', 'index')->name('product');
        Route::get('add', 'add')->name('product.add');
        Route::post('add', 'save')->name('product.save');
        Route::get('edit/{id}', 'edit')->name('product.edit');
        Route::post('edit/{id}', 'update')->name('product.update');
        Route::get('delete/{id}', 'delete')->name('product.delete');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('save', 'save')->name('category.save');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::get('delete/{id}', 'delete')->name('category.delete');
    });
});
