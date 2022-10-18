<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->  group(function () {
    Route::controller(EmailController::class)->group(function() {
        Route::get('/email/add','addEmail')->name('email.add');
        Route::get('/emails','index')->name('email.index');
        Route::post('/email/store','storeEmail')->name('email.store');
        Route::post('email/delete','delete')->name('email.delete');
    });
});
