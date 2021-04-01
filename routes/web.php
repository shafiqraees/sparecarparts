<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SparePartsController;
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
//Route::get('admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/vehicel/detai', [App\Http\Controllers\HomeController::class, 'vehicleDetail'])->name('vehicle.detail');
Route::post('/find/model', [App\Http\Controllers\HomeController::class, 'findModel'])->name('find.model');

Auth::routes();
Route::group([ 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
    Route::resource('make', MakeController::class);
    Route::get('make/delete/{id}', [MakeController::class,'deleteMake'])->name('make.delete');
    Route::resource('model', ModelController::class);
    Route::get('model/delete/{id}', [ModelController::class,'deleteModel'])->name('model.delete');
    Route::resource('car', CarController::class);
    Route::resource('sparepart', SparePartsController::class);
    Route::get('sparepart/delete/{id}', [SparePartsController::class,'deleteSparePart'])->name('sparepart.delete');
    Route::get('car/delete/{id}', [CarController::class,'deleteCar'])->name('car.delete');
});
