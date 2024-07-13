<?php

use App\Http\Controllers\GroceryListController;
use App\Http\Controllers\GroceryListItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    //Route::apiResource();
});

Route::resource('products', ProductController::class);
Route::resource('groceries', GroceryListController::class);
Route::resource('grocery_items', GroceryListItemController::class);
