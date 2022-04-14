<?php

use App\Http\Controllers\ControlPaperController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\AgencyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;

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


Route::post('login', [App\Http\Controllers\API\LoginController::class,'login'])->name('login');

Route::post('register', 'App\Http\Controllers\API\LoginController@register');

Route::middleware('auth:api')->group(function(){
    // Agency routes
    Route::get('agencies', [AgencyController::class, 'index'])->name('index.index');
    // Booking routes
    Route::get('booking/last', [BookingController::class, 'last'])->name('booking.last');
    Route::get('company/bookings', [BookingController::class, 'getBookingsByCompany'])->name('booking.getBookingsByCompany');
    Route::get('activeAgencyBookings/{agency}', [BookingController::class, 'activeAgencyBookings'])->name('booking.activeAgencyBookings');
    Route::post('booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::put('booking/{booking}/model', [BookingController::class, 'updateVehicleModel'])->name('booking.updateVehicleModel');
    Route::put('booking/{booking}/driver', [BookingController::class, 'updateDriver'])->name('booking.updateDriver');
    Route::get('booking/{booking}/show/vehicleModel', [BookingController::class, 'showVehicleModel'])->name('booking.showVehicleModel');
    Route::get('booking/{booking}/show/driver', [BookingController::class, 'showDriver'])->name('booking.show');
    Route::get('booking/{booking}', [BookingController::class, 'show'])->name('booking.show');

    // Driver routes
    Route::get('company/drivers', [DriverController::class, 'getDriversByCompany'])->name('driver.getDriversByCompany');
    Route::post('driver/store', [DriverController::class, 'store'])->name('driver.store');
    // VehicleModel routes
    Route::get('vehicleModels', [VehicleModelController::class, 'index'])->name('vehicleModel.index');
    Route::get('vehicleModel/{vehicleModel}', [VehicleModelController::class, 'show'])->name('vehicleModel.show');
    // Vehicle routes
    Route::put('setVehicleState/{vehicleId}/{state}', [VehicleController::class, 'setVehicleState'])->name('vehicle.setVehicleState');
    Route::get('vehiclesForClient/{client}/{halfDay}/{bookingStatusId}', [VehicleController::class, 'vehiclesForClient'])->name('vehicle.vehiclesForClient');
    Route::get('vehiclesToWithdrawForClient/{client}/{agency}', [VehicleController::class, 'vehiclesToWithdrawForClient'])->name('vehicle.vehiclesToWithdrawForClient');
    Route::get('vehiclesToReturnForClient/{client}/{agency}', [VehicleController::class, 'vehiclesToReturnForClient'])->name('vehicle.vehiclesToReturnForClient');
    // Control paper routes
    Route::post('updateControlPaper', [ControlPaperController::class, 'update'])->name('controlPaper.update');
    Route::get('controlPaper/{vehicleId}', [ControlPaperController::class, 'show'])->name('controlPaper.show');
    // User routes
    Route::get('user/show/{userId}', [UserController::class, 'show'])->name('user.show');
    Route::post('user/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::get('user/allClients', [UserController::class, 'allClients'])->name('user.allClients');

});