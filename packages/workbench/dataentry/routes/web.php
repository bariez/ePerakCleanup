<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Dataentry\Http\Controllers\DataentryController;

Route::group(
    [
        'namespace'  => '\Workbench\Dataentry\Http\Controllers',
        'prefix'     => 'dataentry',
        'as'         => 'dataentry::',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/searchkampung/index', 'DataentryController@index')->name('searchkampung.index');
        Route::get('/dun/{parlimenid}', 'DataentryController@dun')->name('dun');
        Route::get('/mukim/{daerahid}', 'DataentryController@mukim')->name('mukim');
        Route::get('/parlimenKampung/{daerahid}/{mukimid}', 'DataentryController@parlimenKampung')->name('parlimenKampung');
        Route::get('/kampung/{parlimenid}/{dunid}/{daerahid}/{mukimid}/{catpetampatan}/{kampung}', 'DataentryController@kampung')->name('kampung');
        // Route::post('/searchkampung/getkampung', ['uses' => 'DataentryController@getkampung', 'as' => 'searchkampung.getkampung']);

        Route::get('/searchkampung/resultsearch', ['uses' => 'DataentryController@resultsearch', 'as' => 'searchkampung.resultsearch']);
        Route::get('/searchkampung/mainmenu/{id}/{tabmain}/{tabdetail}/{iddetail}', ['uses' => 'DataentryController@mainmenu', 'as' => 'searchkampung.mainmenu']);
        Route::get('/searchkampung/editkampung/{id}/{tabmain}/{tabdetail}/{iddetail}', ['uses' => 'DataentryController@editkampung', 'as' => 'searchkampung.editkampung']);
        Route::get('/searchkampung/gettab/{id}/{tabid}/{tabdetail}/{iddetail}', 'DataentryController@gettab')->name('gettab');
        Route::get('/searchkampung/profil/{id}', 'DataentryController@profil')->name('profil');
        Route::post('/searchkampung/savekampung', ['uses' => 'DataentryController@savekampung', 'as' => 'searchkampung.savekampung']);
        Route::post('/searchkampung/savestruktur', ['uses' => 'DataentryController@savestruktur', 'as' => 'searchkampung.savestruktur']);
        Route::post('/searchkampung/editstruktur', ['uses' => 'DataentryController@editstruktur', 'as' => 'searchkampung.editstruktur']);
        Route::get('/searchkampung/deletestruk/{iddetail}/{idkampung}', 'DataentryController@deletestruk')->name('deletestruk');
        Route::get('/jeniskemudahan/{catid}', 'DataentryController@jeniskemudahan')->name('jeniskemudahan');
        Route::post('/searchkampung/savekemudahan', ['uses' => 'DataentryController@savekemudahan', 'as' => 'searchkampung.savekemudahan']);
        Route::post('/searchkampung/editkemudahan', ['uses' => 'DataentryController@editkemudahan', 'as' => 'searchkampung.editkemudahan']);
        Route::get('/searchkampung/deletekemudahan/{iddetail}/{idkampung}', 'DataentryController@deletekemudahan')->name('deletekemudahan');
        Route::post('/searchkampung/savepencapaian', ['uses' => 'DataentryController@savepencapaian', 'as' => 'searchkampung.savepencapaian']);
        Route::post('/searchkampung/editpencapaian', ['uses' => 'DataentryController@editpencapaian', 'as' => 'searchkampung.editpencapaian']);
        Route::get('/searchkampung/deletepencapaian/{iddetail}/{idkampung}', 'DataentryController@deletepencapaian')->name('deletepencapaian');
        Route::post('/searchkampung/saveaktiviti', ['uses' => 'DataentryController@saveaktiviti', 'as' => 'searchkampung.saveaktiviti']);
        Route::post('/searchkampung/editaktiviti', ['uses' => 'DataentryController@editaktiviti', 'as' => 'searchkampung.editaktiviti']);
        Route::get('/searchkampung/deleteaktiviti/{iddetail}/{idkampung}', 'DataentryController@deleteaktiviti')->name('deleteaktiviti');
        Route::post('/searchkampung/savepengeluar', ['uses' => 'DataentryController@savepengeluar', 'as' => 'searchkampung.savepengeluar']);
        Route::post('/searchkampung/editpengeluar', ['uses' => 'DataentryController@editpengeluar', 'as' => 'searchkampung.editpengeluar']);
        Route::get('/searchkampung/deletepencapaian/{iddetail}/{idkampung}', 'DataentryController@deletepencapaian')->name('deletepencapaian');
        Route::get('/searchkampung/deletepengeluar/{iddetail}/{idkampung}', 'DataentryController@deletepengeluar')->name('deletepengeluar');
        Route::get('/jenisproduk/{catid}', 'DataentryController@jenisproduk')->name('jenisproduk');
        Route::post('/searchkampung/saveproduk', ['uses' => 'DataentryController@saveproduk', 'as' => 'searchkampung.saveproduk']);
        Route::get('/searchkampung/deleteproduk/{iddetail}/{idkampung}/{idpengeluar}', 'DataentryController@deleteproduk')->name('deleteproduk');
        Route::post('/searchkampung/editproduk', ['uses' => 'DataentryController@editproduk', 'as' => 'searchkampung.editproduk']);
        Route::post('/searchkampung/saveprojek', ['uses' => 'DataentryController@saveprojek', 'as' => 'searchkampung.saveprojek']);
        Route::post('/searchkampung/editprojek', ['uses' => 'DataentryController@editprojek', 'as' => 'searchkampung.editprojek']);
        Route::get('/searchkampung/deleteprojek/{iddetail}/{idkampung}', 'DataentryController@deleteprojek')->name('deleteprojek');
        Route::post('/searchkampung/savegaleri', ['uses' => 'DataentryController@savegaleri', 'as' => 'searchkampung.savegaleri']);
        Route::post('/searchkampung/editgaleri', ['uses' => 'DataentryController@editgaleri', 'as' => 'searchkampung.editgaleri']);
        Route::get('/searchkampung/deletegaleri/{iddetail}/{idkampung}', 'DataentryController@deletegaleri')->name('deletegaleri');
        Route::post('/searchkampung/addgaleridetail', ['uses' => 'DataentryController@addgaleridetail', 'as' => 'searchkampung.addgaleridetail']);
        Route::get('/searchkampung/deletegaleridetail/{iddetail}/{idkampung}/{idgaleridetail}', 'DataentryController@deletegaleridetail')->name('deletegaleri');

        Route::post('/searchkampung/editgaleridetail', ['uses' => 'DataentryController@editgaleridetail', 'as' => 'searchkampung.editgaleridetail']);
        Route::get('/searchkampung/cetakprofil/{type}/{idkampung}', 'DataentryController@cetakprofil')->name('cetakprofil');

        Route::get('/searchkampung/isirumah/ketuaisirumah/{idkampung}', 'DataentryController@ketuaisirumah')->name('ketuaisirumah');
        Route::get('/searchkampung/isirumah/addketua/{idkampung}', 'DataentryController@addketua')->name('addketua');

        Route::post('/searchkampung/saveketuarumah', ['uses' => 'DataentryController@saveketuarumah', 'as' => 'searchkampung.saveketuarumah']);
        Route::post('/searchkampung/importketuarumah', ['uses' => 'DataentryController@importketuarumah', 'as' => 'searchkampung.importketuarumah']);

        Route::get('/searchkampung/isirumah/editketua/{idisirumah}/{idkampung}', 'DataentryController@editketua')->name('editketua');
        Route::post('/searchkampung/editketuarumah', ['uses' => 'DataentryController@editketuarumah', 'as' => 'searchkampung.editketuarumah']);
        Route::get('/searchkampung/isirumah/viewketua/{idisirumah}/{idkampung}', 'DataentryController@viewketua')->name('viewketua');
        Route::get('/searchkampung/isirumah/ahliisirumah/{idkampung}/{rumahid}', 'DataentryController@ahliisirumah')->name('ahliisirumah');
        Route::get('/searchkampung/isirumah/addahli/{idkampung}/{idrumah}', 'DataentryController@addahli')->name('addahli');
        Route::post('/searchkampung/saveahli', ['uses' => 'DataentryController@saveahli', 'as' => 'searchkampung.saveahli']);
        Route::post('/searchkampung/importisirumah', ['uses' => 'DataentryController@importisirumah', 'as' => 'searchkampung.importisirumah']);
        Route::get('/searchkampung/isirumah/editahli/{idahli}/{idkampung}/{idrumah}', 'DataentryController@editahli')->name('editahli');
        Route::post('/searchkampung/editahlirumah', ['uses' => 'DataentryController@editahlirumah', 'as' => 'searchkampung.editahlirumah']);
        Route::get('/searchkampung/isirumah/viewahli/{idahli}/{idkampung}/{idrumah}', 'DataentryController@viewahli')->name('viewahli');

        Route::get('/searchkampung/isirumah/deleteahli/{idahli}/{idkampung}/{idrumah}', 'DataentryController@deleteahli')->name('deleteahli');

        Route::get('/searchkampung/isirumah/deleteketua/{idketua}/{idkampung}/{idrumah}', 'DataentryController@deleteketua')->name('deleteketua');

        Route::get('/typefile/{type}/{action}', 'DataentryController@typefile')->name('typefile');

        Route::get('/searchkampung/cetakkir/{type}/{idkampung}/{idrumah}', 'DataentryController@cetakkir')->name('cetakkir');
        Route::get('/searchkampung/cetakkirAll/{type}/{idkampung}', 'DataentryController@cetakkirAll')->name('cetakkirAll');
        Route::get('/searchkampung/deletekampung/{idkampung}', 'DataentryController@deletekampung')->name('deletekampung');
        Route::get('/gambaredit/{id}', 'DataentryController@gambaredit')->name('gambaredit');
        //edit 21/02/2024
        Route::get('/editKampung/menukampungEdit', 'DataentryController@menuKampungEdit')->name('editKampung.menukampungEdit');
        Route::get('/editIsiRumah/menukampungEditIsi', 'DataentryController@menuKampungEditIsi')->name('editIsiRumah.menukampungEditIsi');
    }
);
