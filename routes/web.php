<?php

use App\Http\Controllers\CategoryAssetsController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeAssetsController;
use App\Http\Controllers\UserController;
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

    // category asset Routes
    Route::get('/category-assets', [CategoryAssetsController::class, 'index'])->name('category_assets');
    
    Route::post('/category-assets-create', [CategoryAssetsController::class, 'create'])->name('category_assets_create');

    Route::post('/category-assets-edit/{id}', [CategoryAssetsController::class, 'update'])->name('category_assets_edit');

    Route::post('/category-assets-delete/{id}', [CategoryAssetsController::class, 'delete'])->name('category_assets_delete');


    //type asset Routes
    Route::get('/type-assets', [TypeAssetsController::class, 'index'])->name('type_assets');

    Route::post('/type-assets-create', [TypeAssetsController::class, 'create'])->name('type_assets_create');

    Route::post('/type-assets-edit/{id}', [TypeAssetsController::class, 'update'])->name('type_assets_edit');

    Route::post('/type-assets-delete/{id}', [TypeAssetsController::class, 'delete'])->name('type_assets_delete');


    //supplier Routes
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');

    Route::post('/suppliers-create', [SupplierController::class, 'create'])->name('suppliers_create');

    Route::post('/suppliers-edit/{id}', [SupplierController::class, 'update'])->name('suppliers_edit');

    Route::post('/suppliers-delete/{id}', [SupplierController::class, 'delete'])->name('suppliers_delete');

    //supplier Routes
    // Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    // Route::post('/orders-create', [OrderController::class, 'create'])->name('orders_create');

    // Route::post('/orders-edit/{id}', [OrderController::class, 'update'])->name('orders_edit');

    // Route::post('/orders-delete/{id}', [OrderController::class, 'delete'])->name('orders_delete');
    Route::resource('orders', OrderController::class)->except(['create', 'edit'])->names([
        'index' => 'orders',
        'store' => 'orders_create',
        'update' => 'orders_edit',
        'destroy' => 'orders_delete',
    ]);
    //user Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::post('/users-create', [UserController::class, 'create'])->name('users_create');

    Route::post('/users-disable/{id}', [UserController::class, 'disable'])->name('users_disable');

    Route::post('/users-delete/{id}', [UserController::class, 'delete'])->name('users_delete');

     //potitions Routes
     Route::get('/roles', [RoleController::class, 'index'])->name('roles');

     Route::post('/roles-create', [RoleController::class, 'create'])->name('roles_create');
 
     Route::post('/roles-edit/{id}', [RoleController::class, 'edit'])->name('roles_edit');
 
     Route::post('/roles-delete/{id}', [RoleController::class, 'delete'])->name('roles_delete');

    //route get data
    Route::get('/get-form-data', [DataController::class, 'formData'])->name('form-data');

    Route::get('/get-type-assets/{category_asset_id}', [DataController::class, 'getTypeAssets'])->name('get-type-assets');

});

