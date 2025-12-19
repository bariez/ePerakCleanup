@php
    // 1. DATA PHP - Dapatkan data dari Controller
    $safeNamaKampung = trim($kampungdata->NamaKampung ?? $kampungdata->NAMA ?? 'Nama Kampung');
    $safeNamaMukim   = trim($kampungdata->NamaMukim ?? ''); 
    $safeIdKampung   = trim($kampungdata->IdKampungBaru ?? ''); 

    $upperNamaKampung = strtoupper($safeNamaKampung);
    $upperNamaMukim   = strtoupper($safeNamaMukim);

    // Koordinat Tengah
    $centerLong = $longKampung ?? 101.0;
    $centerLat  = $latKampung ?? 4.5;
    $zoomLevel  = 14; 

    // 2. PROSES DATA KIR KE FORMAT JSON
    $features = [];
    if(isset($kirkampung) && count($kirkampung) > 0) {
        foreach($kirkampung as $key => $row) {
            if(isset($row->Latitud) && $row->Latitud != 0 && isset($row->Longitud) && $row->Longitud != 0) {
                $features[] = [
                    'geometry' => [
                        'type' => 'point',
                        'x' => floatval($row->Longitud),
                        'y' => floatval($row->Latitud)
                    ],
                    'attributes' => [
                        'ObjectID' => $key + 1,
                        'Nama' => $row->Nama ?? '-',
                        'NoKP' => $row->NoKP ?? '-',
                        'Kampung' => $upperNamaKampung
                    ]
                ];
            }
        }
    }
@endphp

<link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css">
<script src="https://js.arcgis.com/4.24/"></script>

