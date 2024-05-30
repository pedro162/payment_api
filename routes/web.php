<?php

use Illuminate\Support\Facades\Route;
/* 
Route::get('/', function () {
    return view('welcome');
});


Route::get('/vite', function(){
	return view("vite");
});
 */

Route::get('/{any}', function () {
	return view("master");
})->where('any', '.*');
