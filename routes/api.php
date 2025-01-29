<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Orion\Facades\Orion;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth.basic');

Orion::resource('profiles', ProfileController::class)->only(['store', 'update', 'destroy'])->middleware('auth.basic');
Orion::resource('profiles', ProfileController::class)->only('index');