<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace'  => '\Workbench\Frontend\Http\Controllers',
        'prefix'     => '',
        'middleware' => ['web'],
    ],


    function () {

        // design ---------------------
        Route::get('/demo/{no}', 'FrontendController@getDemo')->name('frontend.getDemo');
        // end design -----------------

        //return view('main');
        Route::get('/news', 'FrontendController@getNewsList')->name('frontend.getNewsList');
        Route::post('/news/search', 'FrontendController@postNewsFilter')->name('frontend.postNewsFilter');
        Route::get('/news/searchresult', 'FrontendController@getNewsFilterList')->name('frontend.getNewsFilterList'); // /{page}
        Route::get('/news/{id}', 'FrontendController@getNewsDetail')->name('frontend.getNewsDetail');

        Route::get('/activity', 'FrontendController@getActivityList')->name('frontend.getActivityList');
        Route::post('/activity/search', 'FrontendController@postActivityFilter')->name('frontend.postActivityFilter');
        Route::get('/activity/searchresult', 'FrontendController@getActivityFilterList')->name('frontend.getActivityFilterList'); // /{page}
        Route::get('/activity/{id}', 'FrontendController@getActivityDetail')->name('frontend.getActivityDetail');

        Route::get('/product', 'FrontendController@getProductList')->name('frontend.getProductList');
        Route::post('/product/search', 'FrontendController@postProductSearch')->name('frontend.postProductSearch');
        Route::get('/product/{idtype}/searchresult', 'FrontendController@getProductFilterList')->name('frontend.getProductFilterList'); // /{page}
        Route::get('/product/{idtype}', 'FrontendController@getProductDetail')->name('frontend.getProductDetail');
        Route::get('/product/ajax/{idtype}', 'FrontendController@getProductDetailList')->name('frontend.getProductDetailList');
        Route::get('/faq', 'FrontendController@getFaqList')->name('frontend.getFaqList');
        Route::get('/contactus', 'FrontendController@getContactUsList')->name('frontend.getContactUsList');
        Route::get('/page/{pageid}', 'FrontendController@getPageDetail')->name('frontend.getPageDetail');
        // Route::get('/homepage', 'FrontendController@index')->name('frontend.index');

        Route::get('/info', 'FrontendController@getInfoPenempatan')->name('frontend.getInfoPenempatan');
        Route::get('/info/{idkampung}', 'FrontendController@getInfoDetail')->name('frontend.getInfoDetail');
        //add 23/02/2024 /////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/infoKampungKetua', 'FrontendController@infoKampungKetua')->name('frontend.infoKampungKetua');
        Route::get('/info/ajax/parlimen/daerah/{iddaerah}', 'FrontendController@getAjaxParlimenDaerah')->name('frontend.getAjaxParlimenDaerah');
        Route::get('/info/ajax/parlimen/mukim/{idmukim}', 'FrontendController@getAjaxParlimenMukim')->name('frontend.getAjaxParlimenMukim');

        Route::get('/info/ajax/mukim/{iddaerah}', 'FrontendController@getAjaxMukim')->name('frontend.getAjaxMukim');
        Route::get('/info/ajax/dun/{idparlimen}', 'FrontendController@getAjaxDun')->name('frontend.getAjaxDun');
        Route::get('/info/ajax/kampung/{idparlimen}/{iddun}/{iddaerah}/{idmukim}/{idcat}/{idkampung}', 'FrontendController@getAjaxKampung')->name('frontend.getAjaxKampung');
        Route::get('/info/ajax/result/{idparlimen}/{iddun}/{iddaerah}/{idmukim}/{idcat}/{idkampung}', 'FrontendController@getAjaxResult')->name('frontend.getAjaxResult');

        // section 1 mapgis
        Route::get('/info/ajax/detail/map/{idkampung}', 'FrontendController@getAjaxMap')->name('frontend.getAjaxMap');
       
        // section 2
        // accordion 1 sejarah  ------------------

        // accordion 2 aktiviti ------------------
        Route::get('/info/{idkampung}/listaktiviti', 'FrontendController@getInfoDetailListAktiviti')->name('frontend.getInfoDetailListAktiviti');

        Route::get('/info/ajax/detail/aktiviti/{idkampung}', 'FrontendController@getAjaxActivity')->name('frontend.getAjaxActivity');
        Route::get('/info/ajax/detail/aktiviti/modal/{idaktiviti}', 'FrontendController@getAjaxActivityModal')->name('frontend.getAjaxActivityModal');
        Route::get('/info/ajax/detail/aktiviti/modalimage/{idaktiviti}', 'FrontendController@getAjaxActivityModalImage')->name('frontend.getAjaxActivityModalImage');

        // accordion 3 pencapaian ------------------
        Route::get('/info/ajax/detail/pencapaian/{idkampung}', 'FrontendController@getAjaxPencapaian')->name('frontend.getAjaxPencapaian');

        // accordion 4 infra ------------------
        Route::get('/info/ajax/detail/infra/{idkampung}', 'FrontendController@getAjaxInfra')->name('frontend.getAjaxInfra');

        Route::get('/info/ajax/detail/infra/modal/{idkampung}/{idinfra}', 'FrontendController@getAjaxInfraList')->name('frontend.getAjaxInfraList');

        // accordion 5 produk ------------------
        Route::get('/info/ajax/detail/produk/{idkampung}', 'FrontendController@getAjaxProduk')->name('frontend.getAjaxProduk');
        Route::get('/info/ajax/detail/produk/modal/{idkampung}/{idprodukkat}', 'FrontendController@getAjaxProdukList')->name('frontend.getAjaxProdukList');

        // accordion 6 projek ------------------
        Route::get('/info/ajax/detail/projek/{idkampung}', 'FrontendController@getAjaxProjek')->name('frontend.getAjaxProjek');
        Route::get('/info/ajax/detail/projek/modal/{idkampung}/{idprojek}', 'FrontendController@getAjaxProjekList')->name('frontend.getAjaxProjekList');
        Route::get('/info/ajax/detail/projek/modalimage/{idprojek}', 'FrontendController@getAjaxProjekModalImage')->name('frontend.getAjaxProjekModalImage');

        // accordion 7 galeri ------------------
        Route::get('/info/ajax/detail/galeri/{idkampung}', 'FrontendController@getAjaxGaleri')->name('frontend.getAjaxGaleri');
        Route::get('/info/ajax/detail/galeri/modal/{idgaleri}', 'FrontendController@getAjaxGaleriModal')->name('frontend.getAjaxGaleriModal');

        Route::post('/search', 'FrontendController@postSearch')->name('frontend.postSearch');

        // map depan
        Route::get('/ajax/mapinfo', 'FrontendController@getAjaxMapinfo')->name('frontend.getAjaxMapinfo');
    }
);

