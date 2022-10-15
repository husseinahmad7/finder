<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\OrderController::class, 'index'])->name('home');
Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware('auth');

Route::get('user/manage',[App\Http\Controllers\OrderController::class,'manage'])->name('orders.manage')->middleware('auth');
Route::put('user/manage/mark/{order}',[App\Http\Controllers\OrderController::class,'markedDone'])->name('orders.marked')->middleware('auth');

Route::resource('orders.comments', App\Http\Controllers\CommentController::class)->only(['store','destroy'])->middleware('auth');

Route::get('user/orders/{user}',[App\Http\Controllers\OrderController::class,'userOrders'])->name('ordersByUser')->middleware('auth');
