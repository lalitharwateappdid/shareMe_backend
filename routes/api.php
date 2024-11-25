<?php

use App\Http\Controllers\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix("v1")->group(function(){

    Route::prefix("category")->controller(Category::class)->group(function(){
        Route::get("/","index");
        Route::post("create","store");
    });
});