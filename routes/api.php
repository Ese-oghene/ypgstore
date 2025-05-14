<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('api')->group(function () {

// });

 Route::get('/user', [AuthController::class, 'user']);

 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class, 'login']);
 Route::post('/admin/login', [AuthController::class, 'adminLogin']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix("admin")->middleware('admin')->group(function () {

         // Product routes restricted to admin
        Route::get('/index', [ProductController::class, 'index'])->name('admin.index');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.store');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.show');
        Route::patch('/update/{id}', [ProductController::class, 'update'])->name('admin.update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('admin.destroy');
    });


});