<style>
    #viewDiv { padding: 0; margin: 0; height: 650px; width: 100%; border: 1px solid #ccc; }
    
    /* Popup Style */
    .popup-header { background-color: #003366; color: white; padding: 10px; font-weight: bold; }
    .popup-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
    .popup-table td { padding: 6px; border-bottom: 1px solid #eee; color: #333; }
    .popup-table th { padding: 6px; border-bottom: 2px solid #ccc; text-align: left; color: #555; width: 100px; }
    
    /* Loader Print */
    #printLoader { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.95); z-index: 9999; text-align: center; padding-top: 20%; font-family: Arial, sans-serif; }

    /* Header & Button Layout */
    .map-header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .map-title h4 { margin: 0; color: #333; font-weight: bold; }
    
    .btn-group-custom { display: flex; gap: 10px; }
    
    .btn-custom { 
        padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; color: white !important; 
        display: inline-flex; align-items: center; cursor: pointer; border: none; font-size: 14px;
        transition: background 0.3s;
    }
    .btn-red { background-color: #db2828; } 
    .btn-red:hover { background-color: #d01919; }
    
    .btn-custom i { margin-right: 8px; }
</style>

<div id="printLoader">
    <i class="spinner loading icon" style="font-size: 3em; margin-bottom: 20px; color: #007bff;"></i><br>
    <h3 style="color: #333;">Menjana Cetakan Peta...</h3>
</div>

<div class="sidebar-list-job">
    <div class="section-box wow animate__animated animate__fadeIn mt-10">
        <div class="container">
            
            <div class="map-header-container">
                <div class="map-title">
                    <h4><i class="map icon"></i> Peta: {{ $upperNamaKampung }}</h4>
                </div>
                <div class="btn-group-custom">
                    <a href="javascript:;" class="btn-custom btn-red" id="btnCetak" title="Cetak Peta Penuh">
                        <i class="print icon"></i> Cetak Peta
                    </a>
                </div>
            </div>

            <div id="viewDiv" class="claro"></div>
            
        </div>
    </div>
</div>

<script>
    // DATA DARI PHP KE JAVASCRIPT
    const ID_KG_SEARCH = "{{ $safeIdKampung }}"; 
    const NAMA_KAMPUNG = "{{ $upperNamaKampung }}";
    const NAMA_MUKIM   = "{{ $upperNamaMukim }}";
    const CENTER_LAT   = {{ $centerLat }};
    const CENTER_LONG  = {{ $centerLong }};
    const ZOOM_LVL     = {{ $zoomLevel }};
    const KIR_DATA     = {!! json_encode($features) !!};

    console.log("GIS Setup -> Kampung:", NAMA_KAMPUNG, "ID:", ID_KG_SEARCH);

    require([
        "esri/Map", "esri/views/MapView", "esri/layers/FeatureLayer",
        "esri/widgets/LayerList", "esri/widgets/Legend",     
        "esri/widgets/BasemapGallery", "esri/widgets/Expand", 
        "esri/widgets/Search", "esri/widgets/Home"
    ], function(
        Map, MapView, FeatureLayer, LayerList, Legend, BasemapGallery, Expand, Search, Home
    ) {

        const baseURL = "https://mygdispatial.perak.gov.my/server/rest/services/ePerak/Perak/MapServer";

        // =========================================================
        // 1. LAYER KAMPUNG (FILTER ID_KG)
        // =========================================================
        const kampungLayer = new FeatureLayer({
            url: baseURL + "/22", 
            title: "Sempadan Kampung",
            outFields: ["*"], 
            definitionExpression: "ID_KG LIKE '%" + ID_KG_SEARCH + "%'", 
            opacity: 1,
            renderer: {
                type: "simple",
                symbol: { 
                    type: "simple-fill", 
                    color: [4, 194, 183, 0.1], // Isi Biru Muda Transparent
                    outline: { color: [255, 140, 0, 1], width: 3, style: "dash" } // OREN PUTUS
                } 
            },
            labelingInfo: [{
                symbol: {
                    type: "text", 
                    color: "#00008B", // Biru Gelap
                    haloColor: "white", haloSize: 2, 
                    font: { family: "Arial", size: 12, weight: "bold" }
                },
                labelPlacement: "always-horizontal",
                labelExpressionInfo: { expression: "$feature.NAMA" },
                deconflictionStrategy: "none"
            }],
            popupTemplate: { 
                title: "Info Sempadan Kampung", 
                content: `
                    <div class="popup-header">{NAMA}</div>
                    <table class="popup-table">
                        <tr><th>Nama Kg</th><td>: {NAMA}</td></tr>
                        <tr><th>ID GIS</th><td>: {ID_KG}</td></tr>
                    </table>
                ` 
            }
        });

        // =========================================================
        // 2. LAYER KIR (TITIK PURPLE)
        // =========================================================
        const kirLayer = new FeatureLayer({
            source: KIR_DATA, 
            objectIdField: "ObjectID",
            title: "Ketua Isi Rumah",
            fields: [
                { name: "ObjectID", type: "oid" },
                { name: "Nama", type: "string" },
                { name: "NoKP", type: "string" },
                { name: "Kampung", type: "string" }
            ],
            renderer: {
                type: "simple",
                symbol: { 
                    type: "simple-marker", 
                    color: [188, 26, 183], // PURPLE
                    size: 8, 
                    outline: { color: "white", width: 1 } 
                }
            },
            popupTemplate: {
                title: "Info Penduduk",
                content: `<table class="popup-table">
                            <tr><th>NAMA</th><td>{Nama}</td></tr>
                            <tr><th>NO KP</th><td>{NoKP}</td></tr>
                            <tr><th>ALAMAT</th><td>{Kampung}</td></tr>
                          </table>`
            }
        });

        // =========================================================
        // 3. MAP SETUP (HYBRID)
        // =========================================================
        const map = new Map({ 
            basemap: "hybrid", 
            layers: [kampungLayer, kirLayer] 
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: ZOOM_LVL,
            center: [CENTER_LONG, CENTER_LAT],
            popup: { dockEnabled: false, dockOptions: { buttonEnabled: false, breakpoint: false } }
        });

        // =========================================================
        // 4. ZOOM & EVENTS
        // =========================================================
        view.when(() => {
            setTimeout(() => {
                kampungLayer.queryExtent().then(function(res) {
                    if (res.extent) { 
                        view.goTo(res.extent.expand(1.5)); 
                    } else {
                        if(KIR_DATA.length > 0) {
                            view.goTo(kirLayer.fullExtent);
                        }
                    }
                });
            }, 1000);

            // -------------------------------------------------------------
            // FUNGSI CETAK (LANDSCAPE + LEGEND MANUAL)
            // -------------------------------------------------------------
            document.getElementById("btnCetak").addEventListener("click", function() {
                document.getElementById("printLoader").style.display = "block";
                
                view.takeScreenshot({ width: 2400, height: 1400, format: "jpg", quality: 95 }).then(function(screenshot) {
                    document.getElementById("printLoader").style.display = "none";
                    
                    var win = window.open('', 'Cetak Peta', 'height=800,width=1200');
                    win.document.write('<html><head><title>Peta Kampung - ' + NAMA_KAMPUNG + '</title>');
                    win.document.write('<style>');
                    win.document.write('@page { size: landscape; margin: 0.5cm; }');
                    win.document.write('body { margin: 0; padding: 0; font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh; }');
                    win.document.write('h1 { margin: 10px 0 2px 0; font-size: 24px; text-transform: uppercase; }');
                    win.document.write('h3 { margin: 0 0 10px 0; font-size: 16px; color: #555; }');
                    
                    win.document.write('.map-container { width: 100%; text-align: center; border: 2px solid #333; margin-bottom: 10px; }');
                    win.document.write('img { width: 100%; max-height: 80vh; object-fit: contain; }');
                    
                    win.document.write('.legend-box { display: flex; justify-content: center; gap: 20px; border: 1px solid #ccc; padding: 10px; background: #f9f9f9; width: 90%; border-radius: 5px; }');
                    win.document.write('.legend-item { display: flex; align-items: center; font-size: 14px; font-weight: bold; }');
                    win.document.write('.symbol { width: 24px; height: 24px; margin-right: 8px; display: inline-flex; align-items: center; justify-content: center; }');
                    win.document.write('* { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }'); 
                    win.document.write('</style></head><body>');
                    
                    win.document.write('<h1>PETA KAMPUNG: ' + NAMA_KAMPUNG + '</h1>');
                    if(NAMA_MUKIM != "") {
                        win.document.write('<h3>MUKIM: ' + NAMA_MUKIM + '</h3>');
                    }
                    
                    win.document.write('<div class="map-container"><img src="' + screenshot.dataUrl + '"/></div>');
                    
                    var svgKg = '<svg width="24" height="24"><rect x="2" y="5" width="20" height="14" fill="rgba(4,194,183,0.3)" stroke="orange" stroke-width="3" stroke-dasharray="4"/></svg>';
                    var svgKir = '<svg width="20" height="20"><circle cx="10" cy="10" r="7" fill="#bc1ab7" stroke="white" stroke-width="1"/></svg>';
                    
                    win.document.write('<div class="legend-box">');
                    win.document.write('<div class="legend-item"><span class="symbol">' + svgKg + '</span> Sempadan Kampung</div>');
                    win.document.write('<div class="legend-item"><span class="symbol">' + svgKir + '</span> Ketua Isi Rumah (KIR)</div>');
                    win.document.write('</div>');
                    
                    win.document.write('</body></html>');
                    win.document.close();
                    win.focus();
                    setTimeout(function(){ win.print(); }, 800);
                });
            });
        });

        // WIDGETS
        view.ui.add(new Expand({ view: view, content: new LayerList({ view: view }), group: "top-right", expandIconClass: "esri-icon-layers" }), "top-right");
        view.ui.add(new Expand({ 
            view: view, content: new Legend({ view: view }), 
            group: "top-right", expanded: false, expandIconClass: "esri-icon-layer-list", expandTooltip: "Buka Lagenda"
        }), "top-right");
        view.ui.add(new Expand({ view: view, content: new BasemapGallery({ view: view }), group: "top-right", expandIconClass: "esri-icon-basemap" }), "top-right");
        view.ui.add([new Home({ view: view }), new Search({ view: view })], "top-left");

    });
</script>