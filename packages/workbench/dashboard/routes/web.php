<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace'  => '\Workbench\Dashboard\Http\Controllers',
        'prefix'     => 'dashboard',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/admin', 'DashboardController@indexadmin')->name('dashboard.indexadmin');
        Route::get('/admin2', 'DashboardController@indexadmin2')->name('dashboard.indexadmin2');
        Route::get('/admin3', 'DashboardController@indexadmin3')->name('dashboard.indexadmin3');
        Route::get('/admindaerah/{menu}', 'DashboardController@admindaerah')->name('dashboard.admindaerah');
        Route::get('/table/{type}', 'DashboardDOController@getTableChart')->name('dashboard.getTableChart');
        Route::get('/mukimname/{mukim_id}', 'DashboardDOController@getMukim')->name('dashboard.getMukim');
        Route::get('/parlimenname/{parlimen_id}', 'DashboardDOController@getParlimen')->name('dashboard.getParlimen');
        Route::get('/dunname/{dun_id}', 'DashboardDOController@getDun')->name('dashboard.getDun');
        Route::get('/katpetname/{katpet_id}', 'DashboardDOController@getKatpet')->name('dashboard.getKatpet');
        Route::get('/kampungname/{kg_id}', 'DashboardDOController@getKampung')->name('dashboard.getKampung');

        Route::get('/penghulumukim', 'DashboardController@penghulumukim')->name('dashboard.penghulumukim');
        Route::get('/ketuakampung', 'DashboardController@ketuakampung')->name('dashboard.ketuakampung');
        Route::get('/dataentry', 'DashboardController@dataentry')->name('dashboard.dataentry');
        Route::get('/topmanage/{type}', 'DashboardController@topmanage')->name('dashboard.topmanage');
        Route::get('/topmanage2', 'DashboardController@topmanage2')->name('dashboard.topmanage2');

        Route::get('/homeindex', 'DashboardController@homeindex')->name('dashboard.homeindex');

        Route::get('/countpetempatan', 'DashboardController@countpetempatan')->name('dashboard.countpetempatan');
        Route::get('/countdata', 'DashboardController@countdata')->name('dashboard.countdata');
        Route::get('/dun/{parlimenid}', 'DashboardController@dun')->name('dun');
        Route::get('/mukim/{daerahid}', 'DashboardController@mukim')->name('mukim');
        Route::get('/parlimenKampung/{daerahid}/{mukimid}', 'DashboardController@parlimenKampung')->name('parlimenKampung');
        Route::get('/chart1', 'DashboardController@chart1')->name('dashboard.chart1');
        Route::get('/chart2', 'DashboardController@chart2')->name('dashboard.chart2');
        Route::get('/chart3', 'DashboardController@chart3')->name('dashboard.chart3');
        Route::get('/chart4', 'DashboardController@chart4')->name('dashboard.chart4');
        Route::get('/chart5', 'DashboardController@chart5')->name('dashboard.chart5');
        Route::get('/chart5all', 'DashboardController@chart5all')->name('dashboard.chart5all');
        Route::get('/chart6', 'DashboardController@chart6')->name('dashboard.chart6');
        Route::get('/chart7', 'DashboardController@chart7')->name('dashboard.chart7');
        Route::get('/chart8', 'DashboardController@chart8')->name('dashboard.chart8');
        Route::get('/chart8all', 'DashboardController@chart8all')->name('dashboard.chart8all');
        Route::get('/showcardstat', 'DashboardController@showcardstat')->name('dashboard.showcardstat');
        Route::get('/showcardstatdo', 'DashboardController@showcardstatdo')->name('dashboard.showcardstatdo');
        Route::get('/chart10', 'DashboardController@chart10')->name('dashboard.chart10');
        Route::get('/chart12', 'DashboardController@chart12')->name('dashboard.chart12');
        Route::get('/chart15', 'DashboardController@chart15')->name('dashboard.chart15');
        Route::get('/chart16', 'DashboardController@chart16')->name('dashboard.chart16');
        Route::get('/chart19', 'DashboardController@chart19')->name('dashboard.chart19');
        Route::get('/chart20', 'DashboardController@chart20')->name('dashboard.chart20');
        Route::get('/chart23', 'DashboardController@chart23')->name('dashboard.chart23');
        Route::get('/chart24', 'DashboardController@chart24')->name('dashboard.chart24');
        Route::get('/chart21', 'DashboardController@chart21')->name('dashboard.chart21');
        Route::get('/chart18', 'DashboardController@chart18')->name('dashboard.chart18');
        Route::get('/chart25', 'DashboardController@chart25')->name('dashboard.chart25');
        Route::get('/chart26', 'DashboardController@chart26')->name('dashboard.chart26');
        Route::get('/chart27', 'DashboardController@chart27')->name('dashboard.chart27');
        Route::get('/detailallkerja', 'DashboardController@detailallkerja')->name('dashboard.detailallkerja');
        Route::get('/detailkemudahan', 'DashboardController@detailkemudahan')->name('dashboard.detailkemudahan');
        Route::get('/detailjenisrumah', 'DashboardController@detailjenisrumah')->name('dashboard.detailjenisrumah');
        Route::get('/detailstatusmilikan', 'DashboardController@detailstatusmilikan')->name('dashboard.detailstatusmilikan');
        Route::get('/detailkemudahanasas', 'DashboardController@detailkemudahanasas')->name('dashboard.detailkemudahanasas');
        Route::get('/exportdetailkerja/{filetype}/{daerahid}/{type}', 'DashboardController@exportdetailkerja')->name('exportdetailkerja');
        Route::get('/detailpendapatan', 'DashboardController@detailpendapatan')->name('dashboard.detailpendapatan');
        Route::get('/exportdetailpendapatan/{filetype}/{daerahid}/{type}', 'DashboardController@exportdetailpendapatan')->name('exportdetailpendapatan');
        Route::get('/showcarian', 'DashboardController@showcarian')->name('dashboard.showcarian');
        Route::get('/searchkampung/isirumah/ketuaisirumah/{idkampung}', 'DashboardController@ketuaisirumah')->name('ketuaisirumah');
        Route::get('/searchkampung/isirumah/viewketua/{idisirumah}/{idkampung}', 'DashboardController@viewketua')->name('viewketua');
        Route::get('/searchkampung/isirumah/ahliisirumah/{idkampung}/{rumahid}', 'DashboardController@ahliisirumah')->name('ahliisirumah');
        Route::get('/searchkampung/isirumah/viewahli/{idahli}/{idkampung}/{idrumah}', 'DashboardController@viewahli')->name('viewahli');
        Route::get('/detailallkahwin', 'DashboardController@detailallkahwin')->name('dashboard.detailallkahwin');
        Route::get('/exportdetailkahwin/{filetype}/{daerahid}/{type}', 'DashboardController@exportdetailkahwin')->name('exportdetailkahwin');
        Route::get('/exportdetailkemudahan/{filetype}/{daerahid}/{type}', 'DashboardController@exportdetailkemudahan')->name('exportdetailkemudahan');
        Route::get('/exportjenisrumah/{filetype}/{daerahid}/{type}', 'DashboardController@exportjenisrumah')->name('exportjenisrumah');
        Route::get('/exportstatusmilikan/{filetype}/{daerahid}/{type}', 'DashboardController@exportstatusmilikan')->name('exportstatusmilikan');
        Route::get('/exportdetailkemudahanasas/{filetype}/{daerahid}/{type}/{kemudahan}', 'DashboardController@exportdetailkemudahanasas')->name('exportdetailkemudahanasas');
        Route::get('/detailage', 'DashboardController@detailage')->name('dashboard.detailage');
        Route::get('/exportdetailage/{filetype}/{daerahid}/{type}', 'DashboardController@exportdetailage')->name('exportdetailage');
    }
);

Route::group(
    [
        'namespace'  => '\Workbench\Dashboard\Http\Controllers',
        'prefix'     => 'location',
        'as'         => 'location::',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/index', 'LocationController@indexGis')->name('location.indexGis');
        Route::get('/ajaxindex', 'LocationController@ajaxIndex')->name('location.ajaxIndex');
        Route::get('/admindaerah', 'DashboardController@admindaerahlocation')->name('location.admindaerahlocation');
        Route::get('/topmanage', 'DashboardController@topmanagelocation')->name('location.topmanagelocation');
    }
);
