<script>
    const longKampung = {!! $longKampung !!};
    const latKampung = {!! $latKampung !!};
    // console.log(longKampung + "    -----   " + latKampung);

    /*  require(["esri/Map",
          "esri/views/MapView",
          "esri/layers/MapImageLayer",
          "esri/widgets/Legend",
          "esri/widgets/Expand",
          "esri/widgets/BasemapGallery",
          "esri/widgets/LayerList",
          "esri/widgets/Search",
          "esri/Graphic"
      ], (Map, MapView, MapImageLayer, Legend, Expand, BasemapGallery, LayerList, Search, Graphic) => {*/
    require(["esri/Map", "esri/views/MapView", "esri/layers/FeatureLayer",
        "esri/widgets/BasemapGallery",
        "esri/widgets/LayerList",
        "esri/Graphic",
        "esri/widgets/Legend",
        "esri/widgets/Expand", "esri/widgets/Search"
    ], function(Map, MapView, FeatureLayer, BasemapGallery, LayerList, Graphic, Legend, Expand, Search) {

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

        const featureLayer = new FeatureLayer({
            url: "{{ config('services.arcgis.wfs_endpoint') }}",
            outFields: ["*"],
            definitionExpression: "UPPER(ID_KG)=UPPER('{{ trim($kampungdata->IdKampungBaru) }}')",
        });

        /*****************************************************************
         * Add the layer to a map
         *****************************************************************/

        const map = new Map({
            basemap: "gray-vector",
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 13,
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
        }); /* */

        /*****************************************************************
                             START KETUA ISI RUMAH
        *****************************************************************/
        const kirGraphics = [];
        <?php

        $pointGraphic = "";

        foreach ($kirkampung as $key => $value ){
        ?>
        // Create a symbol for drawing the point
        let markerSymbol = {
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
        let point = {
            type: "point", // autocasts as new Point()
            longitude: {{ $value->Longitud }},
            latitude: {{ $value->Latitud }}
        };

        // Create a graphic and add the geometry and symbol to it
        let pointGraphic = new Graphic({
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
        kirGraphics.push(pointGraphic);
        <?php
        }
        ?>

        /*****************************************************************
                             END KETUA ISI RUMAH
        *****************************************************************/

        // Add the expand instance to the ui
        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-left");

        map.add(featureLayer);

        function getData(feature) {
            // console.log(feature.graphic.attributes);
            var data = {!! $datagis !!};
            var html = "";

            for (let i = 0; i < data.length; i++) {
                if (data[i].IdKampung == $.trim(feature.graphic.attributes.ID_KG)) {
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
    });
</script>


<div class="sidebar-list-job">
    <div class="section-box wow animate__animated animate__fadeIn mt-10">
        <div class="container">
            <div>
                <h4> Peta : </h4>
            </div>
            <br />

            <div class="dropdown dropstart" style="float: right;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                    data-bs-toggle="dropdown" aria-expanded="false" style="padding: 10px;">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </svg>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li style="padding: 10px; white-space: nowrap;">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-circle-fill"
                            viewBox="0 0 16 16" style="color: rgb(188, 26, 183)">
                            <circle cx="8" cy="8" r="8" />
                        </svg>
                        <b style="margin-left: 5px;margin-right: 5px;font-weight: bolder;font-size: smaller;"> Ketua Isi
                            Rumah </b>
                    </li>
                </ul>
            </div>

            <br />
            <br />

            <!--div id="map" class="claro" style="width:100%; height:600px; border:1px solid #000;"> -->
             <div id="viewDiv" class="claro" style="width:100%; height:600px; border:1px solid #000;">   
                <!--div id="viewDiv"></div>-->
            </div>
        </div>
    </div>
</div>
