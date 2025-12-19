@php
    // 1. DATA PHP & MAPPING DINAMIK
    $safeKodMukim  = trim($kodMukim ?? '');
    $safeNamaMukim = trim($namaMukim ?? ''); 
    $safeDaerah    = trim($daerah ?? ''); 
    $upperNamaMukim = strtoupper($safeNamaMukim); 
    $upperNamaDaerah = strtoupper($safeDaerah);

    if(is_numeric($safeKodMukim)) {
        $safeKodMukim = str_pad($safeKodMukim, 2, '0', STR_PAD_LEFT);
    }

    $senaraiKodDaerah = [
        "BATANG PADANG" => "01", "MANJUNG" => "02", "KINTA" => "03", "KERIAN" => "04",
        "KUALA KANGSAR" => "05", "LARUT MATANG" => "06", "HILIR PERAK" => "07",
        "HULU PERAK" => "08", "SELAMA" => "09", "PERAK TENGAH" => "10",
        "KAMPAR" => "11", "MUALLIM" => "12"
    ];
    $kodDaerah = $senaraiKodDaerah[$upperNamaDaerah] ?? "00";

    // 2. DATA KIR
    $avgLat = 4.6; $avgLong = 101.0; 
    $zoomLevel = 10;
    $features = [];

    if(isset($datalocation) && count($datalocation) > 0) {
        $totalLat = 0; $totalLong = 0; $count = 0;
        foreach($datalocation as $key => $row) {
            if(isset($row->Latitud) && $row->Latitud != 0 && isset($row->Longitud) && $row->Longitud != 0) {
                $totalLat += floatval($row->Latitud);
                $totalLong += floatval($row->Longitud);
                $count++;
                
                $features[] = [
                    'geometry' => [
                        'type' => 'point',
                        'x' => floatval($row->Longitud),
                        'y' => floatval($row->Latitud)
                    ],
                    'attributes' => [
                        'ObjectID' => $key + 1,
                        'Nama' => $row->Nama ?? $row->nama ?? '-',
                        'NoKP' => $row->NoKP ?? $row->no_kp ?? '-',
                        'Kampung' => $row->NamaKampung ?? $row->nama_kampung ?? '-'
                    ]
                ];
            }
        }
        if($count > 0) {
            $avgLat = $totalLat / $count;
            $avgLong = $totalLong / $count;
            $zoomLevel = 13;
        }
    }
@endphp

<link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css">
<script src="https://js.arcgis.com/4.24/"></script>

