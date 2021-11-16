<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//RUTAS ADMIN
//Route::middleware('admin')->group(function () {
    //DASHBOARD
    Route::prefix('dashboard')->group(function () {
        Route::get('/tracker/{tipo}', [DashboardController::class, 'getTracker'])->name('tracker');
    });
//});