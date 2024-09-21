<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view(uri: '/users', view: 'users.showAll')->name(name: 'users.all');
Route::view(uri: '/game', view: 'game.show')->name(name: 'game.show');
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
Route::get('/chat/message', [ChatController::class, 'messageReceived'])->name('chat.message');
Route::get('/chat/greet/{user}', action: [ChatController::class, 'greetReceived'])->name('chat.greet');