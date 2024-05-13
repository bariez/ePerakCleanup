<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Gis\Http\Controllers\DashboardController;

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
