<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapacityConfigurationController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PriceConfigurationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::post('/authenticate',[AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function ()  {
    Route::group(['middleware' => ['admin']], function ()  {
        Route::resource('/user', UserController::class);
        Route::resource('/vehicle', VehicleController::class);
        Route::resource('/capacity', CapacityConfigurationController::class)->except(['create','store','destroy']);
        Route::resource('/price', PriceConfigurationController::class)->except(['create','store','destroy']);
        Route::get('/parking/report', [ParkingController::class, 'report'])->name('parking.report');
        Route::get('/parking/{daterange}/excel', [ParkingController::class, 'excel'])->name('parking.excel');
    });
    Route::resource('/parking', ParkingController::class);
    Route::put('/parking/{parking}/out', [ParkingController::class, 'out'])->name('parking.out');
});
