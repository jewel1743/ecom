<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductImagesController;


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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->group(function(){

    //admin controller
    Route::match(['get','post'], '/login', [AdminController::class, 'login'])->name('admin-login');

    //admin guard middleware group
    Route::group(['middleware' => ['admin']], function(){

        Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin-logout');
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin-settings');
        Route::post('/check-current-password', [AdminController::class, 'checkCurrentPassword'])->name('check-current-password');
        Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('admin-update-password');
        Route::match(['get','post'], '/update-details', [AdminController::class, 'adminUpdateDetails'])->name('admin-update-details');

            //sections controler
        Route::get('/sections', [SectionController::class, 'index'])->name('section');
        Route::post('/update-section-status',[SectionController::class, 'updateSectionStatus'])->name('update-section-status');

            //category controller
        Route::get('/categories', [CategoryController::class, 'index'])->name('category');
        Route::post('/update-category-status',[CategoryController::class, 'updateCategoryStatus'])->name('update-category-status');

            //category add and edit both funtion are in this one category
        Route::match(['get','post'], '/add-edit-category/{id?}', [CategoryController::class, 'addEditCategory'])->name('add-edit-category');
        Route::post('/append-category-level', [CategoryController::class, 'appendCategoryLevel'])->name('append-category-level');
        Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');
        Route::get('/delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage'])->name('delete-category-image');

            //product add and edit both and delele update routes here
        Route::get('/products', [ProductController::class, 'products'])->name('products');
        Route::post('/update-product-status', [ProductController::class, 'updateProductStatus'])->name('update-product-status');
        Route::get('/delete-product/{id}',[ProductController::class, 'deleteProduct'])->name('delete-product');
        Route::match(['get','post'], '/add-edit-product/{id?}', [ProductController::class, 'addEditProduct'])->name('add-edit-product');
        Route::get('/play-product-video/{name}/{id}', [ProductController::class, 'playProductVideo'])->name('play-product-video');
        Route::get('/delete-product-video/{id}', [ProductController::class, 'deleteProductVideo'])->name('delete-product-video');
        Route::get('/product-details/{id}',[ProductController::class, 'adminProductDetails'])->name('admin-product-details');
        Route::post('/product-code-exist',[ProductController::class, 'productCodeExistCheck'])->name('product-code-exist-check');

            //prouduct multiple sub images
        Route::match(['get','post'], '/product-images/{id}', [ProductImagesController::class, 'productImages'])->name('product-images');
        Route::post('/update-image-status',[ProductImagesController::class, 'updateImageStatus'])->name('update-image-status');
        Route::get('/delete-product-sub-image/{id}',[ProductImagesController::class, 'deleteSubImage'])->name('delete-sub-image');
            //product attributes
        Route::match(['get','post'], '/product-attribute/{id}', [ProductAttributeController::class, 'productAttribute'])->name('product-attribute');
        Route::post('/update-attribute', [ProductAttributeController::class, 'updateAttribute'])->name('update-attribute');
        Route::post('/update-attribute-status', [ProductAttributeController::class, 'updateAttributeStatus'])->name('update-attribute-status');
        Route::get('/delete-product-attribute/{id}', [ProductAttributeController::class, 'deleteProductAttribute'])->name('delete-product-attribute');
    });

});
