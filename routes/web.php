<?php

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
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

// Route to display the upload form
Route::get('/upload-pdf-form', function () {
    return view('upload_pdf');
})->name('upload.pdf.form')->middleware('auth');

// Route to handle the PDF upload and conversion to text
Route::post('/upload-pdf', [PdfController::class, 'uploadPdf'])->name('upload.pdf')->middleware('auth');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => false]);

Route::resource('report', '\App\Http\Controllers\ReportController');
Route::get('view/{id}', '\App\Http\Controllers\ViewController@index');
Route::get('missing', '\App\Http\Controllers\MissingController@index');
Route::post('view', '\App\Http\Controllers\ViewController@store');

Route::prefix('admin')->group(function () {

    Route::resource('pending-account', '\App\Http\Controllers\Admin\AdminPendingAccountController');
    Route::resource('approved-account', '\App\Http\Controllers\Admin\AdminApprovedAccountController');
    Route::resource('declined-account', '\App\Http\Controllers\Admin\AdminDeclinedAccountController');
    Route::resource('approval-account', '\App\Http\Controllers\Admin\AdminAccountApprovalController');

    Route::resource('announcement', '\App\Http\Controllers\Admin\AdminAnnouncementController');
    Route::get('approved/{id}', '\App\Http\Controllers\Admin\ApprovedController@update');
    Route::get('items/{id}', '\App\Http\Controllers\Admin\ItemsController@items');
    Route::get('pending/{id}', '\App\Http\Controllers\Admin\PendingController@update');

    Route::resource('pending', '\App\Http\Controllers\Admin\PendingController');
    Route::resource('approved', '\App\Http\Controllers\Admin\ApprovedController');
    Route::resource('declined', '\App\Http\Controllers\Admin\DeclinedController');



    Route::resource('dashboard', '\App\Http\Controllers\Admin\AdminDashboardController');
    Route::resource('settings', '\App\Http\Controllers\Admin\AdminSettingsController');

});



Route::prefix('user')->group(function () {



    Route::resource('orders', '\App\Http\Controllers\User\OrderController');
    Route::resource('status', '\App\Http\Controllers\User\StatusController');
    Route::resource('place-order', '\App\Http\Controllers\User\PlaceOrderController');

    Route::resource('dashboard', '\App\Http\Controllers\User\AdminDashboardController');
    Route::resource('settings', '\App\Http\Controllers\User\AdminSettingsController');
        Route::resource('profile', '\App\Http\Controllers\ProfileController');
    Route::post('/profile-update', [ProfileController::class, 'update']);


});


// Temporary test payment (bypasses PayPal)
Route::post('/test-payment', [\App\Http\Controllers\TestPaymentController::class, 'createPayment'])->name('test.payment');

// PayPal routes with real sandbox credentials
Route::post('/paypal', [PayPalController::class, 'createPayment'])->name('paypal.create');
Route::get('/paypal/success', [PayPalController::class, 'executePayment'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancelPayment'])->name('paypal.cancel');


Route::resource('logout', '\App\Http\Controllers\LogoutController');

Route::get('/download-pdf', [PdfController::class, 'generatePdf']);