<?php

return [

        'Laman Utama' => [
        'order' => 1,
        'menu' => [
            '- LAMAN UTAMA' => [
                'route' => '/',
                'active' => '/',
                'icon' => 'home',
                'permissions' => [\App\Enums\Permission::MANAGE_FRONT_END],
            ],


        ],
    ],


 'Dashboard' => [
        'order' => 2,
        'menu' => [
            ' - DASHBOARD' => [
                'route' => 'home',
                'active' => 'dashboard/*',
                'icon' => 'thumbtack',
                'permissions' => [\App\Enums\Permission::MANAGE_DASHBOARD],
            ],

        ],
    ],

    'Peta Lokasi' =>
    [
        'order' => 8,
        'menu' =>
        [
            '- LOKASI' =>
            [
                'route' => 'location::location.indexGis',
                'active' => 'location/*',
                'icon' => 'map-marker',
                'permissions' => [\App\Enums\Permission::MANAGE_GIS],
            ],
        ],
    ],


    'System' => [
        'order' =>3,
        'menu' => [
            ' - PENGGUNA' => [
                'route' => 'site::users.index',
                'active' => 'site/users/*',
                'icon' => 'user-friends',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_USER],
            ],
             '- KELULUSAN PENGGUNA' => [
                'route' => 'site::users.approveindex',
                'active' => 'site/approveindex/*',
                'icon' => 'user-friends',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_USER],
            ],
            ' - KATEGORI PENGGUNA' => [
                'route' => 'site::roles.index',
                'config' => 'site/roles/*',
                'icon' => 'user-astronaut',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_ROLE],
            ],
            ' - KEBENARAN PENGGUNA' => [
                'route' => 'site::permissions.index',
                'active' => 'site/permissions/*',
                'icon' => 'shield-check',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_PERMISSION],
            ],
            ' - AUDIT LOG' => [
                'route' => 'site::auditlogindex',
                'active' => 'site/auditlog/*',
                'icon' => 'user-secret',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_USER],
            ],

        ],
    ],

     'Pengurusan Kamus Data' => [
        'order' => 4,
        'menu' => [
            '- KAMUS DATA' => [
                'route' => 'site::lookup.index',
                'active' => 'site/lookup/*',
                'icon' => 'stream',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],



            // 'Workflow' => [
            //     'route' => 'workflow::definitions.index',
            //     'active' => 'workflow/definitions/*',
            //     'icon' => 'code-branch',
            //     'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_WORKFLOW],
            // ],
        ],
    ],
       'Pengurusan Sistem' => [
        'order' => 5,
        'menu' => [
            '- PARLIMEN' => [
                'route' => 'site::parlimen.index',
                'active' => 'site/parlimen/*',
                'icon' => 'landmark',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
            ' - DUN' => [
                'route' => 'site::dun.index',
                'active' => 'site/dun/*',
                'icon' => 'university',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - DAERAH' => [
                'route' => 'site::daerah.index',
                'active' => 'site/daerah/*',
                'icon' => 'archway',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - MUKIM' => [
                'route' => 'site::mukim.index',
                'active' => 'site/mukim/*',
                'icon' => 'warehouse',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - KAMPUNG' => [
                'route' => 'site::kampung.index',
                'active' => 'site/kampung/*',
                'icon' => 'home',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - LOGO' => [
                'route' => 'site::frontendmanage.getLogoList',
                'active' => 'site/logo/*',
                'icon' => 'shapes',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - BANNER' => [
                'route' => 'site::frontendmanage.getBannerList',
                'active' => 'site/banner/*',
                'icon' => 'flag',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - NOTIS' => [
                'route' => 'site::frontendmanage.getNotisList',
                'active' => 'site/notis/*',
                'icon' => 'newspaper',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - HUBUNGI KAMI' => [
                'route' => 'site::frontendmanage.getHubungiList',
                'active' => 'site/hubungi/*',
                'icon' => 'phone',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - SOALAN LAZIM' => [
                'route' => 'site::frontendmanage.getSoalanList',
                'active' => 'site/soalan/*',
                'icon' => 'question',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
             ' - KATEGORI PRODUK' => [
                'route' => 'site::frontendmanage.getProductIconList',
                'active' => 'site/katprod/*',
                'icon' => 'tags',
                'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            ],
            //  'Menu' => [
            //     'route' => 'site::frontendmanage.getMenuList',
            //     'active' => 'site/menu/*',
            //     'icon' => 'list',
            //     'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            // ],
            //  'Page' => [
            //     'route' => 'site::frontendmanage.getPageList',
            //     'active' => 'site/page/*',
            //     'icon' => 'file',
            //     'permissions' => [\App\Enums\Permission::MANAGE_SYSTEM],
            // ],



            // 'Workflow' => [
            //     'route' => 'workflow::definitions.index',
            //     'active' => 'workflow/definitions/*',
            //     'icon' => 'code-branch',
            //     'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_WORKFLOW],
            // ],
        ],
    ],
     // 'Maklumat Kampung' => [
     //   'order' => 6,
     //   'menu' => [
     //       ' - CARIAN KAMPUNG' => [
     //           'route' => 'dataentry::searchkampung.index',
     //           'active' => 'dataentry/searchkampung/*',
     //           'icon' => 'search',
     //           'permissions' => [\App\Enums\Permission::MANAGE_DATA_ENTRY],
       //     ],


            // 'Workflow' => [
            //     'route' => 'workflow::definitions.index',
            //     'active' => 'workflow/definitions/*',
            //     'icon' => 'code-branch',
            //     'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_WORKFLOW],
            // ],
      //  ],
 //   ],

'Maklumat Kampung' => [
        'order' => 7,
        'menu' => [
            
			 ' - CARIAN KAMPUNG' => [
                'route' => 'dataentry::searchkampung.index',
                'active' => 'dataentry/searchkampung/*',
                'icon' => 'search',
                'permissions' => [\App\Enums\Permission::MANAGE_DATA_ENTRY],
            ],
			
             ' - INFO KAMPUNG' => [
               'route' => 'frontend.infoKampungKetua',
                'active' => 'frontend/infoKampungKetua/*',
               'icon' => 'tags',
                'permissions' => [\App\Enums\Permission::MANAGE_KAMPUNG],
            ],

' - KEMASKINI MAKLUMAT ASAS' => [
                'route' => 'dataentry::editKampung.menukampungEdit',
                'active' => 'dataentry/editKampung/*',
                'icon' => 'tags',
                'permissions' => [\App\Enums\Permission::MANAGE_KAMPUNG],
            ],
			' - KEMASKINI MAKLUMAT ISI RUMAH' => [
                'route' => 'dataentry::editIsiRumah.menukampungEditIsi',
                'active' => 'dataentry/editKampung/*',
                'icon' => 'tags',
                'permissions' => [\App\Enums\Permission::MANAGE_KAMPUNG],
            ],
            // 'Workflow' => [
            //     'route' => 'workflow::definitions.index',
            //     'active' => 'workflow/definitions/*',
            //     'icon' => 'code-branch',
            //     'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_WORKFLOW],
            // ],
        ],
    ],

    'Laporan' =>
    [
        'order' => 8,
        'menu' =>
        [
            ' - LAPORAN PENGGUNA TIDAK AKTIF' =>
            [
                'route' => 'reporting::reporting.getUserLoginIndex',
                'active' => 'reporting/userlogin/*',
                'icon' => 'archive',
                'permissions' => [\App\Enums\Permission::MANAGE_LAPORAN],
            ],
            '- LAPORAN STATISTIK' =>
            [
                'route' => 'reporting::reporting.getStatistic',
                'active' => 'reporting/statistic/*',
                'icon' => 'archive',
                'permissions' => [\App\Enums\Permission::MANAGE_LAPORAN],
            ],
        ],
    ],


];
