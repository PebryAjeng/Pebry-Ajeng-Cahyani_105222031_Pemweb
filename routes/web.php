<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\EventController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/event/submit', [SchedulerController::class, 'submit'])->name('event.submit');
// Route::get('/home', [SchedulerController::class, 'home'])->name('event.home');
Route::get('event/get-selected-data', [SchedulerController::class, 'getSelectedData'])->name('event.get-selected-data');


Route::prefix('event')->name('event.')->group(function(){
    Route::get('/', [SchedulerController::class, 'home'])->name('home');
    Route::post('submit', [SchedulerController::class, 'submit'])->name('submit');
    Route::post('update', [SchedulerController::class, 'update'])->name('update');
    Route::post('delete', [SchedulerController::class, 'delete'])->name('delete');
    Route::get('get-json', [SchedulerController::class, 'getJson'])->name('get-json');
    Route::get('get-selected-data', [SchedulerController::class, 'getSelectedData'])->name('get-selected-data');
});
