<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SparePartsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BreakerController;
use App\Http\Controllers\SalesController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('supplier/join', [SupplierController::class, 'join'])->name('supplier.join');
Route::post('supplier/join', [SupplierController::class, 'register'])->name('supplier.register');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/vehicel/detai', [App\Http\Controllers\HomeController::class, 'vehicleDetail'])->name('vehicle.detail');
Route::post('/find/model', [App\Http\Controllers\HomeController::class, 'findModel'])->name('find.model');
Route::get('car/spareparts/{make_id}', [\App\Http\Controllers\HomeController::class, 'getSpareParts']);
Route::get('spareparts/detail/{id}', [\App\Http\Controllers\HomeController::class, 'sparePartsDetail'])->name('product.detail');

Auth::routes();
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.home');
});
Route::get('profile/{user_id}', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile.index');
Route::put('profile/update/{user_id}', [\App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
Route::group([ 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('supplier', [DashboardController::class, 'supplier'])->name('admin.supplier');
    Route::get('supplier/{id}', [DashboardController::class, 'supplierDetial'])->name('admin.supplier.show');
    Route::get('sales', [SalesController::class, 'sales'])->name('admin.sales');
    Route::get('supplier/delete/{id}', [DashboardController::class, 'supplier'])->name('admin.supplier.destroy');
    Route::post('supplier/edit/{id}', [DashboardController::class, 'supplierEdit'])->name('admin.supplier.update');
    Route::resource('make', MakeController::class);
    Route::get('make/delete/{id}', [MakeController::class,'deleteMake'])->name('make.delete');
    Route::resource('model', ModelController::class);
    Route::get('model/delete/{id}', [ModelController::class,'deleteModel'])->name('model.delete');
    Route::resource('car', CarController::class);
    Route::resource('sparepart', SparePartsController::class);
    Route::get('sparepart/delete/{id}', [SparePartsController::class,'deleteSparePart'])->name('sparepart.delete');
    Route::get('car/delete/{id}', [CarController::class,'deleteCar'])->name('car.delete');
});
Route::group(['prefix' => 'breaker'], function () {
    Route::get('/', [BreakerController::class, 'index'])->name('breaker.home');
    Route::get('order/{id}', [BreakerController::class, 'orderSave'])->name('save.order');
});
