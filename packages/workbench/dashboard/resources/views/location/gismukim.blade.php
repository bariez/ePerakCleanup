<script>
    $( document ).ready(function(){
        document.title='PETA LOKASI';
    });

    const longKampung = {!! $longKampung !!};
    const latKampung = {!! $latKampung !!};
    // console.log(longKampung + "    -----   " + latKampung);

    require(["esri/Map",
        "esri/views/MapView",
        "esri/layers/MapImageLayer",
        "esri/widgets/BasemapGallery",
        "esri/widgets/LayerList",
        "esri/widgets/Legend",
        "esri/widgets/Expand",
        "esri/widgets/Search",
        "esri/Graphic",
    ], (Map, MapView, MapImageLayer, BasemapGallery, LayerList, Legend, Expand, Search, Graphic) => {

        /*****************************************************************
         * Create a MapImageLayer instance pointing to a Map Service
         * containing data about US Cities, Counties, States and Highways.
         * Define sublayers with visibility for each layer in Map Service.
         *****************************************************************/

        const mapKampung = {
            type: "simple-fill", // autocasts as new SimpleFillSymbol()
            color: "#04C2B7",
            style: "solid",
            outline: {
                width: 2,
                color: "white"
            }
        };

        const renderer = {
            type: "class-breaks", // autocasts as new ClassBreaksRenderer()
            field: "ID_KG",
            normalizationField: "ID_KG",
            classBreakInfos: [
                {
                minValue: 0.75,
                maxValue: 1.0,
                symbol: mapKampung,
                }
            ]
        };

        const urlGis = "{{ env('URL_GIS') }}";
        urlMukimGis = urlGis.replace("VARMAP","{{ $kampungdata->mukim->url_gis}}");
        // console.log(urlMukimGis);

        const mapLayer = new MapImageLayer({
            url: urlMukimGis,
            sublayers: [
                {
                    id: 1,
                    title: "Pasar",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{BA3}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 4,
                    title: "Hospital",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{ALAMAT}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 5,
                    title: "Klinik",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Mukim</td> " +
                                    "<td>: </td> " +
                                    "<td>{MUKIM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 7,
                    title: "Stesen Bas",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Mukim</td> " +
                                    "<td>: </td> " +
                                    "<td>{MUKIM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 8,
                    title: "Rumah Ibadat",
                    visible: false,
                    popupTemplate: {
                        title: "{NAMA}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAMA}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{BA3}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 9,
                    title: "Pondok Polis",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{ALAMAT}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 10,
                    title: "Balai Polis",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{BA3}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 11,
                    title: "Balai Bomba",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{ALAMAT}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 12,
                    title: "Kemudahan Pos",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM} {ALAMAT}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{BA3}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 13,
                    title: "Perpustakaan",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM} {ALAMAT}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Nama</td> " +
                                    "<td>: </td> " +
                                    "<td>{NAM}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Alamat</td> " +
                                    "<td>: </td> " +
                                    "<td>{BA3}</td> " +
                                    "</tr> " +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 14,
                    title: "Sempadan Kampung Daerah",
                    visible: true,
                    opacity: 0.5,
                    renderer: renderer,
                    popupTemplate: {
                        title: "{NAMA} {ID_KG}",
                        content: getData,
                        fieldInfos: [{
                                fieldName: "{NAMA}"
                            },
                            {
                                fieldName: "{ID_KG}"
                            },
                        ]
                    },
                },
            ]
        });

        // layer.queryFeatures(query)
        //     .then(function(response){
        //         console.log(query);
        //     });

        // highlightSymbol = new esri.symbol.SimpleFillSymbol().setColor(new dojo.Color([0,250,154]));

        /*****************************************************************
         * Add the layer to a map
         *****************************************************************/

        const map = new Map({
            basemap: "gray-vector",
            layers: [mapLayer]
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 12,
            center: [longKampung, latKampung]
        });

        const searchWidget = new Search({
            view: view
        });

        const basemapGallery = new BasemapGallery({
            view: view,
            content: document.getElementById("bg-gallery"),

        });

        const layerList = new LayerList({
            view: view,
            content: document.getElementById("layerlist"),
        });

        const legend = new Legend({
            view: view,
            content: document.getElementById("legend"),
        });

        // Create an Expand instance and set the content
        // property to the DOM node of the basemap gallery widget
        // Use an Esri icon font to represent the content inside
        // of the Expand widget

        const bgExpand = new Expand({
            view: view,
            content: basemapGallery,
            expandIconClass: "esri-icon-basemap",
            group: "bottom-right"
        });

        const bgExpand2 = new Expand({
            view: view,
            content: layerList,
            expandIconClass: "esri-icon-layers",
            group: "bottom-right"
        });

        const bgExpand3 = new Expand({
            view: view,
            content: legend,
            expandIconClass: "esri-icon-layer-list",
            group: "bottom-right"
        });

        // close the expand whenever a basemap is selected
        basemapGallery.watch("activeBasemap", () => {
            const mobileSize =
                view.heightBreakpoint === "xsmall" ||
                view.widthBreakpoint === "xsmall";

            if (mobileSize) {
                bgExpand.collapse();
            }
        });

        /*****************************************************************
                             START KETUA ISI RUMAH
        *****************************************************************/

        <?php

        $pointGraphic = "";

        foreach ($datalocation as $key => $value ){
        ?>
        // Create a symbol for drawing the point
        markerSymbol = {
            type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
            color: [188, 26, 183],
            outline: {
                // autocasts as new SimpleLineSymbol()
                color: [255, 255, 255],
                width: 0.5
            },
            size: 8
        };

        // First create a point geometry (this is the location of the Titanic)
        point = {
            type: "point", // autocasts as new Point()
            longitude: {{ $value->Longitud }},
            latitude: {{ $value->Latitud }}
        };

        // Create a graphic and add the geometry and symbol to it
        pointGraphic = new Graphic({
            geometry: point,
            symbol: markerSymbol,
            popupTemplate: {
                // autocasts as new PopupTemplate()
                title: "Ketua Isi Rumah",
                content: "<table>" +
                    "<tr> " +
                    "<td>Nama</td> " +
                    "<td>: </td> " +
                    "<td>{{ $value->Nama }}</td> " +
                    "</tr> " +
                    "</table>"
            }
        });

        view.graphics.add(pointGraphic);

        <?php
        }
        ?>

        /*****************************************************************
                             END KETUA ISI RUMAH
        *****************************************************************/

        /*****************************************************************
                             START KEMUDAHAN AWAM
        *****************************************************************/

        // <?php

        // $pointGraphic = "";

        // foreach ($kemudahandata as $key => $value ){
        //     // dd($value);
        // ?>

        // if( " data_get($value, 'KatKemudahan') }}" == '10' )
        // {
        //     // Create a symbol for drawing the point
        //     markerSymbol = {
        //         type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        //         color: [58, 26, 188],
        //         outline: {
        //             // autocasts as new SimpleLineSymbol()
        //             color: [255, 255, 255],
        //             width: 0.5
        //         },
        //         size: 8
        //     };
        // }
        // else if( " data_get($value, 'KatKemudahan') }}" == '11' )
        // {
        //     // Create a symbol for drawing the point
        //     markerSymbol = {
        //         type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        //         color: [35, 223, 61],
        //         outline: {
        //             // autocasts as new SimpleLineSymbol()
        //             color: [255, 255, 255],
        //             width: 0.5
        //         },
        //         size: 8
        //     };
        // }
        // else if( " data_get($value, 'KatKemudahan') }}" == '12' )
        // {
        //     // Create a symbol for drawing the point
        //     markerSymbol = {
        //         type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        //         color: [35, 223, 221],
        //         outline: {
        //             // autocasts as new SimpleLineSymbol()
        //             color: [255, 255, 255],
        //             width: 0.5
        //         },
        //         size: 8
        //     };
        // }
        // else if( " data_get($value, 'KatKemudahan') }}" == '13' )
        // {
        //     // Create a symbol for drawing the point
        //     markerSymbol = {
        //         type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        //         color: [223, 35, 66],
        //         outline: {
        //             // autocasts as new SimpleLineSymbol()
        //             color: [255, 255, 255],
        //             width: 0.5
        //         },
        //         size: 8
        //     };
        // }
        // else if( " data_get($value, 'KatKemudahan') }}" == '14' )
        // {
        //     // Create a symbol for drawing the point
        //     markerSymbol = {
        //         type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        //         color: [223, 186, 35 ],
        //         outline: {
        //             // autocasts as new SimpleLineSymbol()
        //             color: [255, 255, 255],
        //             width: 0.5
        //         },
        //         size: 8
        //     };
        // }

        // // First create a point geometry (this is the location of the Titanic)
        // point = {
        //     type: "point", // autocasts as new Point()
        //     longitude:  $value->Longitud }},
        //     latitude:  $value->Latitud }}
        // };

        // // Create a graphic and add the geometry and symbol to it
        // pointGraphic = new Graphic({
        //     geometry: point,
        //     symbol: markerSymbol,
        //     popupTemplate: {
        //         // autocasts as new PopupTemplate()
        //         title: "$value->Description}}",
        //         content: "<table>" +
        //             "<tr> " +
        //             "<td>Nama</td> " +
        //             "<td>: </td> " +
        //             "<td> $value->NamaKemudahan }}</td> " +
        //             "</tr> " +
        //             "<tr> " +
        //             "<td>Mukim</td> " +
        //             "<td>: </td> " +
        //             "<td> $value->NamaMukim }}</td> " +
        //             "</tr> " +
        //             "<tr> " +
        //             "<td>Daerah</td> " +
        //             "<td>: </td> " +
        //             "<td> $value->NamaDaerah }}</td> " +
        //             "</tr> " +
        //             "</table>"
        //     }
        // });

        // view.graphics.add(pointGraphic);

        // <?php
        // }
        // ?>

        /*****************************************************************
                             END KEMUDAHAN AWAM
        *****************************************************************/

        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");

    });

    function getData(feature) {
    // console.log(feature.graphic.attributes);
        var data = {!! $datagis !!};
        var html = "";

        for (let i = 0; i < data.length; i++) {
            if (data[i].IdKampungBaru == $.trim(feature.graphic.attributes.ID_KG)) {
                // console.log("sini");
                html =  "<table> " +
                        "<tr> " +
                        "<td>Mukim</td> " +
                        "<td>: </td> " +
                        "<td>" + data[i].mukim.NamaMukim + "</td> " +
                        "</tr> " +
                        "<tr> " +
                        "<td>Daerah</td> " +
                        "<td>: </td> " +
                        "<td>" + data[i].daerah.NamaDaerah + "</td> " +
                        "</tr> " +
                        "<tr> " +
                        "<td>Jumlah KIR</td> " +
                        "<td>: </td> " +
                        "<td>" + data[i].kircount + "</td> " +
                        "</tr> " +
                        "</table>";
            }

        }

        return html;
    }

    function divtitle() {
        console.log("sini meeyyyy");
        var leng_legend = $(".esri-legend__service .esri-legend__layer-table").length;
        console.log(leng_legend);

        var html_legend = "";

        for(var i = 0; i < leng_legend; i++){
            var icon = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-cell--symbols').html();
            var name = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-caption').html();
            var firsticon = '<i class="circle icon" style="color: rgb(188, 26, 183);"></i>Ketua Isi Rumah';


            console.log("\n");
            console.log(icon);
            console.log("\n");
            console.log(name);
            console.log("\n");

            if(i == 0){
                html_legend = '<div>' + firsticon + '</div>' + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }else{
                html_legend = html_legend + "," + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }
            console.log(html_legend);
        }

        $("#getLegend").html(html_legend);

        window.print();

    }



</script>

<style>
    html,
    body,
    #viewDiv {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
    }

    @media print
    {
        #divtitle
        {
            display: block !important;
        }
    }

</style>

<div class="divaccordion" style="">
    <div>
        <h2> Peta :
            <div class="ui buttons right floated" id="divaccordion2">
                <a href="javascript:;"  class="ui red button" onclick="divtitle()" title="PDF">&nbsp;Cetak&nbsp;</a>
            </div>
        </h2>
    </div>

    <br/>

    <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0" style="padding: 6px 6px; float: right;">
        <i class="info circle icon" style="font-size: 24px;"></i>
        <i class="dropdown icon m-l-0 {{ config('laravolt.ui.color') }}"></i>
        <div class="menu">
            <div class="divider"></div>
            <div class="p-1">
                <i class="circle icon" style="color: rgb(188, 26, 183);"></i>
                <b>Ketua Isi Rumah </b>
            </div>
        </div>
    </div>

    <br/><br/>

</div>

<div id="map" class="claro" style="width:100%; height:500px; border:1px solid #000;">
    <div id="viewDiv"></div>
</div>

<br><br>

<div id="divtitle" style="display: none;">
    <div id="getLegend" style="display: flex">

    </div>
</div>
