<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)
        ->name('auth.')
        ->group(function () {
            Route::get('login', 'login')->name('login');
            Route::post('login', 'authenticate');

            Route::get('register', 'register')->name('register');
            Route::post('register', 'store');
        });
});

Route::middleware(['auth'])->group(function () {

    Route::group(
        [
            'prefix' => 'media',
            'controller' => MediaController::class
        ],
        function () {
            Route::get('/', 'index');
            Route::post('upload', 'upload');
            Route::delete('destroy', 'destroy');
        }
    );

    Route::prefix('{company}')->middleware(['check.company'])->group(function () {
        Route::get('/', [DashboardController::class,  'dashboard'])->name('dashboard');

        Route::controller(AuthController::class)->group(function () {
            Route::get('profile', 'me')->name('me'); // show profile
            Route::put('profile', 'updateMe')->name('me.update'); // update profile
            Route::post('logout', 'logout')->name('auth.logout');
        });

        Route::prefix('clients')
            ->controller(ClientController::class)
            ->name('clients.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('create', 'store')->name('store');
                Route::get('{user}', 'edit')->name('edit');
                Route::put('{user}', 'update')->name('update');
            });

        Route::prefix('bills')
            ->controller(BillController::class)
            ->name('bills.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('create', 'store')->name('store');
                Route::get('{bill}', 'edit')->name('edit');
                Route::put('{bill}', 'update')->name('update');
            });
    });
});


Route::get('{company}/certificate/{bill}', [BillController::class, 'certificate'])
    ->name('bills.certificate')->middleware(['check.company']);
