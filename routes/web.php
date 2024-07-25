<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClaimedItemController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
    });
Route::get('/register', function () {
return view('register');
});

Route::get('/login', function () {
return view('login');
});

Route::get('/home', function () {
return view('home');
});

Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users/search/{firstname}', [UserController::class, 'search']);

Route::get('/home', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::get('/items/search/{name}', [ItemController::class, 'search']);

Route::get('/profile', [UserController::class, 'show'])->name('profile');
Route::post('/profile', [UserController::class, 'update'])->name('profile.update');

Route::middleware(['admin'])->group(function () {
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    Route::get('/home', [ItemController::class, 'index']);
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('items', ItemController::class);
   
});
Route::get('/home', [ItemController::class, 'index'])->name('home');
Route::middleware(['user'])->group(function () {
    Route::patch('/items/{id}/claim', [ItemController::class, 'updateStatus']);
    Route::get('/claimeditems', [ClaimedItemController::class, 'getClaimedItems']);
    Route::get('/claimIT', [ItemController::class, 'claimIT'])->name('claimIT');
    Route::post('/claim/{id}', [ItemController::class, 'claimItem'])->name('claim.item');
    Route::get('/claimIT', [ItemController::class, 'claim'])->name('claimIT');
  
});

Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
