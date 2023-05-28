<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryAssetsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

// Route::get('/login', [LoginController::class, 'index']);

// Route::post('/login', [UserController::class, 'postLogin'])->name('login');

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/category-assets', [CategoryAssetsController::class, 'index'])->name('category_assets');
    
    Route::post('/category-assets-create', [CategoryAssetsController::class, 'create'])->name('category_assets_create');

    Route::post('/category_assets_edit/{id}', [CategoryAssetsController::class, 'update'])->name('category_assets_edit');
});

