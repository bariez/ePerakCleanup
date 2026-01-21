@php
    // =========================================================
    // 1. DATA PHP & MAPPING DINAMIK
    // =========================================================
    
    $rawDaerah = isset($daerah) ? trim($daerah) : '';

    if (empty($rawDaerah) && isset($datalocation) && count($datalocation) > 0) {
        $firstItem = $datalocation[0];
        $rawDaerah = $firstItem->Daerah ?? $firstItem->daerah ?? $firstItem->NamaDaerah ?? '';
    }

    $upperNamaDaerah = strtoupper($rawDaerah);
    $cleanNamaDaerah = str_replace("DAERAH ", "", $upperNamaDaerah);
    $cleanNamaDaerah = trim($cleanNamaDaerah);

    $senaraiKodDaerah = [
        "BATANG PADANG" => "01", "MANJUNG" => "02", "KINTA" => "03", "KERIAN" => "04",
        "KUALA KANGSAR" => "05", "LARUT MATANG" => "06", "LARUT, MATANG DAN SELAMA" => "06",
        "LMS" => "06", "HILIR PERAK" => "07", "HULU PERAK" => "08", "SELAMA" => "09",
        "PERAK TENGAH" => "10", "KAMPAR" => "11", "MUALLIM" => "12", "BAGAN DATUK" => "13"
    ];
    
    $kodDaerah = $senaraiKodDaerah[$cleanNamaDaerah] ?? "00";

    $avgLat = 4.5; $avgLong = 101.0; 
    $zoomLevel = 9; 
    $features = [];

    if(isset($datalocation) && count($datalocation) > 0) {
        $totalLat = 0; $totalLong = 0; $count = 0;
        foreach($datalocation as $row) {
            if(!empty($row->Latitud) && !empty($row->Longitud) && $row->Latitud != 0) {
                $totalLat += floatval($row->Latitud);
                $totalLong += floatval($row->Longitud);
                $count++;
                
                $features[] = [
                    'geometry' => ['type' => 'point', 'x' => floatval($row->Longitud), 'y' => floatval($row->Latitud)],
                    'attributes' => [
                        'ObjectID' => $count,
                        'Nama' => $row->Nama ?? '-',
                        'NoKP' => $row->NoKP ?? '-',
                        'Kampung' => $row->NamaKampung ?? '-',
                        'Mukim' => $row->NamaMukim ?? '-', 
                        'Daerah' => $cleanNamaDaerah
                    ]
                ];
            }
        }
        if($count > 0) {
            $avgLat = $totalLat / $count;
            $avgLong = $totalLong / $count;
            $zoomLevel = 10; 
        }
    }
@endphp

<link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css">
<script src="https://js.arcgis.com/4.24/"></script>

