<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CheckOutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductVariantItemController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShippingRuleController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MyProfileController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserAddressController;
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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/detail/{id}',[HomeController::class,'show'])->name('detail');
Route::prefix('cart')->as('cart.')->group(function(){
    Route::get('/',[CartController::class,'index'])->name('index');
    Route::post('/add_to_cart',[CartController::class,'add_to_cart'])->name('add_to_cart');
    Route::post('/update_quantity',[CartController::class,'update_quantity'])->name('update_quantity');
    Route::get('/remove_cart/{rowId}',action: [CartController::class,'remove_cart'])->name('remove_cart');
    Route::get('/remove_all_cart',action: [CartController::class,'remove_all_cart'])->name('remove_all_cart');
    Route::post('/get_cart_total',[CartController::class,'getCartTotal'])->name('get_cart_total');
    Route::get('/apply_coupon',[CartController::class,'applyCoupon'])->name('apply_coupon');
    Route::post('/save_checkout_session',[CartController::class,'saveCheckoutSession'])->name('save_checkout_session');

});
Route::get('checkout',[CheckOutController::class,'index'])->name('checkout.index');
Route::post('checkout/cash_method',[CheckOutController::class,'cash_method'])->name('checkout.cash_method');

Route::middleware('auth')->group(function () {
    Route::as('user.')->group(function(){

        Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

        Route::get('/my_profile',[MyProfileController::class,'index'])->name('my_profile');
        Route::put('/my_profile/profile/{id}',[MyProfileController::class,'updateProfile'])->name('my_profile.profile');
        Route::put('/my_profile/password/{id}',[MyProfileController::class,'updatePassword'])->name('my_profile.password');

        Route::resource('/address',UserAddressController::class);
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/order_history',[OrderHistoryController::class,'index'])->name('order_history.index');
Route::get('/order_history/show',[OrderHistoryController::class,'show'])->name('order_history.show');
Route::get('/order_history/detail/{id}',[OrderHistoryController::class,'showAuth'])->name('order_history.detail');
Route::get('/order_history/cancel/{id}',[OrderHistoryController::class,'orderCancel'])->name('order_history.cancel');

require __DIR__.'/auth.php';

Route::prefix('admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){

    Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');

    Route::resource('brand',BrandController::class);

    Route::resource('product',ProductController::class);

    Route::resource('product_variant',ProductVariantController::class);

    Route::get('product_variant_item/index/{productId}/{variantId}',
    [ProductVariantItemController::class,'index'])->name('product_variant_item.index');
    Route::get('product_variant_item/create/{productId}/{variantId}',
    [ProductVariantItemController::class,'create'])->name('product_variant_item.create');
    Route::post('product_variant_item',
    [ProductVariantItemController::class,'store'])->name('product_variant_item.store');
    Route::get('product_variant_item/edit/{id}',
    [ProductVariantItemController::class,'edit'])->name('product_variant_item.edit');
    Route::put('product_variant_item_update/{id}',
    [ProductVariantItemController::class,'update'])->name('product_variant_item.update');
    Route::delete('product_variant_item/destroy/{id}',
    [ProductVariantItemController::class,'destroy'])->name('product_variant_item.destroy');

    Route::resource('coupon', controller: CouponController::class);

    Route::resource('flash_sale',FlashSaleController::class);

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::put('order/change_order_status/{id}', [OrderController::class, 'changeOrderStatus'])->name('order.change_order_status');
    Route::get('order/detail/{id}', [OrderController::class, 'show'])->name('order.detail');
    Route::delete('order/delete/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::put('order/change_order_address/{id}', [OrderController::class, 'changeOrderAddress'])->name('order.change_order_address');

});


