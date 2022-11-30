<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('vendor')->group(function () {
    Route::group(['middleware' => ['role:vendor|admin']], function () {
        Route::controller(VendorController::class)->group(function () {
            Route::get('tickets', 'ticketsInformation')->name('tickets');
            Route::get('openTickets', 'getOpenTickets')->name('openTickets');
            Route::get('ticketInfo', 'getTicketInfoUsingId')->name('ticketInfo');
            Route::post('updateTicket', 'updateTicket')->name('updateTicket');
        });
    });
});

Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('trackingPage', function () {
            return view('user.tracking');
        })->name('trackingPage');
        Route::get('tracking', 'ticketTracking')->name('tracking');
        Route::get('createTrackingPage', 'landingPage')->name('createTrackingPage');
        Route::post('createTracking', 'createTicket')->name('createTicket');
    });
});
