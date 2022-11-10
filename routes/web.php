<?php

use App\Category;
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
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\AuthUserController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;


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

//Auth::routes();

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

            //coupon code functionality routes
        Route::get('/coupons', [CouponController::class,'coupons'])->name('admin-coupons');
        Route::post('/update-coupon-status', [CouponController::class,'updateCouponStatus'])->name('update-coupon-status');
        Route::match(['get', 'post'], '/add-edit-coupon/{id?}', [CouponController::class, 'addEditCoupon'])->name('add-edit-coupon');
        Route::get('/delete-coupon/{id}', [CouponController::class, 'deleteCoupon'])->name('delete-coupon');

            //admin order controller
        Route::get('/orders',[AdminOrderController::class, 'orders'])->name('admin-orders');
        Route::get('/order-details/{order_id}',[AdminOrderController::class, 'orderDetails'])->name('admin-order-details');

    });

});

    //front all routes start here
Route::name('front-')->group(function(){

        //index controller
     Route::get('/', [IndexController::class, 'index'])->name('home');

     //Prouduct Controller

    //Route::get('/{url}',[FrontProductController::class, 'categoryProducts'])->name('category-products'); //avabe kaj krle main doamin er por category cara valid url dileo error dibe jodi se name categoy na thake tai ata badh nicher technic a kaj krte hobe

        //catUrls a category er sob url gula niye aslm abong seta akta array te raklm sudu url nichi
    $catUrls= Category::select('url')->where('status',1)->get()->pluck('url')->toArray(); //pluck er por toArray use krleo hobe na krleo hobe karon pluck use krle seta array korei data rakbe tobe toArray use kora valo
   // echo '<pre>'; print_r($catUrls); die; //pluck ta collection er moto avabe pluck user kore pluck er modde je value dibo aii table er sei sob gula value niye akta single array te joma kore rakbe
        //joto gula category hobe tar url er under a aii route gula auto toiri hobe dynamic
    foreach($catUrls as $url){
        Route::get('/'.$url,[FrontProductController::class, 'categoryProducts']); //aii cntroller er aii function a current url dynamicly get kore neya ase getFacedRoot er maddhome check koro categoryProduct fntion
    }
        //front product details single view page
    Route::get('/product/{id}', [FrontProductController::class, 'productDetails'])->name('product-details');
    Route::post('/get-product-attribute-by-size', [FrontProductController::class, 'getProductAttribteBySize'])->name('get-product-attribute-by-size');
        //Cart Controller
    Route::post('/product/add-to-cart',[CartController::class,'addToCart'])->name('add-to-cart');
    Route::get('/cart',[CartController::class, 'cartPage'])->name('cart-page');
    Route::post('/update-cart',[CartController::class, 'updateCart'])->name('update-cart');
    Route::post('/delete-cart-item',[CartController::class, 'deleteCartItem'])->name('delete-cart-item');

    //front user auth login register routes
    Route::get('/login-register',[AuthUserController::class, 'loginRegister'])->name('login-register');
    Route::post('/user-register',[AuthUserController::class, 'userRegister'])->name('user-register');
    Route::post('/login',[AuthUserController::class, 'userLogin'])->name('user-login');
    Route::post('/logout',[AuthUserController::class, 'userLogout'])->name('user-logout');
    Route::get('/sign-up-email-exists-check',[AuthUserController::class, 'signupEmailCheck'])->name('signup-email-check');
    Route::get('/verify-email/{code}',[AuthUserController::class, 'verifyEmail'])->name('verify-email');
    Route::match(['get','post'],'/user/forgot-password', [AuthUserController::class, 'userForgotPassword'])->name('user-forgot-password');

        //user Auth check group Routes
    Route::group(['middleware' => ['user']], function(){

             //user controller
        Route::get('/user/account',[UserController::class, 'index'])->name('user-account-home');
            //only for Bangladesh address setup
        Route::post('/get-districts-by-division-id',[UserController::class, 'getDistrict'])->name('get-district');
        Route::post('/get-upazilas-by-district-id',[UserController::class, 'getUpazila'])->name('get-upazila');
        Route::post('/get-unions-by-upazila-id',[UserController::class, 'getUnion'])->name('get-union');
        Route::post('/user/update-user-info/{id}',[UserController::class, 'updateUserInfo'])->name('update-user-info');

            //user password change route
        Route::post('/user/update-password/{id}', [UserController::class, 'updatePassword'])->name('user-update-password');
        Route::post('/user/check-current-password', [UserController::class, 'currentPasswordCheck'])->name('check-current-password');

            //check coupon code valid or not from apply in cart page
        Route::post('/user/apply-coupon-code', [CartController::class, 'applyCouponCode'])->name('apply-coupon-code');

            //checkout controller
        Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('checkout')->middleware('checkout');
        Route::match(['get', 'post'], '/add-edit-delivery-address/{id?}', [CheckoutController::class, 'addEditDeliveryAddress'])->name('add-edit-delivery-address');
        Route::post('/delete-delivery-address',[CheckoutController::class, 'deleteDeliveryAddress'])->name('delete-delivery-address');

            //order place controller
        Route::post('/place-order',[OrderController::class, 'placeOrder'])->name('place-order');
        Route::get('/thanks',[OrderController::class, 'thanks'])->name('thanks');
        Route::get('/user/orders',[OrderController::class, 'orders'])->name('orders');
        Route::get('/user/order-details/{order_id}',[OrderController::class, 'orderDetails'])->name('order-details');



    });


});


