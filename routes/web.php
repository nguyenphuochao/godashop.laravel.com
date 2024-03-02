<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;

// For admin area
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\LoginController as AdminLoginController;

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
// Trang chủ
Route::get('/', HomeController::class . "@index")->name("index");
Route::get('san-pham', ProductController::class . "@index")->name("product.index");
Route::get('danh-muc/{slug}', ProductController::class . "@index")->name("category.show");
Route::get('san-pham/{slug}.html', ProductController::class . "@show")->name("product.show");

Route::get('san-pham/search', ProductController::class . "@search")->name("product.search");
Route::post('comment/store', CommentController::class . "@store")->name("comment.store");
Route::post('register', RegisterController::class ."@register")->name("register");
Route::post('login', LoginController::class ."@login")->name("login");
Route::post('logout', LoginController::class ."@logout")->name("logout");

Route::get('existingEmail', RegisterController::class ."@existingEmail")->name("existingEmail");

// Route::middleware("auth")->group(function(){
Route::get('carts/add', CartController::class ."@add")->name("cart.create");
Route::get('carts/show', CartController::class ."@show")->name("cart.show");
Route::get('carts/update/{rowId}/{qty}', CartController::class ."@update")->name("cart.update");
Route::get('carts/delete/{rowId}', CartController::class ."@delete")->name("cart.delete");
Route::get('carts/discount', CartController::class ."@discount")->name("cart.discount");
Route::get('carts/voucher', CartController::class ."@voucher")->name("cart.voucher");


Route::get('payment/checkout', PaymentController::class ."@create")->name("payment.create");
Route::post('payment/store', PaymentController::class ."@store")->name("payment.store");
Route::get('address/{provinceId}/districts', AddressController::class ."@districts");
Route::get('address/{districtId}/wards', AddressController::class ."@wards");
Route::get('shippingfee/{provinceId}', AddressController::class ."@shippingFee");
Route::get('lien-he.html', ContactController::class ."@show")->name('contact.show');
Route::post('sendmail', ContactController::class ."@sendEmail")->name('contact.sendmail');
Route::post('password/email', ForgotPasswordController::class."@sendResetLinkEmail")->name('password.email');
Route::get('password/reset/{token}', ResetPasswordController::class."@showResetForm")->name('password.reset');
Route::post('password/reset', ResetPasswordController::class."@reset")->name('password.update');

Route::get('auth/google', GoogleController::class.'@redirectToGoogle')->name("google.login");

Route::get('auth/google/callback', GoogleController::class.'@handleGoogleCallback');

Route::get('auth/facebook', FacebookController::class.'@redirectToFacebook')->name("facebook.login");

Route::get('auth/facebook/callback', FacebookController::class.'@handleFacebookCallback');

Route::get('email/verify/{id}/{hash}', RegisterController::class.'@verify')->name('verification.verify');
 

// });

Route::middleware("auth")->group(function(){
    Route::get('customer/show', CustomerController::class ."@show")->name("customer.show");
    Route::post('customer/update', CustomerController::class ."@update")->name("customer.update");
    Route::get('customer/address', CustomerController::class ."@address")->name("customer.address");

    Route::post('customer/updateAddress', CustomerController::class ."@updateAddress")->name("customer.address.update");
    Route::get('orders', OrderController::class ."@index")->name("customer.orders");
    Route::get('orders/{orderId}', OrderController::class ."@show")->name("orders.show");

});    

// Admin area
Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::middleware("authAdmin:admin")->group(function(){
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });
    // Login
    Route::get('login', 'LoginController@index')->name('admin.login.form');

    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::post('logout', 'LoginController@logout')->name("admin.logout");
});