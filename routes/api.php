<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    //Route::apiResource();
});

Route::get('/v1/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\GetPublicKeyController::class)->name('v1.pagbank.public_key.get');
Route::post('/v1/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\CreatePublicKeyController::class)->name('v1.pagbank.public_key.create');
Route::put('/v1/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\UpdatePublicKeyController::class)->name('v1.pagbank.public_key.update');

Route::get('/v1/payments/qrcode', App\Http\Controllers\V1\QRCodePayment\GetAllQRCodePaymentController::class)->name('v1.payments.qrcode.get_all');
Route::post('/v1/payments/qrcode', App\Http\Controllers\V1\QRCodePayment\StoreQRCodePaymentController::class)->name('v1.payments.qrcode.store');
Route::put('/v1/payments/qrcode', App\Http\Controllers\V1\QRCodePayment\UpdateQRCodePaymentController::class)->name('v1.payments.qrcode.update');

Route::get('/v1/payments/credit-card', App\Http\Controllers\V1\CreditCardPayment\GetAllCreditCardPaymentController::class)->name('v1.payments.credit-card.get_all');
Route::post('/v1/payments/credit-card', App\Http\Controllers\V1\CreditCardPayment\StoreCreditCardPaymentController::class)->name('v1.payments.credit-card.store');
Route::put('/v1/payments/credit-card', App\Http\Controllers\V1\CreditCardPayment\UpdateCreditCardPaymentController::class)->name('v1.payments.credit-card.update');
