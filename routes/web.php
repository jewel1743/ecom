<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductImagesController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Admin\FabricController;
use App\Http\Controllers\Admin\PatternController;
use App\Http\Controllers\Admin\SleeveController;
use App\Http\Controllers\Admin\FitController;
use App\Http\Controllers\Admin\OccasionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

    //admin all routes start here
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

         //brands controler
         Route::match(['get','post'],'/add-edit-brands/{id?}',[BrandController::class,'addEditBrand'])->name('add-edit-brand');
         Route::get('/brands', [BrandController::class, 'index'])->name('brand');
         Route::post('/update-brand-status',[BrandController::class, 'updateBrandStatus'])->name('update-brand-status');
         Route::get('/delete-brand/{id}',[BrandController::class, 'deleteBrand'])->name('delete-brand');
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
        Route::post('/update-feature-product-status', [ProductController::class, 'updateFeatureProductStatus'])->name('update-feature-product-status');

            //prouduct multiple sub images
        Route::match(['get','post'], '/product-images/{id}', [ProductImagesController::class, 'productImages'])->name('product-images');
        Route::post('/update-image-status',[ProductImagesController::class, 'updateImageStatus'])->name('update-image-status');
        Route::get('/delete-product-sub-image/{id}',[ProductImagesController::class, 'deleteSubImage'])->name('delete-sub-image');
            //product attributes
        Route::match(['get','post'], '/product-attribute/{id}', [ProductAttributeController::class, 'productAttribute'])->name('product-attribute');
        Route::post('/update-attribute', [ProductAttributeController::class, 'updateAttribute'])->name('update-attribute');
        Route::post('/update-attribute-status', [ProductAttributeController::class, 'updateAttributeStatus'])->name('update-attribute-status');
        Route::get('/delete-product-attribute/{id}', [ProductAttributeController::class, 'deleteProductAttribute'])->name('delete-product-attribute');

         //banners Controller
        Route::match(['get','post'],'/add-edit-banner/{id?}',[BannerController::class,'addEditBanner'])->name('add-edit-banner');
        Route::get('/banners', [BannerController::class, 'index'])->name('banners');
        Route::post('/update-banner-status',[BannerController::class, 'updateBannerStatus'])->name('update-banner-status');
        Route::get('/delete-banner/{id}',[BannerController::class, 'deleteBanner'])->name('delete-banner');


            // fabric Controller
         Route::match(['get','post'],'/add-edit-fabrics/{id?}',[FabricController::class,'addEditFabric'])->name('add-edit-fabric');
         Route::get('/fabrics', [FabricController::class, 'index'])->name('fabric');
         Route::post('/update-fabric-status',[FabricController::class, 'updatefabricStatus'])->name('update-fabric-status');
         Route::get('/delete-fabric/{id}',[FabricController::class, 'deleteFabric'])->name('delete-fabric');
            // Pattern Controller
         Route::match(['get','post'],'/add-edit-patterns/{id?}',[PatternController::class,'addEditPattern'])->name('add-edit-pattern');
         Route::get('/patterns', [PatternController::class, 'index'])->name('pattern');
         Route::post('/update-pattern-status',[PatternController::class, 'updatePatternStatus'])->name('update-pattern-status');
         Route::get('/delete-pattern/{id}',[PatternController::class, 'deletePattern'])->name('delete-pattern');
            // Sleeve Controller
         Route::match(['get','post'],'/add-edit-sleeves/{id?}',[SleeveController::class,'addEditSleeve'])->name('add-edit-sleeve');
         Route::get('/sleeves', [SleeveController::class, 'index'])->name('sleeve');
         Route::post('/update-sleeve-status',[SleeveController::class, 'updateSleeveStatus'])->name('update-sleeve-status');
         Route::get('/delete-sleeve/{id}',[SleeveController::class, 'deleteSleeve'])->name('delete-sleeve');
            // Fit Controller
         Route::match(['get','post'],'/add-edit-fits/{id?}',[FitController::class,'addEditFit'])->name('add-edit-fit');
         Route::get('/fits', [FitController::class, 'index'])->name('fit');
         Route::post('/update-fit-status',[FitController::class, 'updateFitStatus'])->name('update-fit-status');
         Route::get('/delete-fit/{id}',[FitController::class, 'deleteFit'])->name('delete-fit');
            // Occasion Controller
         Route::match(['get','post'],'/add-edit-occasions/{id?}',[OccasionController::class,'addEditOccasion'])->name('add-edit-occasion');
         Route::get('/occasions', [OccasionController::class, 'index'])->name('occasion');
         Route::post('/update-occasion-status',[OccasionController::class, 'updateOccasionStatus'])->name('update-occasion-status');
         Route::get('/delete-occasion/{id}',[OccasionController::class, 'deleteOccasion'])->name('delete-occasion');

    });

});

    //front all routes start here
Route::name('front-')->group(function(){

        //index controller
     Route::get('/', [IndexController::class, 'index'])->name('home');

     //Prouduct Controller
    Route::get('/{url}',[FrontProductController::class, 'categoryProducts'])->name('category-products');

});
