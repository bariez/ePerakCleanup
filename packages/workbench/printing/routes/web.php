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

// Route::group(
//     [
//         'namespace'  => '\Workbench\Site\Http\Controllers',
//         'prefix'     => '',
//         'as'         => 'site::',
//         'middleware' => ['guest','web'],
//     ],
//     function () {

//         Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);
//         Route::get('/pages/{id}', ['uses' => 'PageController@view', 'as' => 'pages.view']);

//     }
// );
