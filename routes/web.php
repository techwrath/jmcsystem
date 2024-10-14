<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\productController;
use App\Http\Controllers\customerController;
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

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/', function () {
//     return view('dashboard.brands');
// });
Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/home', [adminController::class, 'index']);

   

    Route::get('notifications', [adminController::class, 'getNotifications'])->name('notification');

    Route::get('getNotification/{notificationId}', [adminController::class, 'getNotification']);

    Route::post('changePassword/{notificationId}',[adminController::class, 'changePassword']);

    Route::get('products', [adminController::class, 'showProducts'])->name('products');

    Route::get('brands', [brandController::class, 'showBrands'])->name('brands');

    Route::get('addProductView', [productController::class, 'addProductView'])->name('addProductView');

    Route::post('addProduct', [productController::class, 'addProduct'])->name('addProduct');

    Route::get('getProduct/{productId}', [productController::class, 'getProduct'])->name('getProduct');

    Route::delete('delete/{productId}', [productController::class, 'deleteProduct']);

    Route::get('addBrandView',[brandController::class, 'addBrandView'])->name('addBrandView');

    Route::post('addBrand',[brandController::class, 'addBrand'])->name('addBrand');

    Route::delete('deleteBrand/{brandId}', [brandController::class, 'deleteBrand']);

    Route::get('getBrand/{brandId}', [brandController::class, 'getBrand'])->name('getBrand');

    Route::get('getProduct/{productId}', [productController::class, 'getProduct'])->name('getProduct');

    Route::post('updateBrand/{brandId}', [BrandController::class, 'updateBrand'])->name('updateBrand');

    Route::post('updateProduct/{productId}', [productController::class, 'updateProduct'])->name('updateProduct');


    Route::get('users', [userController::class, 'showUsers'])->name('users');

    Route::get('addUserView', [userController::class, 'addUserView'])->name('addUserView');

    Route::post('addUser',[userController::class, 'addUser'])->name('addUser');

    Route::get('getUser/{userId}', [userController::class, 'getUser'])->name('getUser');

    Route::post('updateUser/{userId}', [userController::class, 'updateUser'])->name('updateUser');

    Route::delete('deleteUser/{userId}', [userController::class, 'deleteUser']);


    Route::get('customers', [customerController::class, 'showCustomers'])->name('customers');

    Route::get('addCustomerView', [customerController::class, 'addCustomerView'])->name('add.customer');

    Route::post('storeCustomer',[customerController::class, 'storeCustomer'])->name('store.customer');

    Route::get('addOrderView', [orderController::class, 'addOrderView'])->name('add.order');

    Route::post('storeOrder', [orderController::class, 'storeOrder'])->name('store.order');

    Route::get('orders', [orderController::class, 'showOrders'])->name('orders');

    Route::get('getOrder/{orderId}', [orderController::class, 'getOrder'])->name('get.order');

    Route::put('updateOrder/{orderId}', [orderController::class, 'updateOrder'])->name('update.order');

    Route::get('requisitionForm', [orderController::class, 'requisitionForm'])->name('requisition.form');

    Route::get('requisitionForms', [orderController::class, 'requisitionDatatable'])->name('requisition.datatable');

});
Route::get('forgot-password', [EmailController::class, 'forgotPasswordView'])->name('forgotPassword');

Route::get('send-mail', [EmailController::class, 'index'])->name('sendMail');