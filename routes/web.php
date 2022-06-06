<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\{AuthController, DashboardController as UserDashboard, EventController};
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

Route::redirect('/', '/login');

// ======================================== Authentication ========================================== // 
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// ======================================== Admin ========================================== // 
Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
});


// ======================================== User ========================================== // 
Route::middleware('auth')->group(function(){
    Route::get('dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    
});

// Route::get('event', [EventController::class, ' index']);

Route::post('event/action', [EventController::class, 'action']);
ROute::get('event/create', [EventController::class, 'create'])->name('event.create');
ROute::post('event', [EventController::class, 'store'])->name('event.store');