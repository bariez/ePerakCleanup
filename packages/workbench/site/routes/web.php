<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Site\Http\Controllers\SiteController;

Route::group(
    [
        'namespace'  => '\Workbench\Site\Http\Controllers',
        'prefix'     => 'site',
        'as'         => 'site::',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/users/index', 'SiteController@index')->name('site.index');
        Route::get('/users/create', ['uses' => 'SiteController@create', 'as' => 'users.create']);
        Route::get('/users/edit/{id}', ['uses' => 'SiteController@edit', 'as' => 'users.edit']);
        Route::get('/passwordedit/{id}', ['uses' => 'SiteController@passwordedit', 'as' => 'passwordedit']);
        //Route::get('/account/{id}/edit',  ['uses' => 'SiteController@edit', 'as' => 'users.edit']);
        Route::post('/users/store', ['uses' => 'SiteController@store', 'as' => 'users.store']);
        Route::post('/users/update/{id}', ['uses' => 'SiteController@update', 'as' => 'users.update']);
        Route::get('/users/index', ['uses' => 'SiteController@index', 'as' => 'users.index']);

        Route::get('/approveindex', 'SiteController@approveindex')->name('users.approveindex');
        Route::get('/users/approve/{id}', ['uses' => 'SiteController@approve', 'as' => 'users.approve']);
        Route::post('/users/approveusers/{id}', ['uses' => 'SiteController@approveusers', 'as' => 'users.approveusers']);

        Route::get('/users/accesslog/{id}', 'SiteController@accesslog')->name('users.accesslog');
        Route::get('/permissions/index', 'SiteController@indexpermission')->name('permissions.index');
        Route::put('/permissions/update', 'SiteController@updatepermission')->name('permissions.update');

        Route::get('/roles/index', 'SiteController@indexrole')->name('roles.index');
        Route::get('/roles/create', 'SiteController@rolecreate')->name('roles.create');
        Route::post('/roles/store', 'SiteController@rolestore')->name('roles.store');
        Route::get('/roles/edit/{id}', 'SiteController@rolesedit')->name('roles.edit');
        Route::post('/roles/destroy', 'SiteController@rolesdestroy')->name('roles.destroy');
        Route::post('/roles/update', 'SiteController@rolesupdate')->name('roles.update');

        //lookup

        Route::get('/lookup/index', 'SiteController@lookupindex')->name('lookup.index');
        Route::get('/lkpmaster/edit/{id}', 'SiteController@geteditmaster')->name('lkpmaster.geteditmaster');
        Route::get('/lkpmaster/create', ['uses' => 'SiteController@createmaster', 'as' => 'lkpmaster.createmaster']);
        Route::post('/lkpmaster/storemaster', ['uses' => 'SiteController@storemaster', 'as' => 'lkpmaster.storemaster']);
        Route::post('/lkpmaster/editmaster/{id}', ['uses' => 'SiteController@editmaster', 'as' => 'lkpmaster.editmaster']);
        Route::get('/lkpmaster/listdatalookup/{id}', 'SiteController@listdatalookup')->name('lkpmaster.listdatalookup');
        Route::get('/lkpdetail/create/{idmaster}', ['uses' => 'SiteController@createdetail', 'as' => 'lkpdetail.createdetail']);
        Route::post('/lkpdetail/storedetail', ['uses' => 'SiteController@storedetail', 'as' => 'lkpdetail.storedetail']);
        Route::get('/lkpdetail/edit/{iddetail}', 'SiteController@geteditkdetail')->name('lkpdetail.geteditkdetail');
        Route::post('/lkpdetail/editdetail/{id}', ['uses' => 'SiteController@editdetail', 'as' => 'lkpdetail.editdetail']);

        Route::get('/parlimen/index', 'SiteController@parlimenindex')->name('parlimen.index');
        Route::get('/parlimen/addparlimen', 'SiteController@addparlimen')->name('addparlimen');
        Route::post('/parlimen/saveparlimen', ['uses' => 'SiteController@saveparlimen', 'as' => 'parlimen.saveparlimen']);
        Route::get('/parlimen/editparlimen/{id}', 'SiteController@editparlimen')->name('editparlimen');
        Route::post('/parlimen/saveeditparlimen', ['uses' => 'SiteController@saveeditparlimen', 'as' => 'parlimen.saveeditparlimen']);
        Route::get('/parlimen/viewparlimen/{id}', 'SiteController@viewparlimen')->name('viewparlimen');
        Route::get('/parlimen/deleteparlimen/{id}', 'SiteController@deleteparlimen')->name('deleteparlimen');
        Route::get('/dun/index', 'SiteController@dunindex')->name('dun.index');
        Route::get('/dun/adddun', 'SiteController@adddun')->name('adddun');
        Route::post('/dun/savedun', ['uses' => 'SiteController@savedun', 'as' => 'dun.savedun']);
        Route::get('/dun/editdun/{id}', 'SiteController@editdun')->name('editdun');
        Route::post('/dun/saveeditdun', ['uses' => 'SiteController@saveeditdun', 'as' => 'dun.saveeditdun']);
        Route::get('/dun/viewdun/{id}', 'SiteController@viewdun')->name('viewdun');
        Route::get('/dun/deletedun/{id}', 'SiteController@deletedun')->name('deletedun');
        Route::get('/daerah/index', 'SiteController@daerahindex')->name('daerah.index');
        Route::get('/daerah/adddaerah', 'SiteController@adddaerah')->name('adddaerah');
        Route::post('/daerah/savedaerah', ['uses' => 'SiteController@savedaerah', 'as' => 'daerah.savedaerah']);
        Route::get('/daerah/editdaerah/{id}', 'SiteController@editdaerah')->name('editdaerah');
        Route::post('/daerah/saveeditdaerah', ['uses' => 'SiteController@saveeditdaerah', 'as' => 'daerah.saveeditdaerah']);
        Route::get('/daerah/viewdaerah/{id}', 'SiteController@viewdaerah')->name('viewdaerah');
        Route::get('/daerah/deletedaerah/{id}', 'SiteController@deletedaerah')->name('deletedaerah');
        Route::get('/mukim/index', 'SiteController@mukimindex')->name('mukim.index');
        Route::get('/mukim/addmukim', 'SiteController@addmukim')->name('addmukim');
        Route::post('/mukim/savemukim', ['uses' => 'SiteController@savemukim', 'as' => 'mukim.savemukim']);
        Route::get('/mukim/editmukim/{id}', 'SiteController@editmukim')->name('editmukim');
        Route::post('/mukim/saveeditmukim', ['uses' => 'SiteController@saveeditmukim', 'as' => 'mukim.saveeditmukim']);
        Route::get('/mukim/viewmukim/{id}', 'SiteController@viewmukim')->name('viewmukim');
        Route::get('/mukim/deletemukim/{id}', 'SiteController@deletemukim')->name('deletemukim');
        Route::get('/kampung/index', 'SiteController@kampungindex')->name('kampung.index');
        Route::get('/kampung/addkampung', 'SiteController@addkampung')->name('addkampung');
        Route::get('/dun/{parlimenid}', 'SiteController@dun')->name('dun');
        Route::get('/mukim/{daerahid}', 'SiteController@mukim')->name('mukim');
        Route::get('/induk/{parlimen}/{dun}/{daerah}/{mukim}', 'SiteController@induk')->name('induk');

        Route::post('/kampung/savekampung', ['uses' => 'SiteController@savekampung', 'as' => 'kampung.savekampung']);
        Route::get('/kampung/editkampung/{id}', 'SiteController@editkampung')->name('editkampung');
        Route::post('/kampung/saveeditkampung', ['uses' => 'SiteController@saveeditkampung', 'as' => 'kampung.saveeditkampung']);

        Route::get('/kampung/viewkampung/{id}', 'SiteController@viewkampung')->name('viewkampung');
        Route::get('/kampung/deletekampung/{id}', 'SiteController@deletekampung')->name('deletekampung');
        Route::get('/getmukim/{daerahid}', 'SiteController@getmukim')->name('getmukim');
        Route::get('/auditlog/index', 'SiteController@auditlogindex')->name('auditlogindex');
        Route::get('/auditlog/searchlog', 'SiteController@searchlog')->name('searchlog');
        Route::get('/auditlog/searchlog', 'SiteController@searchlog')->name('searchlog');
        Route::get('/auditlog/users/{idrole}', 'SiteController@searchusers')->name('searchusers');
        Route::get('/exportauditlog/{type}/{user}/{datefrom}/{dateto}/{kat}', 'SiteController@exportauditlog')->name('exportauditlog');
    }
);

///start contoh TOT

// Route::get('/', function()
// {
//    return View::make('pages.home');
// });
// Route::get('/about', function()
// {
//    return View::make('pages.contact');
// });

//end contoh tot

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
