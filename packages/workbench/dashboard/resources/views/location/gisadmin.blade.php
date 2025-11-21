<script>
    $( document ).ready(function(){
        document.title='PETA LOKASI';
    });

    const longKampung = 102.056717;
    const latKampung = 4.801320;
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
            classBreakInfos: [{
                minValue: 0.75,
                maxValue: 1.0,
                symbol: mapKampung,
            }]
        };

        const mapLayer = new MapImageLayer({
            url: "https://mygdispatial.perak.gov.my/server/rest/services/ePerak/Perak/MapServer",
            sublayers: [{
                    id: 1,
                    title: "Sekolah Rendah",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content: "<table>" +
                            "<tr> " +
                            "<td>Nama</td> " +
                            "<td>: </td> " +
                            "<td>{NAM}</td> " +
                            "</tr> " +
                            "<tr> " +
                            "<td>Agensi</td> " +
                            "<td>: </td> " +
                            "<td>{AGENSI}</td> " +
                            "</tr> " +
                            "</table>"
                    },
                },
                {
                    id: 2,
                    title: "Sekolah Menengah",
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
                                    "<td>Agensi</td> " +
                                    "<td>: </td> " +
                                    "<td>{AGENSI}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 6,
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
                    id: 10,
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
                    id: 11,
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
                    id: 13,
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
                    id: 15,
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
                    id: 16,
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
                    id: 17,
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
                    id: 18,
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
                    id: 19,
                    title: "Kemudahan Pos",
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
                    id: 20,
                    title: "Perpustakaan",
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
                    id: 25,
                    title: "Sempadan Mukim",
                    visible: true,
                    popupTemplate: {
                        title: "{MUKIM}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>MUKIM</td> " +
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
                    id: 26,
                    title: "Sempadan Daerah",
                    visible: true,
                    popupTemplate: {
                        title: "{DAERAH}",
                        content:    "<table>" +
                                    "<tr> " +
                                    "<td>Daerah</td> " +
                                    "<td>: </td> " +
                                    "<td>{DAERAH}</td> " +
                                    "</tr> " +
                                    "</table>"
                    },
                },
                {
                    id: 22,
                    title: "Sempadan Kampung",
                    visible: false,
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
        /*****************************************************************
         * Add the layer to a map
         *****************************************************************/

        const map = new Map({
            basemap: "imagery",
            layers: [mapLayer]
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 7,
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
                             END KEMUDAHAN AWAM
        *****************************************************************/

        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");

        mapLayer.when(() => {
            mapLayer.sublayers.map((sublayer) => {
                const id = sublayer.id;
                const visible = sublayer.visible;
                const node = document.querySelector(
                    ".sublayers-item[data-id='" + id + "']"
                );
            });
        });

        map.add(mapLayer);
    });

    function getData(feature) {
        // console.log(feature.graphic.attributes);
        var data = {!! $datagis !!};
        var html = "";

        for (let i = 0; i < data.length; i++) {
            if (data[i].IdKampungBaru == $.trim(feature.graphic.attributes.ID_KG)) {
                // console.log("sini");
                html = "<table> " +
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

        var leng_legend = $(".esri-legend__service .esri-legend__layer-table").length;

        var html_legend = "";

        for(var i = 0; i < leng_legend; i++){
            var icon = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-cell--symbols').html();
            var name = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-caption').html();
            var firsticon = '<i class="circle icon" style="color: rgb(188, 26, 183);"></i>Ketua Isi Rumah';

            if(i == 0){
                html_legend = '<div>' + firsticon + '</div>' + "," + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }else{
                html_legend = html_legend + "," + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }
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
        #divtitle1
        {
            display: block !important;
        }
    }
</style>

<div id="divaccordion" style="">
    <div>
        <h2> Peta :
            <div class="ui buttons right floated" id="divaccordion">
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

<div id="divtitle1" style="display: none;">
    <div id="getLegend" style="display: flex">

    </div>
</div>
