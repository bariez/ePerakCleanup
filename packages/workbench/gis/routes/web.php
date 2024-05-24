<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace'  => '\Workbench\Gis\Http\Controllers',
        'prefix'     => 'gis',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/', 'GisController@index')->name('gis.index');
    }
);
