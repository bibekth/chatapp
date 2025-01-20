<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('find-user', [App\Http\Controllers\HomeController::class, 'findUser'])->name('find.user');
Route::post('/add-friend', [App\Http\Controllers\FriendController::class, 'addFriend'])->name('addFriend');
Route::resource('message', App\Http\Controllers\MessageController::class);
Route::get('retrieve-msg/{id}', [App\Http\Controllers\HomeController::class, 'retrieveMessage'])->name('retrieve.message');
Route::post('/store-message/{id}', [App\Http\Controllers\HomeController::class, 'storeMessage'])->name('store.message');
// Route::get('/docs', [App\Http\Controllers\HomeController::class, 'docs'])->name('docs');
Route::post('/pusher/auth', [App\Http\Controllers\HomeController::class, 'pusherAuth'])->name('pusher.auth');
Route::get('/last-message/techenfield-2024',[[App\Http\Controllers\HomeController::class, 'lastMessage']])->name('last.message');
