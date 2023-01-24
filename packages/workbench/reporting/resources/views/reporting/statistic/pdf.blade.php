<!DOCTYPE html>
<html>
    <head>

        <style type="text/css">
            td.sirim
            {
                padding: 0px 0px 0px 0px; /* atas kanan bawah kiri */
                margin : 0px 0px 0px 0px; /* atas kanan bawah kiri */

            }
            .border
            {
                border: 1px solid black;
                border-collapse: collapse;
                margin-left: auto;
                margin-right: auto;
            }
            .borderkanan
            {
                border-right: 1px solid black;
                padding: 2px;
                border-collapse: collapse;
            }
            .ringgit
            {
                text-align: right;
                padding: 2px;
            }
            .diva4
            {
                height:267mm;
            }
        </style>
        <meta charset="UTF-8">
    </head>
    <body>

        <center>
            <b>Laporan Statistik Penduduk</b>
        </center>
        
        <br>

        <table style="width: 50%; font-size: 10px; " class="border">
            <tbody>
                <tr>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Daerah</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->daerah }}
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Mukim</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->mukim }}
                    </td>
                </tr>
                <tr>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Parlimen</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->parlimen }}
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Dun</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->dun }}
                    </td>
                </tr>
                <tr>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Kategori Petempatan</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->catpetempatan }}
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        <b>Nama Kampung</b>
                    </td>
                    <td class="border" style="text-align: center; width: 50%; padding: 2px" valign="top">
                        {{ $request->kampung }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="ui two stackable cards">
            <div class="card">
                <div class="content" style="text-align: center; background-color: #00439e;">
                    <div class="ui statistic">
                        <div class="label" style="font-size: 20px;color:white">
                            JUMLAH PETEMPATAN
                        </div>
                        <br>
                        <div class="value" style="color:white">
                            <i class="home icon"></i>&nbsp;{{data_get($result,'jum_petempatan')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="content" style="text-align: center; background-color: #00439e;">
                    <div class="ui statistic">
                        <div class="label" style="font-size: 20px;color:white">
                            @if($resultall==null)
                                {{ data_get($category,'description') }}
                            @else
                                {{ data_get($resultall,'category') }}
                            @endif
                        </div>
                        <br>
                        <div class="value" style="color:white">
                            @if($resultall==null)
                                <i class="map pin icon"></i>&nbsp;0
                            @else
                                <i class="map pin icon"></i>&nbsp;{{data_get($resultall,'countpetempatan')}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content p-3 raised" id="printhere">

            <div class="ui container-fluid content__body p-3" id="result3" style="display: none">
                <div class="ui segments panel">
                    <div class="ui segment p-3" id="resultcountpetempatan">
                      
                    </div>
                </div>
            </div>

            <div class="ui container-fluid content__body p-3" id="result4">
                <div class="ui two stackable cards raised">
                    <div class="card ">
                        <div class="ui active loader" id="loader1"></div>
                        <div class="content" id="resultchart1" style="display: none">
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="ui active loader" id="loader2"></div>
                        <div class="content" id="resultchart2" style="display: none">
                          
                        </div>
                    </div>
                </div>

                <div class="ui two stackable cards raised">
                    <div class="card">
                        <div class="ui active loader" id="loader3"></div>
                        <div class="content" id="resultchart3" style="display: none">
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="ui active loader" id="loader4"></div>
                        <div class="content" id="resultchart4" style="display: none">
                          
                        </div>
                    </div>
                </div>

                <div class="ui two stackable cards raised">
                    <div class="card">
                        <div class="ui active loader" id="loader5"></div>
                        <div class="content" id="resultchart5" style="display: none">
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="ui active loader" id="loader6"></div>
                        <div class="content" id="resultchart6" style="display: none">
                          
                        </div>
                    </div>
                </div>

                <div class="ui two stackable cards raised">
                    <div class="card">
                        <div class="ui active loader" id="loader7"></div>
                        <div class="content" id="resultchart7" style="display: none">
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="ui active loader" id="loader8"></div>
                        <div class="content" id="resultchart8" style="display: none">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>