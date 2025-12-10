@php
    // Kita ambil nama mukim yang dihantar dari Controller
    // Jika tiada, kita letak string kosong
    $namaMukimUntukMap = $namaMukimMap ?? '';

    // Debug untuk pastikan nama mukim wujud
    \Log::info("GIS Mukim View Loaded. Target Mukim: " . $namaMukimUntukMap);
@endphp

<script>
    $( document ).ready(function(){
        document.title='PETA LOKASI';
    });

    // 1. DATA DARI PHP (Guna json_encode untuk elak SyntaxError)
    // Jika data null, kita bagi nilai default Ipoh
    const longKampung = {!! json_encode($longKampung ?? 101.0901) !!};
    const latKampung = {!! json_encode($latKampung ?? 4.5921) !!};
    
    // Ambil nama mukim dari controller.
    let targetMukimName = {!! json_encode($namaMukimMap ?? '') !!};
    
    // --- DIAGNOSTIC MODE ---
    // Jika Controller hantar kosong, kita test guna nama "CHENDERIANG"
    // (Berdasarkan screenshot anda, Chenderiang ada dalam GIS)
    if (!targetMukimName || targetMukimName === '') {
        console.warn("⚠️ Nama Mukim dari Database KOSONG. Menggunakan mode test: CHENDERIANG");
        targetMukimName = "CHENDERIANG"; 
    }

    console.log("=== MAP DEBUG ===");
    console.log("📍 Center:", latKampung, longKampung);
    console.log("🎯 Target Mukim:", targetMukimName);

    let kampungFeatureLayer; 

    function applyKampungFiltering() {
        if (!kampungFeatureLayer) return;

        console.log("🔍 Memulakan filter GIS...");

        if (targetMukimName && targetMukimName.trim() !== '') {
            // Filter SQL: Cari MUKIM yang namanya mengandungi targetMukimName
            const filterExpression = "UPPER(MUKIM) LIKE UPPER('%" + targetMukimName + "%')";
            
            console.log("Testing Expression:", filterExpression);

            kampungFeatureLayer.definitionExpression = filterExpression;
            kampungFeatureLayer.visible = true;
            
            // Cuba zoom ke kawasan tersebut
            kampungFeatureLayer.queryExtent().then(function(results){
                if (results.count > 0) {
                    console.log("✅ Jumpa " + results.count + " kawasan! Zooming...");
                    view.goTo(results.extent).catch(function(error){
                        if (error.name != "AbortError") console.error(error);
                    });
                } else {
                    console.error("❌ Tiada data dijumpai dalam GIS untuk nama: " + targetMukimName);
                    alert("Peta berjaya load, tapi tiada sempadan mukim bernama '" + targetMukimName + "' dalam server GIS JUPEM/Perak.");
                }
            }).catch(function(error){
                console.error("❌ Error querying extent:", error);
            });

        } else {
            console.warn("⚠️ Nama Mukim masih kosong. Layer disembunyikan.");
            kampungFeatureLayer.visible = false;
        }
    }

    require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/MapImageLayer", 
        "esri/layers/FeatureLayer", // Module FeatureLayer
        "esri/widgets/BasemapGallery",
        "esri/widgets/LayerList",
        "esri/widgets/Legend",
        "esri/widgets/Expand",
        "esri/widgets/Search",
        "esri/Graphic",
    ], (Map, MapView, MapImageLayer, FeatureLayer, BasemapGallery, LayerList, Legend, Expand, Search, Graphic) => {

        // --- 1. SETUP LAYER SEMPADAN KAMPUNG (FEATURE LAYER) ---
        const mapKampungSymbol = {
            type: "simple-fill", 
            color: [4, 194, 183, 0.4], // Warna Cyan dengan transparency (0.4)
            style: "solid",
            outline: { width: 2, color: "white" }
        };

        const renderer = {
            type: "simple", // Guna simple renderer dulu untuk test
            symbol: mapKampungSymbol
        };

        // URL FeatureServer (Pastikan hujung ada /0)
        const urlKampungBaru = "https://mygdispatial.perak.gov.my/server/rest/services/Sempadan_Kampung/FeatureServer/0";

        kampungFeatureLayer = new FeatureLayer({
            url: urlKampungBaru,
            title: "Sempadan Kampung",
            outFields: ["*"],
            renderer: renderer,
            visible: true
        });

        // --- 2. SETUP CONTEXT LAYER (HOSPITAL DLL) ---
        // Setup URL secara selamat
        <?php 
            $urlGisDefault = env('URL_GIS');
            $mukimGisUrl = 'default';
            if(isset($kampungdata) && count($kampungdata) > 0 && isset($kampungdata[0]->mukim->url_gis)) {
                $mukimGisUrl = $kampungdata[0]->mukim->url_gis;
            }
        ?>
        const urlContextGis = "{!! $urlGisDefault !!}".replace("VARMAP", "{!! $mukimGisUrl !!}");
        
        const contextLayer = new MapImageLayer({
            url: urlContextGis,
            sublayers: [
                { id: 26, title: "Sempadan Daerah", visible: true },
                { id: 6, title: "Pasar", visible: false },
                // ... layer lain boleh tambah kemudian ...
            ]
        });

        // --- 3. MAP SETUP ---
        const map = new Map({
            basemap: "gray-vector",
            layers: [contextLayer, kampungFeatureLayer]
        });

        window.view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 11,
            center: [longKampung, latKampung] 
        });

        // --- 4. WIDGETS ---
        const searchWidget = new Search({ view: view });
        const basemapGallery = new BasemapGallery({ view: view, content: document.getElementById("bg-gallery") });
        const layerList = new LayerList({ view: view, content: document.getElementById("layerlist") });
        const legend = new Legend({ view: view, content: document.getElementById("legend") });

        const bgExpand = new Expand({ view: view, content: basemapGallery, expandIconClass: "esri-icon-basemap", group: "bottom-right" });
        const bgExpand2 = new Expand({ view: view, content: layerList, expandIconClass: "esri-icon-layers", group: "bottom-right" });
        const bgExpand3 = new Expand({ view: view, content: legend, expandIconClass: "esri-icon-layer-list", group: "bottom-right" });

        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");

        // --- 5. LOGIC LOAD ---
        view.when(() => {
            console.log("🎯 Map View Ready!");

            // Tunggu layer load, kemudian filter
            kampungFeatureLayer.load().then(() => {
                console.log("✅ Layer Sempadan Loaded. Fields:", kampungFeatureLayer.fields.map(f => f.name));
                applyKampungFiltering();
            }).catch(err => {
                console.error("❌ Gagal load FeatureLayer:", err);
                alert("Gagal menghubungi server GIS Sempadan Kampung.");
            });
        });
    });
    
    function divtitle() {
        window.print();
    }
</script>

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