<style>
    #viewDiv { padding: 0; margin: 0; height: 650px; width: 100%; border: 1px solid #ccc; position: relative; }
    
    .esri-popup__content table { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 13px; margin-top: 5px; }
    .esri-popup__content td { padding: 6px; border-bottom: 1px solid #eee; color: #333; vertical-align: top; }
    .esri-popup__content th { padding: 6px; border-bottom: 2px solid #0079c1; text-align: left; color: #555; width: 40%; font-weight: bold; vertical-align: top; background-color: #f9f9f9; }
    
    #printLoader { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.95); z-index: 99999; text-align: center; padding-top: 20%; }
</style>

<div id="printLoader"><h3 style="color: #003366;">Sedang Menjana PDF...</h3></div>

<div style="padding: 15px; background: #f8f9fa; border-bottom: 2px solid #003366; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="margin:0; color: #333; text-transform: uppercase;">PETA: {{ $cleanNamaDaerah }}</h3>
    <button class="ui red button tiny" id="btnCetakInternal"><i class="print icon"></i> Cetak PDF</button>
</div>

<div id="viewDiv"></div>

<script>
    require([
        "esri/Map", "esri/views/MapView", "esri/layers/FeatureLayer",
        "esri/widgets/LayerList", "esri/widgets/Legend",
        "esri/widgets/BasemapGallery", "esri/widgets/Expand", "esri/widgets/Home"
    ], function(Map, MapView, FeatureLayer, LayerList, Legend, BasemapGallery, Expand, Home) {

        const kodDaerah = "{{ $kodDaerah }}";
        const namaDaerah = "{{ $cleanNamaDaerah }}";
        const featuresData = {!! json_encode($features) !!};
        const baseURL = "https://mygdispatial.perak.gov.my/server/rest/services/ePerak/Perak/MapServer";

        // =========================================================
        // 1. LAYER DAERAH (BAWAH SEKALI)
        // =========================================================
        const daerahLayer = new FeatureLayer({
            url: baseURL + "/26",
            title: "Sempadan Daerah",
            definitionExpression: "KODDAERAH = '" + kodDaerah + "'",
            outFields: ["*"],
            renderer: {
                type: "simple",
                symbol: { type: "simple-fill", color: [0,0,0,0], outline: { color: "blue", width: 3 } }
            },
            popupTemplate: {
                title: "Info Daerah",
                content: `
                    <table>
                        <tr><th>Nama Daerah</th><td>{KODDAERAH}</td></tr>
                    </table>
                `
            }
        });

        // =========================================================
        // 2. LAYER MUKIM (TENGAH)
        // =========================================================
        const mukimLayer = new FeatureLayer({
            url: baseURL + "/25",
            title: "Sempadan Mukim",
            definitionExpression: "KODDAERAH = '" + kodDaerah + "'",
            outFields: ["*"],
            renderer: {
                type: "simple",
                symbol: { type: "simple-fill", color: [0,0,0,0], outline: { color: "red", width: 2 } }
            },
            labelingInfo: [{
                symbol: {
                    type: "text", color: "red", haloColor: "white", haloSize: 2,
                    font: { family: "Arial", size: 10, weight: "bold" },
                    horizontalAlignment: "center"
                },
                labelPlacement: "always-horizontal",
                labelExpressionInfo: { expression: "$feature.MUKIM" },
                deconflictionStrategy: "none" 
            }],
            popupTemplate: {
                title: "Info Mukim",
                content: `
                    <table>
                        <tr><th>Nama Mukim</th><td>{MUKIM}</td></tr>
                        <tr><th>Nama Daerah</th><td>`+namaDaerah+`</td></tr>
                    </table>
                `
            }
        });

        // =========================================================
        // 3. LAYER KAMPUNG (ATAS SEKALI)
        // =========================================================
        const kampungLayer = new FeatureLayer({
            url: baseURL + "/22",
            title: "Sempadan Kampung",
            // Note: Filter dibuang untuk memastikan layer keluar
            outFields: ["*"], 
            renderer: {
                type: "simple",
                symbol: { 
                    type: "simple-fill", 
                    color: [0,0,0,0], 
                    outline: { color: [255, 140, 0, 1], width: 2, style: "short-dash" } 
                }
            },
            minScale: 0, 
            maxScale: 0,
            labelingInfo: [{
                symbol: {
                    type: "text", color: "#d97700", haloColor: "white", haloSize: 2,
                    font: { family: "Arial", size: 9, weight: "bold" },
                    horizontalAlignment: "center"
                },
                labelPlacement: "always-horizontal",
                labelExpressionInfo: { expression: "$feature.NAMA" },
                minScale: 50000 
            }],
            popupTemplate: {
                title: "Info Kampung",
                content: `
                    <table>
                        <tr><th>Nama Kampung</th><td>{NAMA}</td></tr>
                        <tr><th>Nama Mukim</th><td>{MUKIM}</td></tr>
                        <tr><th>Nama Daerah</th><td>{DAERAH}</td></tr>
                    </table>
                `
            }
        });

        // =========================================================
        // 4. LAYER KIR (TITIK PENDUDUK - PALING ATAS)
        // =========================================================
        const kirLayer = new FeatureLayer({
            source: featuresData,
            objectIdField: "ObjectID",
            title: "Penduduk (KIR)",
            fields: [
                {name:"ObjectID",type:"oid"},
                {name:"Nama",type:"string"},
                {name:"Kampung",type:"string"},
                {name:"Mukim",type:"string"},
                {name:"Daerah",type:"string"}
            ],
            renderer: {
                type: "simple",
                symbol: { type: "simple-marker", color: "#bc1ab7", size: 7, outline: { color: "white", width: 1 } }
            },
            popupTemplate: {
                title: "Info Penduduk (KIR)",
                content: `
                    <table>
                        <tr><th>Nama KIR</th><td>{Nama}</td></tr>
                        <tr><th>Nama Kampung</th><td>{Kampung}</td></tr>
                        <tr><th>Nama Mukim</th><td>{Mukim}</td></tr>
                        <tr><th>Nama Daerah</th><td>{Daerah}</td></tr>
                    </table>
                `
            }
        });

        // =========================================================
        // SUSUNAN MAP LAYERS (DARI BAWAH KE ATAS)
        // 0: Daerah (Bawah)
        // 1: Mukim (Tengah)
        // 2: Kampung (Atas)
        // 3: KIR (Paling Atas)
        // =========================================================
        const map = new Map({
            basemap: "hybrid",
            layers: [daerahLayer, mukimLayer, kampungLayer, kirLayer]
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: {{ $zoomLevel }},
            center: [{{ $avgLong }}, {{ $avgLat }}],
            popup: { dockEnabled: true }
        });

        view.when(() => {
            setTimeout(() => {
                daerahLayer.queryExtent().then((res) => {
                    if(res.extent) view.goTo(res.extent.expand(1.2));
                });
            }, 1000);

            // FUNGSI CETAK
            document.getElementById("btnCetakInternal").onclick = function() {
                document.getElementById("printLoader").style.display = "block";
                
                view.takeScreenshot({ width: 2000, height: 1200, format: "jpg" }).then((screenshot) => {
                    document.getElementById("printLoader").style.display = "none";
                    var win = window.open('','Print','height=900,width=1300');
                    
                    var htmlContent = `
                        <html>
                        <head>
                            <title>Peta Daerah ${namaDaerah}</title>
                            <style>
                                body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
                                h1 { text-transform: uppercase; margin-bottom: 5px; }
                                .map-img { width: 100%; border: 2px solid #333; margin-bottom: 20px; }
                                .legend-box { 
                                    display: flex; justify-content: center; gap: 30px; 
                                    padding: 15px; border: 1px solid #ccc; background: #fff; 
                                    border-radius: 4px; width: fit-content; margin: 0 auto;
                                }
                                .legend-item { display: flex; align-items: center; font-size: 14px; font-weight: bold; }
                                .symbol { width: 30px; height: 16px; margin-right: 10px; display: inline-block; }
                                .p-daerah { border: 3px solid blue; }
                                .p-mukim { border: 2px solid red; }
                                .p-kampung { border: 2px dashed orange; }
                                .p-kir { width: 14px; height: 14px; background-color: #bc1ab7; border-radius: 50%; border: 1px solid #000; }
                            </style>
                        </head>
                        <body>
                            <h1>PETA LOKASI DAERAH: ${namaDaerah}</h1>
                            <p>Tarikh Cetakan: ${new Date().toLocaleDateString()}</p>
                            <img class="map-img" src="${screenshot.dataUrl}" />
                            
                            <div class="legend-box">
                                <div class="legend-item"><span class="symbol p-kampung"></span> Sempadan Kampung</div>
                                <div class="legend-item"><span class="symbol p-mukim"></span> Sempadan Mukim</div>
                                <div class="legend-item"><span class="symbol p-daerah"></span> Sempadan Daerah</div>
                                <div class="legend-item"><span class="symbol p-kir"></span> Penduduk (KIR)</div>
                            </div>
                        </body>
                        </html>
                    `;
                    win.document.write(htmlContent);
                    win.document.close();
                    setTimeout(() => win.print(), 1000);
                });
            };
        });

        // WIDGETS
        const layerList = new LayerList({ view: view });
        const expandLayerList = new Expand({
            view: view, content: layerList, expandIconClass: "esri-icon-layers", group: "top-right", expandTooltip: "Senarai Layer"
        });

        const legend = new Legend({ view: view, style: "classic" });
        const expandLegend = new Expand({
            view: view, content: legend, expandIconClass: "esri-icon-layer-list", group: "top-right", expandTooltip: "Lagenda"
        });

        const basemapGallery = new BasemapGallery({ view: view });
        const expandBasemap = new Expand({
            view: view, content: basemapGallery, expandIconClass: "esri-icon-basemap", group: "top-right", expandTooltip: "Tukar Peta"
        });

        view.ui.add(new Home({ view: view }), "top-left");
        view.ui.add([expandBasemap, expandLayerList, expandLegend], "top-right");
    });
</script>