<script>
    $(document).ready(function() {
        document.title = 'PETA LOKASI';
    });

    const longKampung = 102.056717;
    const latKampung = 4.801320;

    require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/MapImageLayer",
        "esri/widgets/BasemapGallery",
        "esri/widgets/LayerList",
        "esri/widgets/Legend",
        "esri/widgets/Expand",
        "esri/widgets/Search",
        "esri/Graphic",
    ], (Map, MapView, MapImageLayer, BasemapGallery, LayerList, Legend, Expand, Search, Graphic) => {

        // -----------------------------------------------------------
        // 1. CONFIGURATION: SYMBOLS & RENDERERS
        // -----------------------------------------------------------

        // Renderer untuk Sempadan Kampung (Highlight ID_KG tertentu)
        const mapKampung = {
            type: "simple-fill",
            color: "#04C2B7", // Warna Turquoise
            style: "solid",
            outline: {
                width: 2,
                color: "white"
            }
        };

        const rendererKampung = {
            type: "class-breaks",
            field: "ID_KG",
            normalizationField: "ID_KG",
            classBreakInfos: [{
                minValue: 0.75,
                maxValue: 1.0,
                symbol: mapKampung,
            }]
        };

        // Template Popup Standard (Digunakan untuk layer kemudahan)
        const commonPopupTemplate = {
            title: "{NAM}", // Pastikan field 'NAM' wujud dalam layer, jika tidak tukar ke 'NAMA'
            content: "<table>" +
                "<tr><td>Nama</td><td>: </td><td>{NAM}</td></tr>" +
                "<tr><td>Alamat</td><td>: </td><td>{ALAMAT}</td></tr>" + // Tukar field jika perlu (cth: BA3)
                "<tr><td>Daerah</td><td>: </td><td>{DAERAH}</td></tr>" +
                "</table>"
        };

        // -----------------------------------------------------------
        // 2. MAP IMAGE LAYER CONFIGURATION (THE NEW LAYERS)
        // -----------------------------------------------------------

        const mapLayer = new MapImageLayer({
            url: "https://mygdispatial.perak.gov.my/server/rest/services/ePerak/Perak/MapServer",
            sublayers: [
                // --- LAYER KEMUDAHAN (POINT) - Diletakkan di atas supaya boleh diklik ---
                {
                    id: 0,
                    title: "Kemudahan Pendidikan",
                    visible: false, // Default tutup supaya peta tak serabut
                    popupTemplate: commonPopupTemplate
                },
                {
                    id: 5,
                    title: "Kemudahan Perniagaan",
                    visible: false,
                    popupTemplate: commonPopupTemplate
                },
                {
                    id: 9,
                    title: "Kemudahan Kesihatan",
                    visible: false,
                    popupTemplate: commonPopupTemplate
                },
                {
                    id: 12,
                    title: "Kemudahan Masyarakat",
                    visible: false,
                    popupTemplate: commonPopupTemplate
                },

                // --- LAYER SEMPADAN (POLYGON) ---
                
                // Layer 22: Sempadan Kampung (Paling Penting - dengan Renderer)
                {
                    id: 22,
                    title: "Sempadan Kampung",
                    visible: true,
                    definitionExpression: "{!! $whereKampung !!}", // Filter PHP
                    renderer: rendererKampung,
                    opacity: 0.8
                },

                // Layer 25: Sempadan Mukim
                {
                    id: 25,
                    title: "Sempadan Mukim",
                    visible: true,
                    definitionExpression: "{!! $whereMukim !!}", // Filter PHP
                    opacity: 0.6
                },

                // Layer 24: Sempadan DUN
                {
                    id: 24,
                    title: "Sempadan Pilihanraya (DUN)",
                    visible: false, // Default tutup
                    opacity: 0.5
                },

                // Layer 23: Sempadan Parlimen
                {
                    id: 23,
                    title: "Sempadan Pilihanraya (Parlimen)",
                    visible: false, // Default tutup
                    opacity: 0.5
                },

                // Layer 26: Sempadan Daerah
                {
                    id: 26,
                    title: "Sempadan Daerah",
                    visible: true,
                    definitionExpression: "{!! $whereDaerah !!}", // Filter PHP
                    opacity: 0.5
                },

                // Layer 27: Sempadan Negeri (Base paling bawah)
                {
                    id: 27,
                    title: "Sempadan Negeri",
                    visible: true,
                    opacity: 0.4
                }
            ]
        });

        // -----------------------------------------------------------
        // 3. MAP VIEW SETUP
        // -----------------------------------------------------------

        const map = new Map({
            basemap: "imagery",
            layers: [mapLayer]
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 13, // Zoom level disesuaikan sedikit untuk pandangan kampung
            center: [longKampung, latKampung]
        });

        // -----------------------------------------------------------
        // 4. WIDGETS
        // -----------------------------------------------------------

        const searchWidget = new Search({ view: view });
        const basemapGallery = new BasemapGallery({ 
            view: view, 
            content: document.getElementById("bg-gallery") 
        });
        const layerList = new LayerList({ 
            view: view, 
            content: document.getElementById("layerlist") 
        });
        const legend = new Legend({ 
            view: view, 
            content: document.getElementById("legend") 
        });

        // Expand Widgets
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

        // Responsive Expand Logic
        basemapGallery.watch("activeBasemap", () => {
            const mobileSize = view.heightBreakpoint === "xsmall" || view.widthBreakpoint === "xsmall";
            if (mobileSize) {
                bgExpand.collapse();
            }
        });

        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");


       // -----------------------------------------------------------
        // 5. KETUA ISI RUMAH (CODE YANG TELAH DIBETULKAN)
        // -----------------------------------------------------------
        
        // 1. Definisikan Style Marker SEKALI SAHAJA di luar loop
        //    (Supaya tidak berlaku error "already declared")
        const markerSymbol = {
            type: "simple-marker",
            color: [188, 26, 183], // Ungu
            outline: {
                color: [255, 255, 255],
                width: 0.5
            },
            size: 8
        };

        <?php
        foreach ($datalocation as $key => $value ){
        ?>
            // 2. Di dalam loop, kita terus tambah Graphic tanpa create variable 'const' baru
            //    Ini lebih selamat dan menjimatkan memory browser.
            
            view.graphics.add(new Graphic({
                geometry: {
                    type: "point",
                    // Guna '?? 0' untuk elak error jika tiada koordinat
                    longitude: {{ $value->Longitud ?? 0 }}, 
                    latitude: {{ $value->Latitud ?? 0 }}
                },
                symbol: markerSymbol, // Kita guna variable yang dah define di atas tadi
                popupTemplate: {
                    title: "Ketua Isi Rumah",
                    content: "<table>" +
                        "<tr><td>Nama</td><td>: </td><td>{{ $value->Nama }}</td></tr>" +
                        "</table>"
                }
            }));

        <?php
        }
        ?>

        // -----------------------------------------------------------
        // 6. LAYER LOADING LOGIC
        // -----------------------------------------------------------
        mapLayer.when(() => {
            // Logic tambahan jika perlu akses sublayers selepas load
        });

        map.add(mapLayer);
    });

    // -----------------------------------------------------------
    // 7. HELPER FUNCTIONS (PRINT & DATA)
    // -----------------------------------------------------------

    function getData(feature) {
        var data = {!! $datagis !!};
        var html = "";
        // Pastikan ID_KG dipadankan dengan atribut data GIS anda
        for (let i = 0; i < data.length; i++) {
            if (data[i].IdKampungBaru == $.trim(feature.graphic.attributes.ID_KG)) {
                html = "<table> " +
                    "<tr><td>Mukim</td><td>: </td><td>" + data[i].mukim.NamaMukim + "</td></tr>" +
                    "<tr><td>Daerah</td><td>: </td><td>" + data[i].daerah.NamaDaerah + "</td></tr>" +
                    "<tr><td>Jumlah KIR</td><td>: </td><td>" + data[i].kircount + "</td></tr>" +
                    "</table>";
            }
        }
        return html;
    }

    function divtitle() {
        // Logic untuk mengambil Lagenda dari widget Esri dan memasukkannya ke dalam div print
        var leng_legend = $(".esri-legend__service .esri-legend__layer-table").length;
        var html_legend = "";

        // Header Legend (Ketua Isi Rumah Manual)
        var firsticon = '<div style="display:flex; align-items:center; margin-right:15px;"><i class="circle icon" style="color: rgb(188, 26, 183); margin-right:5px;"></i>Ketua Isi Rumah</div>';
        
        html_legend = firsticon;

        for(var i = 0; i < leng_legend; i++){
            // Mencari elemen simbol dan caption dalam DOM widget legend
            var row = $(".esri-legend__service .esri-legend__layer-table").eq(i);
            var icon = row.find('.esri-legend__layer-cell--symbols').html();
            var name = row.find('.esri-legend__layer-caption').html();

            if(icon && name) {
                html_legend += '<div style="display:flex; align-items:center; margin-right:15px; margin-left:10px;">' + 
                               '<div>' + icon + '</div>' + 
                               '<div style="margin-left:5px;">' + name + '</div>' +
                               '</div>';
            }
        }

        $("#getLegend").html(html_legend);
        window.print();
    }
