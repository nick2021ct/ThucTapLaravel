<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CheckOutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductVariantItemController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderReturnController;
use App\Http\Controllers\Admin\POSController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MyProfileController;
use App\Http\Controllers\User\ReturnOrderController;
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
require __DIR__.'/auth.php';
//home
Route::get('/',[HomeController::class,'index'])->name('home');
//detail
Route::get('/detail/{id}',[HomeController::class,'show'])->name('detail');
//cart
Route::prefix('cart')->as('cart.')->group(function(){
    Route::get('/',[CartController::class,'index'])->name('index');
    Route::post('/add_to_cart',[CartController::class,'add_to_cart'])->name('add_to_cart');
    Route::post('/update_quantity',[CartController::class,'update_quantity'])->name('update_quantity');
    Route::post('/remove_cart/{rowId}',action: [CartController::class,'remove_cart'])->name('remove_cart');
    Route::get('/remove_all_cart',action: [CartController::class,'remove_all_cart'])->name('remove_all_cart');
    Route::post('/get_cart_total',[CartController::class,'getCartTotal'])->name('get_cart_total');
    Route::get('/apply_coupon',[CartController::class,'applyCoupon'])->name('apply_coupon');
    Route::post('/save_checkout_session',[CartController::class,'saveCheckoutSession'])->name('save_checkout_session');

});
//checkout
Route::get('checkout',[CheckOutController::class,'index'])->name('checkout.index');
Route::post('checkout/cash_method',[CheckOutController::class,'cash_method'])->name('checkout.cash_method');
//lich su order
Route::get('/order_history',[OrderHistoryController::class,'index'])->name('order_history.index');
Route::get('/order_history/show',[OrderHistoryController::class,'show'])->name('order_history.show');
Route::get('/order_history/detail/{id}',[OrderHistoryController::class,'showAuth'])->name('order_history.detail');
Route::get('/order_history/cancel/{id}',[OrderHistoryController::class,'orderCancel'])->name('order_history.cancel');
//tra hang 
Route::get('/return_order/{id}',action: [ReturnOrderController::class,'returnOrder'])->name('return_order');
Route::post('/return_order/select_product/{id}', [ReturnOrderController::class, 'selectProduct'])->name('return_order.select_product');
Route::get('/return_order/unselect_product/{id}', [ReturnOrderController::class, 'unselectProduct'])->name('return_order.unselect_product');
Route::post('/return_order/submit_return/{id}',[ReturnOrderController::class,'submitReturn'])->name('return_order.submit_return');
//yeu cau dang nhap
Route::middleware('auth')->group(function () {
    Route::as('user.')->group(function(){
//profile
        Route::get('/my_profile',[MyProfileController::class,'index'])->name('my_profile');
        Route::put('/my_profile/profile/{id}',[MyProfileController::class,'updateProfile'])->name('my_profile.profile');
        Route::put('/my_profile/password/{id}',[MyProfileController::class,'updatePassword'])->name('my_profile.password');
    //address
        Route::resource('/address',UserAddressController::class);
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

//yeu cau dang nhap quyen admin
Route::prefix('admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){
//dashboard
    Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');
//brand
    Route::resource('brand',BrandController::class);
    Route::put('brand/change_status/{id}', [BrandController::class,'changeStatus'])->name('brand.change_status');
//product
    Route::resource('product',ProductController::class);
    Route::put('product/change_status/{id}', [ProductController::class,'changeStatus'])->name('product.change_status');
//product variant
    Route::resource('product_variant',ProductVariantController::class);
    Route::put('product_variant/change_status/{id}', [ProductVariantController::class,'changeStatus'])->name('product_variant.change_status');

//product variant item
    Route::put('product_variant_item/change_status/{id}', [ProductVariantItemController::class,'changeStatus'])->name('product_variant_item.change_status');
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
//coupon
    Route::resource('coupon', controller: CouponController::class);
    Route::put('coupon/change_status/{id}', [CouponController::class,'changeStatus'])->name('coupon.change_status');

//flash sale
    Route::resource('flash_sale',FlashSaleController::class);
//employee
    Route::resource('employee',EmployeeController::class);
    Route::put('employee/change_status/{id}', [EmployeeController::class,'changeStatus'])->name('employee.change_status');

});
//yeu cau dang nhap quyen admin hoac employee
Route::middleware('role:employee,admin')->group(function(){
//orders
    Route::get('order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::put('order/change_status/{id}', [OrderController::class, 'changeStatus'])->name('admin.order.change_status');
    Route::get('order/detail/{id}', [OrderController::class, 'show'])->name('admin.order.detail');
    Route::delete('order/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::put('order/change_order_address/{id}', [OrderController::class, 'changeOrderAddress'])->name('admin.order.change_order_address');
//point of sale
    Route::get('pos', [POSController::class, 'index'])->name('admin.pos.index');
    Route::post('pos/add_to_pos', [POSController::class, 'addToPOS'])->name('admin.pos.addToPOS');
    Route::delete('pos/remove_from_pos/{id}', [POSController::class, 'removeFromPOS'])->name('admin.pos.removeFromPOS');
    Route::post('pos/checkout', [POSController::class, 'checkout'])->name('admin.pos.checkout');
//check tra hang ben admin
    Route::get('order_return',[OrderReturnController::class,'index'])->name('admin.order_return.index');
    Route::put('order_return/change_status/{id}', [OrderReturnController::class,'changeStatus'])->name('admin.order_return.change_status');

});

