<?php

use App\Infrastructure\UI\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::put('user/{uuid}', [UserController::class, 'update'])->name('user.update');
});
