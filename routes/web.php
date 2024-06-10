<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AcountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExportController;









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


Route::get('/' , [LoginController::class, 'index'])->name('login');
Route::post('/' , [LoginController::class, 'indexed'])->name('logined');

Route::get('/logout' , [LoginController::class, 'logout'])->name('logout');



Route::get('forget-account' , [HomeController::class, 'forget_account'])->name('forget_account');
Route::post('forget-account' , [HomeController::class, 'forget_accounted'])->name('forget_accounted');



Route::get('replace-pass', [HomeController::class, 'replace_pass'])->name('replace_pass');
Route::post('replace-pass', [HomeController::class, 'replace_passed'])->name('replace_passed');

Route::get('confirm-pass', [HomeController::class, 'acceptPass'])->name('acceptPass');












Route::prefix('Duan')->middleware('auth')->group(function() {
    Route::get('home' , [HomeController::class, 'index'])->name('home');
    Route::get('infor_account' , [HomeController::class, 'infor_account'])->name('infor_account');




    Route::prefix('exports')->group(function(){
        Route::get('pdf/{id}', [ExportController::class, 'generatePDF'])->name('pdf');
        Route::get('index' , [ExportController::class, 'index'])->name('export.index');
        Route::get('search-export', [ExportController::class, 'search'])->name('export.search');


    });



    Route::prefix('products')->group(function(){
        Route::get('create' , [ProductController::class, 'create'])->name('products.create');
        Route::post('create' , [ProductController::class, 'created'])->name('products.created');


        Route::get('index' , [ProductController::class, 'index'])->name('products.index');
        Route::post('index' , [ProductController::class, 'indexed'])->name('products.indexed');

        Route::get('search-products', [ProductController::class, 'search'])->name('products.search');





        Route::get('back' , [ProductController::class, 'back_index'])->name('products.back');


        Route::get('edit/{id}' , [ProductController::class, 'edit'])->name('products.edit');
        Route::post('edit/{id}' , [ProductController::class, 'edited'])->name('products.edited');

        Route::get('delete/{id}' , [ProductController::class, 'delete'])->name('products.delete');
    });

    Route::prefix('accounts')->middleware('role:admin')->group(function(){
        Route::get('index' , [AcountController::class, 'index'])->name('account');
        Route::get('search-account', [AcountController::class, 'search'])->name('account.search');


        Route::get('back' , [AcountController::class, 'back_index'])->name('account.back');

        Route::get('create' , [AcountController::class, 'getAccount'])->name('getAccount');
        Route::post('create' , [AcountController::class, 'postAccount'])->name('postAccount');


        Route::get('edit/{id}' , [AcountController::class, 'getEdit'])->name('accounts.getEdit');
        Route::post('edit/{id}' , [AcountController::class, 'postEdit'])->name('accounts.postEdit');

        Route::get('delete/{id}' , [AcountController::class, 'deleteAccount'])->name('deleteAccount');
    });



    Route::prefix('categories')->group(function(){
        Route::get('index' , [CategoryController::class, 'index'])->name('category');
        Route::get('search-category', [CategoryController::class, 'search'])->name('category.search');

        Route::get('back' , [CategoryController::class, 'back_index'])->name('category.back');




        Route::get('create' , [CategoryController::class, 'getCategory'])->name('getCategory');
        Route::post('create' , [CategoryController::class, 'postCategory'])->name('postCategory');


        Route::get('edit/{id}' , [CategoryController::class, 'getEdit'])->name('getEdit');
        Route::post('edit/{id}' , [CategoryController::class, 'postEdit'])->name('postEdit');

        Route::get('delete/{id}' , [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });


    Route::prefix('supplier')->group(function(){
        Route::get('index' , [SupplierController::class, 'supplier_index'])->name('supplier.index');
        Route::get('search-supplier', [SupplierController::class, 'search'])->name('supplier.search');

        Route::get('back' , [SupplierController::class, 'back_index'])->name('supplier.back');





        Route::get('create' , [SupplierController::class, 'supplier_create'])->name('Supplier.create');
        Route::post('create' , [SupplierController::class, 'supplier_created'])->name('Supplier.created');

        Route::get('/get-districts/{cityId}', [SupplierController::class, 'getDistricts']);
        Route::get('/get-wards/{cityId}/{districtId}', [SupplierController::class, 'getWards']);



        Route::get('edit/{id}' , [SupplierController::class, 'supplier_edit'])->name('Supplier.edit');
        Route::post('edit/{id}' , [SupplierController::class, 'supplier_edited'])->name('Supplier.edited');

        Route::get('delete/{id}' , [SupplierController::class, 'supplier_delete'])->name('Supplier.delete');
    });

    Route::prefix('warehouse')->group(function(){
        Route::get('index' , [WarehouseController::class, 'index'])->name('warehouse');
        Route::post('index' , [WarehouseController::class, 'indexed'])->name('warehouse.indexed');

        Route::get('search-warehouse', [WarehouseController::class, 'search'])->name('warehouse.search');




        Route::get('back' , [WarehouseController::class, 'back_index'])->name('warehouse.back');




        Route::get('create' , [WarehouseController::class, 'create'])->name('warehouse.create');
        Route::post('create' , [WarehouseController::class, 'created'])->name('warehouse.created');


        Route::get('edit/{id}' , [WarehouseController::class, 'edit'])->name('warehouse.edit');
        Route::post('edit/{id}' , [WarehouseController::class, 'edited'])->name('warehouse.edited');

        Route::get('delete/{id}' , [WarehouseController::class, 'delete'])->name('warehouse.delete');
    });


});
