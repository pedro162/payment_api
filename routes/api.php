<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    //Route::apiResource();
});

Route::get('/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\GetPublicKeyController::class)->name('pagbank.public_key.get');
Route::post('/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\CreatePublicKeyController::class)->name('pagbank.public_key.create');
Route::put('/pagbank/public-key', App\Http\Controllers\V1\PagBank\PublicKey\UpdatePublicKeyController::class)->name('pagbank.public_key.update');
