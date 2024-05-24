<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Printing\Http\Controllers\PrintingController;

Route::group(
    [
        'namespace'  => '\Workbench\Printing\Http\Controllers',
        'prefix'     => 'printing',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/', 'PrintingController@index')->name('printing.index');
    }
);
