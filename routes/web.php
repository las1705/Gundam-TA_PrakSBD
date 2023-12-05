<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BinController;
use App\Http\Controllers\IceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [Controller::class, 'viewLogin'])->name('login');
Route::post('/', [Controller::class, 'auth'])->name('auth');

Route::get('/register', [Controller::class, 'viewRegister'])->name('register');
Route::post('/verify', [Controller::class, 'verify'])->name('verify');

Route::group(['middleware','check.login'],function() {

    Route::get('/adminHome', [AdminController::class, 'viewHome'])->name('admin.home');
    Route::get('/index', [AdminController::class, 'viewIndex'])->name('admin.index');
    Route::get('/customerAccount', [AdminController::class, 'viewAccount'])->name('admin.customerAccount');
    Route::get('/bin', [BinController::class, 'viewBin'])->name('admin.bin');

    Route::get('/add-{status}', [AdminController::class, 'viewAdd'])->name('admin.add');
    Route::post('/insert-{status}', [AdminController::class, 'insert'])->name('admin.insert');

    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('softDelete/{id}', [AdminController::class, 'softDelete'])->name('admin.softDelete');

    Route::post('deleteSingle/{id}', [BinController::class, 'deleteSingle'])->name('admin.deleteSingle');
    Route::post('deleteAll', [BinController::class, 'deleteAll'])->name('admin.deleteAll');

    Route::post('restoreSingle/{id}', [BinController::class, 'restoreSingle'])->name('admin.restoreSingle');
    Route::post('restoreAll', [BinController::class, 'restoreAll'])->name('admin.restoreAll');

    Route::get('search-{status}', [AdminController::class, 'search'])->name('admin.search');

    Route::post('deactivateAccount/{id}', [AdminController::class, 'accountDeactivate'])->name('admin.accountDeactivate');
    Route::post('accountActivate/{id}', [AdminController::class, 'accountActivate'])->name('admin.accountActivate');
    Route::post('accountDelete/{id}', [AdminController::class, 'accountDelete'])->name('admin.accountDelete');

    Route::get('/customerHome', [CustomerController::class, 'viewHomec'])->name('customer.home');
    Route::get('/customerHistory', [CustomerController::class, 'viewHistoryc'])->name('customer.history');

    Route::post('/buy/{product}-{user}', [CustomerController::class, 'buy'])->name('customer.buy');

    Route::get('searchc', [CustomerController::class, 'searchc'])->name('customer.search');

    Route::get('/account/{id}', [CustomerController::class, 'viewAccount'])->name('customer.accountEdit');
    Route::post('/accountUpadte/{id}', [CustomerController::class, 'updateAccount'])->name('customer.accountUpdate');
    Route::post('accountSoftDelete/{id}', [CustomerController::class, 'accountSoftDelete'])->name('customer.accountSoftDelete');

    Route::get('/logout', [Controller::class, 'logout'])->name('logout');

});


