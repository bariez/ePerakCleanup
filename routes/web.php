<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\MaklumbalasController;
use App\Http\Controllers\SoalanController;

Route::get(
    '/',
    '\Workbench\Frontend\Http\Controllers\FrontendController@index'
)->name('index');

// --- MULA: ROUTE UNTUK CHATBOT AI ---
Route::post('/api/chatbot', [ChatbotController::class, 'askAI']);
// --- TAMAT: ROUTE UNTUK CHATBOT AI ---

// --- MULA: ROUTE UNTUK MAKLUM BALAS ---
Route::post('/eperak/hantar-maklumbalas', [MaklumbalasController::class, 'store']);
// --- TAMAT: ROUTE UNTUK MAKLUM BALAS ---
// --- DELETE : SOALAN LAZIM FAQ
Route::delete('/site/soalan/delete/{id}', [SoalanController::class, 'destroy'])->name('soalan.destroy');

Route::middleware(['auth', 'verified'])
    ->group(
        function () {
            Route::get('/home', Home::class)->name('home');
            Route::get('/indexhome', Home::class)->name('indexhome');
            
        }
    );

include __DIR__.'/auth.php';
include __DIR__.'/my.php';