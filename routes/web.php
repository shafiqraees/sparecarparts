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
use Twilio\Rest\Client;
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
Route::get('about-us', [App\Http\Controllers\HomeController::class, 'aboutUs'])->name('about');
Route::get('contact-us', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact');
Route::get('/vehicel/detai/{reg_number}', [App\Http\Controllers\HomeController::class, 'vehicleDetail'])->name('vehicle.detail');
Route::post('/find/model', [App\Http\Controllers\HomeController::class, 'findModel'])->name('find.model');
Route::get('/find/car/spareparts', [App\Http\Controllers\HomeController::class, 'getCarSpareParts'])->name('find.model.spareparts');
Route::get('find-a-part', [App\Http\Controllers\HomeController::class, 'findParts'])->name('find.parts');
Route::get('parts/search', [App\Http\Controllers\HomeController::class, 'partsSearch'])->name('partsfilter');
Route::get('car/spareparts/{make_id}', [\App\Http\Controllers\HomeController::class, 'getSpareParts']);
Route::get('spareparts/detail/{id}', [\App\Http\Controllers\HomeController::class, 'sparePartsDetail'])->name('product.detail');
Route::get('add-to-cart/{id}', [\App\Http\Controllers\HomeController::class, 'addToCart'])->name('add.to.cart');
Route::post('purchase/', [\App\Http\Controllers\HomeController::class, 'purchase'])->name('purchase');
Route::get('cart/items', [\App\Http\Controllers\HomeController::class, 'cartItems'])->name('cart.items');
Route::get('parts/type', [\App\Http\Controllers\HomeController::class, 'PartTypes'])->name('parts.type');

Auth::routes();
Route::group(['middleware' => ['auth', 'supplier'],'prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.home');
    Route::get('order', [SupplierController::class, 'order'])->name('supplier.order');
    Route::get('send/offer/{id}', [SupplierController::class, 'sendOffer'])->name('send.offer');
    Route::get('offers', [SupplierController::class, 'allOffers'])->name('offer.list');
    Route::post('send/offer/{id}', [SupplierController::class, 'sendOfferStore'])->name('send.offer.store');
});
Route::get('profile/{user_id}', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile.index');
Route::put('profile/update/{user_id}', [\App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
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
Route::group(['middleware' => ['auth', 'customer'],'prefix' => 'customer'], function () {
    Route::get('/', [BreakerController::class, 'index'])->name('breaker.home');
    Route::get('requested/order', [BreakerController::class, 'requestedOrder'])->name('request.order');
    Route::post('request/order', [BreakerController::class, 'requestOrder'])->name('store.request.order');
    Route::post('order/products', [BreakerController::class, 'orderSave'])->name('save.order');
    Route::get('supplier/offers', [BreakerController::class, 'supplierOffer'])->name('supplier.offer.list');
    Route::get('purchased/item', [BreakerController::class, 'purchasedItem'])->name('purchase.item.list');
});

Route::get('send-mail', function () {
    $data = [];
    \Illuminate\Support\Facades\Mail::send('email.message', $data, function($message) use ($data) {
        $message->to('jk@gmail.com', '')->subject
        ("Testing email by Spareparts");
        $message->from('admin@admin.com','Spareparts');
    });
});

Route::get('send-twilio-sms', function () {

    $account_sid = config("app.TWILIO_ACCOUNT_SID");
    $auth_token = config("app.TWILIO_AUTH_TOKEN");
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
//    $twilio_number = "+15017122661";

    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
    // Where to send a text message (your cell phone?)
        '+923002656488',
        array(
            'from' => '+18508765040',
            'body' => 'I sent this message in under 10 minutes!'
        )
    );
//    $sid = config("app.TWILIO_ACCOUNT_SID");
//    $token = config("app.TWILIO_AUTH_TOKEN");
//    $twilio = new Client($sid, $token);
//
//    $message = $twilio->messages
//        ->create("+923002656488", // to
//            ["body" => "Hi there!", "from" => "+18508765040"]
//        );
//
//    print($message->sid);
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
