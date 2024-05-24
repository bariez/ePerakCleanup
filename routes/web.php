<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    '\Workbench\Frontend\Http\Controllers\FrontendController@index'
)->name('index');

Route::middleware(['auth', 'verified'])
    ->group(
        function () {
            Route::get('/home', Home::class)->name('home');
            Route::get('/indexhome', Home::class)->name('indexhome');
        }
    );

include __DIR__.'/auth.php';
include __DIR__.'/my.php';
