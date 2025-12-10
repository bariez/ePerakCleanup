<script>
    // 1. Dapatkan Data dari Laravel
    const longKampung = {!! $longKampung ?? 101.0 !!}; 
    const latKampung  = {!! $latKampung ?? 4.5 !!};
    
    // Ambil ID sebagai String
    const id_kg = "{{ trim($kampungdata->IdKampungBaru ?? '') }}"; 

    console.log("Mencari ID:", id_kg); 

    require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/FeatureLayer",
        "esri/widgets/BasemapGallery",
        "esri/widgets/LayerList",
        "esri/Graphic",
        "esri/widgets/Legend",
        "esri/widgets/Expand", 
        "esri/widgets/Search"
    ], function(Map, MapView, FeatureLayer, BasemapGallery, LayerList, Graphic, Legend, Expand, Search) {

        // ---------------------------------------------------------
        // 2. Setup Layer Sempadan
        // ---------------------------------------------------------
        const featureLayer = new FeatureLayer({
            url: "https://mygdispatial.perak.gov.my/server/rest/services/ePerak/Perak/MapServer/22",
            outFields: ["*"],
            
            // --- PEMBETULAN POWER ---
            // Gunakan 'LIKE' dan tanda '%' (Wildcard).
            // Ini bermaksud: Cari ID_KG yang *mengandungi* nombor ini (tak kira ada spasi atau tidak)
            definitionExpression: "ID_KG LIKE '%" + id_kg + "%'", 
            
            // Pastikan layer sentiasa dipaparkan tak kira zoom level
            minScale: 0,
            maxScale: 0,

            renderer: {
                type: "simple",
                symbol: {
                    type: "simple-fill",
                    color: [4, 194, 183, 0.4], 
                    outline: { color: "red", width: 3 } 
                }
            },
            popupTemplate: {
                title: "{NAMA}", 
                content: "Kod ArcGIS: {ID_KG}<br>Nama: {NAMA}"
            },
            labelsVisible: true
        });

        // ---------------------------------------------------------
        // 3. Setup Map
        // ---------------------------------------------------------
        const map = new Map({
            basemap: "gray-vector", 
            layers: [featureLayer] 
        });

        const view = new MapView({
            container: "viewDiv",
            map: map,
            zoom: 10, 
            center: [longKampung, latKampung] 
        });

        // ---------------------------------------------------------
        // 4. ZOOM LOGIC
        // ---------------------------------------------------------
        view.when(() => {
            if(id_kg) {
                featureLayer.when(() => {
                    const query = featureLayer.createQuery();
                    query.where = featureLayer.definitionExpression;

                    featureLayer.queryExtent(query).then(function(response) {
                        if (response.extent) {
                            console.log("BERJAYA! Sempadan dijumpai menggunakan LIKE.");
                            view.goTo(response.extent.expand(1.5));
                        } else {
                            console.error("MASIH GAGAL: Tiada data dijumpai walaupun guna LIKE.");
                            console.log("Kemungkinan Layer ID 22 salah atau data tiada dalam ArcGIS.");
                            
                            // Fallback
                            if (view.graphics.length > 0) view.goTo(view.graphics); 
                        }
                    }).catch(function(error){
                        console.error("Ralat Query:", error);
                    });
                });
            }
        });

        // ---------------------------------------------------------
        // 5. Widgets & Marker
        // ---------------------------------------------------------
        const searchWidget = new Search({ view: view });
        const basemapGallery = new BasemapGallery({ view: view, content: document.getElementById("bg-gallery") });
        const layerList = new LayerList({ view: view, content: document.getElementById("layerlist") });
        const legend = new Legend({ view: view, content: document.getElementById("legend") });

        const bgExpand = new Expand({ view: view, content: basemapGallery, expandIconClass: "esri-icon-basemap", group: "bottom-right" });
        const bgExpand2 = new Expand({ view: view, content: layerList, expandIconClass: "esri-icon-layers", group: "bottom-right" });
        const bgExpand3 = new Expand({ view: view, content: legend, expandIconClass: "esri-icon-layer-list", group: "bottom-right" });

        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");

        <?php if(isset($kirkampung) && count($kirkampung) > 0) { ?>
            <?php foreach ($kirkampung as $key => $value ){ ?>
                var point = {
                    type: "point", 
                    longitude: {{ $value->Longitud ?? 0 }}, 
                    latitude: {{ $value->Latitud ?? 0 }}
                };
                if(point.longitude != 0 && point.latitude != 0) {
                    var markerSymbol = {
                        type: "simple-marker",
                        color: [188, 26, 183], 
                        outline: { color: [255, 255, 255], width: 1 },
                        size: 8
                    };
                    var pointGraphic = new Graphic({
                        geometry: point,
                        symbol: markerSymbol,
                        popupTemplate: {
                            title: "Ketua Isi Rumah",
                            content: "<table><tr><td>Nama</td><td>: </td><td>{{ $value->Nama }}</td></tr></table>"
                        }
                    });
                    view.graphics.add(pointGraphic);
                }
            <?php } ?>
        <?php } ?>

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

            <!--div id="map" class="claro" style="width:100%; height:600px; border:1px solid #000;">-->
                <div id="viewDiv" class="claro" style="width:100%; height:600px; border:1px solid #000;">
                <!--div id="viewDiv"></div>-->
            </div>
        </div>
    </div>
</div>
