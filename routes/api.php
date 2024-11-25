<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix("v1")->group(function () {

    Route::prefix("category")->controller(CategoryController::class)->group(function () {
        Route::get("/", "index");
        Route::post("create", "store");
    });


    // usercontroller
    Route::prefix("auth")->controller(UserController::class)->group(function () {
        Route::post("logout", "logout");
    });
});


Route::prefix("auth")->controller(UserController::class)->group(function () {
    Route::post("login", "login");
});


