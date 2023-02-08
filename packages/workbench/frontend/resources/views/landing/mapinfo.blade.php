<script>
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
                    visible: false,
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
            basemap: "satellite",
            layers: [mapLayer]
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 8,
            center: [101.027036, 4.723397]
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
</style>

<div id="map" class="claro" style="width:100%; height:600px; border:1px solid #000;">
    <div id="viewDiv"></div>
</div>
