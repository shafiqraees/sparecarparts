<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
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
Route::get('admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/vehicel/detai', [App\Http\Controllers\HomeController::class, 'vehicleDetail'])->name('vehicle.detail');
Route::post('/find/model', [App\Http\Controllers\HomeController::class, 'findModel'])->name('find.model');

Auth::routes();
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('profile', [AdminController::class, 'edit'])->name('admin.edi.profile');
    Route::put('suspend/user/{id}', [AdminController::class, 'suspendUser'])->name('suspend.user');
    Route::put('suspend/profile/{id}', [AdminController::class, 'suspendProfile'])->name('suspend.profile');
    Route::post('profile', [AdminController::class, 'updateProfile'])->name('admin.update.profile');
    Route::get('payment', [AdminController::class, 'getSetting'])->name('setting');
    Route::post('payment', [AdminController::class, 'paymentSettingUpdate'])->name('admin.payment.update');
    Route::get('about-us', [AdminController::class, 'aboutUs'])->name('aboutus');
    Route::post('aboutus', [AdminController::class, 'aboutUsUpdate'])->name('aboutusupdate');
    Route::post('aboutus/images', [AdminController::class, 'aboutUsImagesUpdate'])->name('aboutusuimages');
    Route::post('/aboutus/status/{id}', [AdminController::class, 'aboutUsStatusUpdate'])->name('aboutstatus.update');
    #-------------------------- admin routes added by WOL-17-------------------------------#
    Route::get('marketing', [AdminController:: class, 'getMarketing'])->name('marketing');
    Route::post('update-marketing', [AdminController::class, 'updateMarketing'])->name('admin.update.marketing');
    Route::get('termsandconditions',[AdminController::class, 'gettermsandcondition'])->name('termsandconditions');
    Route::post('update-terms', [AdminController::class, 'updateTerms'])->name('admin.update.terms');
    Route::get('privacy-policy',[AdminController::class, 'getPrivacyPolicy'])->name('privacy');
    Route::post('update-privacy', [AdminController::class, 'updatePrivacy'])->name('admin.update.privacy');
    Route::get('signup-terms',[AdminController::class, 'getSignupTerms'])->name('signupterms');
    Route::post('update-signup-terms', [AdminController::class, 'updateSignUpTerms'])->name('admin.update.signupterms');
    Route::get('packages', [AdminController::class, 'packageslist'] )->name('admin.packages');
    Route::post('update-package', [AdminController::class, 'updatePackage'])->name('admin.package.update');
    Route::get('credit-logs',[AdminController::class, 'getUsersCreditLogs'])->name('allcreditlogs');
    Route::get('creditdetail/{id}', [AdminController::class, 'particularCreditDetail'])->name('selected.creditdetail');
    Route::get('all-transactions',[AdminController::class, 'getAllTransactions'])->name('alluserstransactions');
    Route::get('selectedtransactiondetail/{id}', [AdminController::class, 'particularTransactionDetail'])->name('selected.transactiondetail');
//Route::get('selectedusercreditlog/{id}', [AdminController::class, 'particularUserCreditLog'])->name('selected.usercreditlog');
    Route::get('users', [AdminController::class, 'getUsers'])->name('alluser');
    Route::get('userdetail/{id}', [AdminController::class, 'particularUserDetail'])->name('selected.userdetail');
    Route::get('all-pushnotifications',[AdminController::class, 'getAllPushNotifications'])->name('allpushnotifications');
    Route::get('notification/detail/{id}',[AdminController::class, 'notificationDetail'])->name('notification.detail');
    Route::get('notification/update/{id}',[AdminController::class, 'notificationStatusEdit'])->name('notification.status');
    Route::get('add-pushnotifications',[AdminController::class, 'createPushNotification'])->name('createpushnotification');
    Route::post('generate-push-notification', [AdminController::class, 'generatePushNotification'])->name('admin.generate.pushnotification');
    Route::get('under-construction', [AdminController::class, 'underConstruction'])->name('underconstruction');
    Route::get('allmarketing', [AdminController::class, 'allMarketing'])->name('all.marketing');
    Route::get('marketing/detail/{id}', [AdminController::class, 'marketingDetail'])->name('marketing.detail');
    Route::post('marketing/status/update/{id}', [AdminController::class, 'marketingAddStatusUpdate'])->name('marketingstatus.update');
    Route::get('income', [AdminController::class, 'income'])->name('income');
    Route::get('analytics/marketing', [AdminController::class, 'analyticMarketing'])->name('analytics.marketing');
    Route::get('income/export', [AdminController::class, 'incomeExport'])->name('income.export');
    Route::get('marketing/export', [AdminController::class, 'marketingCompaignExport'])->name('marketing.export');
    Route::get('user/compaign', [AdminController::class, 'getCompaign'])->name('user.compaign');
    Route::get('marketing/compaign', [AdminController::class, 'marketingCompaign'])->name('marketing.compaign');
    //extras route here
    Route::group(['prefix' => 'extras'], function () {
        Route::get('interest', [ExtrasController::class, 'categories'])->name('cat_list');
        Route::get('interest/edit/{id}', [ExtrasController::class, 'interestedit'])->name('cat_edit');
        Route::get('interest/create', [ExtrasController::class, 'categoryCreate'])->name('cat_create');
        Route::post('interest/update/{id}', [ExtrasController::class, 'categoryUpdate'])->name('cat_update');
        Route::get('interest/delete/{id}', [ExtrasController::class, 'categorydelete'])->name('cat_delete');
        Route::post('interest/save', [ExtrasController::class, 'categorySave'])->name('cat_save');
        Route::get('advertise', [ExtrasController::class, 'advertise'])->name('advertise');
        Route::post('advertise/Save', [ExtrasController::class, 'advertiseSave'])->name('adsave');
        Route::get('topic', [ExtrasController::class, 'topics'])->name('topic_list');
        Route::get('topic/create', [ExtrasController::class, 'topicCreate'])->name('topic_create');
        Route::post('topic/save', [ExtrasController::class, 'topicSave'])->name('topic_save');
        Route::get('topic/edit/{id}', [ExtrasController::class, 'topicEdit'])->name('topic_edit');
        Route::post('topic/update/{id}', [ExtrasController::class, 'topicUpdate'])->name('topic_update');
        Route::get('topic/delete/{id}', [ExtrasController::class, 'topicDelete'])->name('topic_delete');
    });
});
