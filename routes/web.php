<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvitationController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('events/{slug}/register', [EventController::class, 'event_register'])->name('event_register');


Route::get('/pdf', function() {
    return view('dashboard.invitations.pdf');
});

Auth::routes();

Route::prefix('dashboard')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('companies', CompanyController::class);
    Route::resource('users', UserController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('events', EventController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('invitations', InvitationController::class);
    Route::get('companies/delete/{id}', [CompanyController::class, 'destroy'])->name('delete_company');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('delete_user');
    Route::get('agents/delete/{id}', [AgentController::class, 'destroy'])->name('delete_agent');
    Route::get('clients/delete/{id}', [ClientController::class, 'destroy'])->name('delete_client');
    Route::get('events/delete/{id}', [EventController::class, 'destroy'])->name('delete_event');
    Route::get('sales/delete/{id}', [SalesController::class, 'destroy'])->name('delete_sales');
    Route::get('invitations/delete/{id}', [InvitationController::class, 'destroy'])->name('delete_invitation');
    Route::post('clients/upload', [ClientController::class, 'upload_clients'])->name('upload_clients');
    Route::post('invitations/upload', [InvitationController::class, 'upload_invitations'])->name('upload_invitations');
    Route::get('invitations/send/{phone_number}', [InvitationController::class, 'send_qr_whatsapp'])->name('send_qr_whatsapp');
    Route::post('invitations/change_status', [InvitationController::class, 'change_status'])->name('change_status');
});