<style>
    #viewDiv { padding: 0; margin: 0; height: 750px; width: 100%; border: 1px solid #ccc; }
    
    /* Popup Style */
    .popup-header { background-color: #003366; color: white; padding: 10px; font-weight: bold; }
    .popup-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
    .popup-table td { padding: 6px; border-bottom: 1px solid #eee; color: #333; }
    .popup-table th { padding: 6px; border-bottom: 2px solid #ccc; text-align: left; color: #555; width: 100px; }
    
    #printLoader { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.95); z-index: 9999; text-align: center; padding-top: 20%; font-family: Arial, sans-serif; }
</style>

<div id="printLoader">
    <i class="spinner loading icon" style="font-size: 3em; margin-bottom: 20px; color: #007bff;"></i><br>
    <h3 style="color: #333;">Menjana Cetakan...</h3>
</div>

<div class="divaccordion">
    <div>
        <h2> 
            <i class="map icon"></i> Peta Mukim: {{ $safeNamaMukim }} ({{ $safeDaerah }})
            <div class="ui buttons right floated">
                <a href="javascript:;" class="ui red button" id="btnCetak" title="Cetak Peta">
                    <i class="print icon"></i> Cetak
                </a>
            </div>
        </h2>
    </div>
</div>
<br/>

<div class="sidebar-list-job">
    <div class="section-box wow animate__animated animate__fadeIn mt-10">
        <div class="container">
            <div id="viewDiv"></div>
        </div>
    </div>
</div>

<script>
    const KOD_MUKIM = "{{ $safeKodMukim }}";   
    const KOD_DAERAH = "{{ $kodDaerah }}";     
    const NAMA_MUKIM = "{{ $upperNamaMukim }}"; 
    const NAMA_DAERAH_FULL = "{{ $upperNamaDaerah }}"; 
    const CENTER_LAT = {{ $avgLat }};
    const CENTER_LONG = {{ $avgLong }};
    const ZOOM_LVL = {{ $zoomLevel }};
    const KIR_DATA = {!! json_encode($features) !!};

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
        // 1. LAYER MUKIM
        // =========================================================
        const mukimLayer = new FeatureLayer({
            url: baseURL + "/25",
            title: "Sempadan Mukim",
            outFields: ["*"], 
            definitionExpression: "upper(KETERANGAN) = '" + NAMA_MUKIM + "'",
            opacity: 1, 
            renderer: {
                type: "simple",
                symbol: { type: "simple-fill", color: [0, 0, 0, 0], outline: { color: [255, 0, 0, 1], width: 4 } }
            },
            // --- LABEL MUKIM (HILANG BILA ZOOM DEKAT) ---
            labelingInfo: [{
                symbol: {
                    type: "text", 
                    color: "#800000", // MAROON
                    haloColor: "white", haloSize: 4, 
                    font: { family: "Arial Black", size: 18, weight: "bold" }
                },
                labelPlacement: "always-horizontal",
                labelExpressionInfo: { expression: `"${NAMA_MUKIM}"` },
                deconflictionStrategy: "none",
                // SCALE SETTING:
                minScale: 0,      // Nampak dari jauh (Angkasa)
                maxScale: 50000   // Hilang bila zoom lebih dekat dari 1:50,000 (Level Kampung)
            }],
            popupTemplate: {
                title: "Info Sempadan Mukim",
                content: `
                    <div class="popup-header">Info Mukim</div>
                    <table class="popup-table">
                        <tr><th>Mukim</th><td>: ${NAMA_MUKIM}</td></tr>
                        <tr><th>Daerah</th><td>: ${NAMA_DAERAH_FULL}</td></tr>
                        <tr><th>Kod Mukim</th><td>: ${KOD_MUKIM}</td></tr>
                    </table>`
            }
        });

        // =========================================================
        // 2. LAYER KAMPUNG
        // =========================================================
        const kampungLayer = new FeatureLayer({
            url: baseURL + "/22",
            title: "Sempadan Kampung",
            outFields: ["*"], 
            definitionExpression: "ID_KG LIKE '08%'", 
            opacity: 1,
            renderer: {
                type: "simple",
                symbol: { type: "simple-fill", color: [0, 0, 0, 0], outline: { color: [255, 140, 0, 1], width: 2, style: "dash" } }
            },
            // --- LABEL KAMPUNG (HILANG BILA ZOOM SANGAT DEKAT) ---
            labelingInfo: [{
                symbol: {
                    type: "text", 
                    color: "#00008B", // Biru Gelap
                    haloColor: "white", haloSize: 2, 
                    font: { family: "Arial", size: 10, weight: "bold" }
                },
                labelPlacement: "always-horizontal",
                labelExpressionInfo: { 
                    expression: `
                        var id = $feature.ID_KG;
                        var nm = $feature.NAMA; 
                        var dCode = Mid(id, 2, 2); 
                        var mCode = Mid(id, 4, 2);
                        if (dCode == '${KOD_DAERAH}' && mCode == '${KOD_MUKIM}') {
                            return nm;
                        } else { return ""; }
                    `
                },
                deconflictionStrategy: "none",
                // SCALE SETTING:
                minScale: 0,     // Nampak dari jauh
                maxScale: 5000   // Hilang bila zoom lebih dekat dari 1:5,000 (Level Rumah/KIR)
            }],
            popupTemplate: { 
                title: "Info Sempadan Kampung", 
                content: `
                    <div class="popup-header">{NAMA}</div>
                    <table class="popup-table">
                        <tr><th>Nama Kg</th><td>: {NAMA}</td></tr>
                        <tr><th>Mukim</th><td>: ${NAMA_MUKIM}</td></tr>
                        <tr><th>ID GIS</th><td>: {ID_KG}</td></tr>
                    </table>
                ` 
            }
        });

        // =========================================================
        // 3. LAYER KIR (POINT)
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
                symbol: { type: "simple-marker", color: [188, 26, 183], size: 7, outline: { color: "white", width: 1 } }
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

        const map = new Map({ basemap: "hybrid", layers: [mukimLayer, kampungLayer, kirLayer] });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: ZOOM_LVL,
            center: [CENTER_LONG, CENTER_LAT],
            popup: { dockEnabled: false, dockOptions: { buttonEnabled: false, breakpoint: false } }
        });

        view.when(() => {
            setTimeout(() => {
                mukimLayer.queryExtent().then(function(res) {
                    if (res.extent) { view.goTo(res.extent.expand(1.2)); }
                });
            }, 1000);

            // Filter Javascript
            view.whenLayerView(kampungLayer).then(function(layerView) {
                const query = kampungLayer.createQuery();
                query.where = "ID_KG LIKE '08%'"; 
                query.outFields = ["ID_KG", "OBJECTID"];

                kampungLayer.queryFeatures(query).then(function(results) {
                    const validOIDs = [];
                    results.features.forEach(function(feat) {
                        const idStr = String(feat.attributes.ID_KG);
                        if (idStr.length >= 6) {
                            const daerahCode = idStr.substring(2, 4); 
                            const mukimCode = idStr.substring(4, 6);  
                            if (daerahCode === KOD_DAERAH && mukimCode === KOD_MUKIM) {
                                validOIDs.push(feat.attributes.OBJECTID);
                            }
                        }
                    });
                    if (validOIDs.length > 0) {
                        layerView.filter = { objectIds: validOIDs };
                    }
                });
            });

            // Fungsi Cetak (SVG Legend)
            document.getElementById("btnCetak").addEventListener("click", function() {
                document.getElementById("printLoader").style.display = "block";
                
                view.takeScreenshot({ width: 2400, height: 1400, format: "jpg", quality: 95 }).then(function(screenshot) {
                    document.getElementById("printLoader").style.display = "none";
                    
                    var win = window.open('', 'Cetak Peta', 'height=800,width=1200');
                    win.document.write('<html><head><title>Peta Mukim - ' + NAMA_MUKIM + '</title>');
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
                    
                    win.document.write('<h1>PETA MUKIM: ' + NAMA_MUKIM + '</h1>');
                    win.document.write('<h3>DAERAH: ' + NAMA_DAERAH_FULL + '</h3>');
                    win.document.write('<div class="map-container"><img src="' + screenshot.dataUrl + '"/></div>');
                    
                    var svgMukim = '<svg width="24" height="24"><rect x="2" y="5" width="20" height="14" fill="none" stroke="red" stroke-width="4"/></svg>';
                    var svgKg = '<svg width="24" height="24"><rect x="2" y="5" width="20" height="14" fill="none" stroke="orange" stroke-width="3" stroke-dasharray="4"/></svg>';
                    var svgKir = '<svg width="20" height="20"><circle cx="10" cy="10" r="7" fill="#bc1ab7" stroke="white" stroke-width="1"/></svg>';
                    
                    win.document.write('<div class="legend-box">');
                    win.document.write('<div class="legend-item"><span class="symbol">' + svgMukim + '</span> Sempadan Mukim</div>');
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