</script>

<style>
    html, body, #viewDiv {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
    }

    /* CSS KHAS UNTUK PAPARAN CETAKAN SAHAJA */
    @media print {
        @page {
            size: A4 landscape; /* Cetak Melintang */
            margin: 0.5cm;      /* Margin nipis supaya muat */
        }

        /* 1. Sembunyikan SEMUA elemen asal portal */
        body > * {
            display: none !important;
        }

        /* 2. Paparkan Container Print Sahaja */
        #print-container {
            display: block !important;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
        }

        /* 3. Format Kotak Peta & Lagenda */
        .print-header {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
        }

        .map-box {
            border: 2px solid #000; /* Bingkai Hitam Tebal */
            width: 100%;
            height: auto; /* Ikut saiz gambar */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .legend-box {
            border: 1px solid #000;
            padding: 10px;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 11px;
            display: flex;
            flex-wrap: wrap; /* Supaya boleh jadi column */
        }

        /* Susun Lagenda dalam 3 Column (Gaya JUPEM) */
        .legend-item {
            width: 33%; /* Bahagi 3 */
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        /* Pastikan warna dicetak */
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Sembunyikan print container pada skrin biasa */
    #print-container {
        display: none;
    }
</style>

<div id="divaccordion">
    <div>
        <h2> Peta Lokasi :
            <div class="ui buttons right floated">
                <a href="javascript:;" class="ui red button" onclick="divtitle()" title="Cetak PDF">&nbsp;Cetak&nbsp;</a>
            </div>
        </h2>
    </div>
    <br/>
    <div class="ui simple dropdown basic button top right pointing" style="float: right;">
        <i class="info circle icon"></i>
        <div class="menu">
            <div class="p-1">
                <i class="circle icon" style="color: rgb(188, 26, 183);"></i> <b>Ketua Isi Rumah</b>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div> </div>
<br/>

<div class="claro" style="width: 100%; position: relative;">
    
    <div id="map-container" style="width: 100%; height: 600px; border: 1px solid #000; position: relative;">
        <div id="viewDiv" style="position: absolute; top: 0; bottom: 0; width: 100%; height: 100%;"></div>
    </div>

</div>

<div style="display: none;">
    <div id="bg-gallery"></div>
    <div id="layerlist"></div>
    <div id="legend"></div>
</div>

<div id="divtitle1" style="display: none;">
    <div id="getLegend"></div>
</div>

<div id="print-container">
    
    <div class="print-header">
        <h2>PETA LOKASI</h2>
    </div>

    <div class="map-box">
        <img id="printImage" src="" style="width: 100%; max-height: 16cm; object-fit: contain;">
    </div>

    <div style="font-weight: bold; font-family: Arial; margin-bottom: 5px;">PETUNJUK :</div>
    <div id="printLegend" class="legend-box">
        </div>

    <div style="margin-top: 10px; font-size: 10px; font-family: Arial; text-align: right;">
        <i>Dicetak pada: <span id="printDate"></span> melalui Portal e-Perak</i>
    </div>
</div>