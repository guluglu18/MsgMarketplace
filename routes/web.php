<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\AdController::class, 'index'])->name('welcome');
Route::get('/single-ad/{id}', [App\Http\Controllers\AdController::class, 'singleAd'])->name('singleAd');
Route::post('/single-ad/{id}/send-message', [App\Http\Controllers\AdController::class, 'sendMessage'])->name('sendMessage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');
Route::get('/home/show-form', [App\Http\Controllers\HomeController::class, 'showForm'])->name('home.showForm');
Route::get('/home/ad/{id}', [App\Http\Controllers\HomeController::class, 'singleAd'])->name('home.singleAd');
Route::get('/home/messages', [App\Http\Controllers\HomeController::class, 'showMessages'])->name('home.showMessages');
Route::get('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'reply'])->name('home.reply');
Route::post('/home/messages/reply', [App\Http\Controllers\HomeController::class, 'replyStore'])->name('home.replyStore');


Route::post('/home/show-form', [App\Http\Controllers\HomeController::class, 'saveData'])->name('home.showForm');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'saveDeposit'])->name('home.addDeposit');