// management
Route::group(
    [
        'namespace'  => '\Workbench\Frontend\Http\Controllers',
        'prefix'     => 'site',
        'as'         => 'site::',
        'middleware' => ['web', 'auth'],
    ],

    function () {
        Route::get('/logo/index', 'FrontendManagementController@getLogoList')->name('frontendmanage.getLogoList');
        Route::get('/logo/addlogo', 'FrontendManagementController@getLogoAdd')->name('frontendmanage.getLogoAdd');
        Route::post('/logo/savelogo', 'FrontendManagementController@postLogoSaveAdd')->name('frontendmanage.postLogoSaveAdd');
        Route::get('/logo/editlogo/{logo_id}', 'FrontendManagementController@getLogoEdit')->name('frontendmanage.getLogoEdit');
        Route::post('/logo/saveeditlogo', 'FrontendManagementController@postLogoSaveEdit')->name('frontendmanage.postLogoSaveEdit');
        Route::get('/logo/deletelogo/{logo_id}', 'FrontendManagementController@getDeleteLogo')->name('getDeleteLogo');

        Route::get('/banner/index', 'FrontendManagementController@getBannerList')->name('frontendmanage.getBannerList');
        Route::get('/banner/add', 'FrontendManagementController@getBannerAdd')->name('frontendmanage.getBannerAdd');
        Route::post('/banner/save', 'FrontendManagementController@postBannerSaveAdd')->name('frontendmanage.postBannerSaveAdd');
        Route::get('/banner/edit/{banner_id}', 'FrontendManagementController@getBannerEdit')->name('frontendmanage.getBannerEdit');
        Route::post('/banner/saveedit', 'FrontendManagementController@postBannerSaveEdit')->name('frontendmanage.postBannerSaveEdit');
        Route::get('/banner/deletebanner/{banner_id}', 'FrontendManagementController@getDeleteBanner')->name('getDeleteBanner');

        Route::get('/notis/index', 'FrontendManagementController@getNotisList')->name('frontendmanage.getNotisList');
        Route::get('/notis/add', 'FrontendManagementController@getNotisAdd')->name('frontendmanage.getNotisAdd');
        Route::post('/notis/save', 'FrontendManagementController@postNotisSaveAdd')->name('frontendmanage.postNotisSaveAdd');
        Route::get('/notis/edit/{notis_id}', 'FrontendManagementController@getNotisEdit')->name('frontendmanage.getNotisEdit');
        Route::post('/notis/saveedit', 'FrontendManagementController@postNotisSaveEdit')->name('frontendmanage.postNotisSaveEdit');

        Route::get('/hubungi/index', 'FrontendManagementController@getHubungiList')->name('frontendmanage.getHubungiList');
        Route::get('/hubungi/add', 'FrontendManagementController@getHubungiAdd')->name('frontendmanage.getHubungiAdd');
        Route::post('/hubungi/save', 'FrontendManagementController@postHubungiSaveAdd')->name('frontendmanage.postHubungiSaveAdd');
        Route::get('/hubungi/edit/{hubungi_id}', 'FrontendManagementController@getHubungiEdit')->name('frontendmanage.getHubungiEdit');
        Route::post('/hubungi/saveedit', 'FrontendManagementController@postHubungiSaveEdit')->name('frontendmanage.postHubungiSaveEdit');

        Route::get('/soalan/index', 'FrontendManagementController@getSoalanList')->name('frontendmanage.getSoalanList');
        Route::get('/soalan/add', 'FrontendManagementController@getSoalanAdd')->name('frontendmanage.getSoalanAdd');
        Route::post('/soalan/save', 'FrontendManagementController@postSoalanSaveAdd')->name('frontendmanage.postSoalanSaveAdd');
        Route::get('/soalan/edit/{soalan_id}', 'FrontendManagementController@getSoalanEdit')->name('frontendmanage.getSoalanEdit');
        Route::post('/soalan/saveedit', 'FrontendManagementController@postSoalanSaveEdit')->name('frontendmanage.postSoalanSaveEdit');

        Route::get('/katprod/index', 'FrontendManagementController@getProductIconList')->name('frontendmanage.getProductIconList');
        Route::get('/katprod/add', 'FrontendManagementController@getProductIconAdd')->name('frontendmanage.getProductIconAdd');
        Route::post('/katprod/save', 'FrontendManagementController@postProductIconSaveAdd')->name('frontendmanage.postProductIconSaveAdd');
        Route::get('/katprod/edit/{katprod_id}', 'FrontendManagementController@getProductIconEdit')->name('frontendmanage.getProductIconEdit');
        Route::post('/katprod/saveedit', 'FrontendManagementController@postProductIconSaveEdit')->name('frontendmanage.postProductIconSaveEdit');

        Route::get('/menu/index', 'FrontendManagementController@getMenuList')->name('frontendmanage.getMenuList');
        Route::get('/menu/add', 'FrontendManagementController@getMenuAdd')->name('frontendmanage.getMenuAdd');
        Route::post('/menu/save', 'FrontendManagementController@postMenuSaveAdd')->name('frontendmanage.postMenuSaveAdd');
        Route::get('/menu/edit/{menu_id}', 'FrontendManagementController@getMenuEdit')->name('frontendmanage.getMenuEdit');
        Route::post('/menu/saveedit', 'FrontendManagementController@postMenuSaveEdit')->name('frontendmanage.postMenuSaveEdit');

        Route::get('/page/index', 'FrontendManagementController@getPageList')->name('frontendmanage.getPageList');
        Route::get('/page/add', 'FrontendManagementController@getPageAdd')->name('frontendmanage.getPageAdd');
        Route::post('/page/save', 'FrontendManagementController@postPageSaveAdd')->name('frontendmanage.postPageSaveAdd');
        Route::get('/page/edit/{page_id}', 'FrontendManagementController@getPageEdit')->name('frontendmanage.getPageEdit');
        Route::post('/page/saveedit', 'FrontendManagementController@postPageSaveEdit')->name('frontendmanage.postPageSaveEdit');
    });