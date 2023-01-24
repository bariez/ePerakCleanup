<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Reporting\Http\Controllers\ReportingController;

Route::group(
    [
        'namespace'  => '\Workbench\Reporting\Http\Controllers',
        'prefix'     => 'reporting',
        'as'         => 'reporting::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

       // Route::get('/', 'ReportingController@index')->name('reporting.index');
       Route::get('/userlogin/index', 'ReportingController@getUserLoginIndex')->name('reporting.getUserLoginIndex');
       Route::get('/userlogin/ajax/{nama}/{jawatan}/{role}/{dept}', 'ReportingController@getUserLoginAjax')->name('reporting.getUserLoginAjax');
       Route::get('/userlogin/{type}/{nama}/{jawatan}/{role}/{dept}', 'ReportingController@getUserLoginPrint')->name('reporting.getUserLoginPrint');

       Route::get('/statistic/index', 'ReportingController@getStatistic')->name('reporting.getStatistic');
       // Route::get('/statistic/{type}', 'ReportingController@getStatisticPrint')->name('reporting.getStatisticPrint');


       Route::get('/countpetempatan', 'ReportingController@countpetempatan')->name('reporting.countpetempatan');
       // Route::get('/countdata', 'ReportingController@countdata')->name('reporting.countdata');
      
    }
);