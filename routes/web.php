<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController;

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

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::prefix('room_type')->group(function () {
                Route::get('/', [RoomTypeController::class, 'index'])->name('admin.roomtype.index');
                Route::get('/create', [RoomTypeController::class, 'create'])->name('admin.roomtype.create');
                Route::post('/', [RoomTypeController::class, 'store'])->name('admin.roomtype.store');
                Route::get('/{id}', [RoomTypeController::class, 'edit'])->name('admin.roomtype.edit');
                Route::post('/{id}', [RoomTypeController::class, 'update'])->name('admin.roomtype.update');
                Route::delete('/{id}', [RoomTypeController::class, 'destroy'])->name('admin.roomtype.destroy');
            });
            Route::prefix('rooms')->group(function () {
                Route::get('/', [RoomController::class, 'index'])->name('admin.rooms.index');
                Route::get('/create', [RoomController::class, 'create'])->name('admin.rooms.create');
                Route::post('/', [RoomController::class, 'store'])->name('admin.rooms.store');
                Route::get('/{id}', [RoomController::class, 'edit'])->name('admin.rooms.edit');
                Route::post('/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
                Route::delete('/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
            });
        });
        Route::prefix('booking')->group(function () {
            Route::get('/', [BookingController::class, 'index'])->name('admin.booking.index');
        });
    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('booking')->group(function () {
        Route::get('/', [BookingController::class, 'own'])->name('booking.own');
        Route::get('/create/{roomId}', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/edit/{bookingId}', [BookingController::class, 'edit'])->name('booking.edit');
        Route::post('/{id}', [BookingController::class, 'update'])->name('booking.update');
        Route::delete('/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
       

        Route::get('available-rooms', [BookingController::class, 'availableRooms'])->name('booking.rooms.search');
    });
});
