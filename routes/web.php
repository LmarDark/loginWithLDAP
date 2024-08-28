<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginWithLDAP;

Route::post('logging', [LoginWithLDAP::class, 'userLoginValidate'])->name('userLogin.post');

Route::get('/', function () {
    return view('welcome');
})->name('login.get');

Route::get('/home', function () {
    return view('home');
})->name('home.get');