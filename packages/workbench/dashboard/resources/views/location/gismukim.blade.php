@php
    // Get user's mukim
    $userMukim = auth()->user()->Mukim ?? null;
    $allowedKampungIds = [];
    
    if ($userMukim) {
        try {
            $kampungResults = DB::select("
                SELECT IdKampungBaru 
                FROM kampung 
                WHERE fk_mukim = ?
            ", [$userMukim]);
            
            // Extract just the IDs into an array
            $rawIds = array_column($kampungResults, 'IdKampungBaru');

            // Filter out empty/null values and reindex the array
            $allowedKampungIds = array_values(array_filter($rawIds, function($id) {
                return !empty(trim($id));
            }));
            
            // Debug: Log the results
            \Log::info("Kampung filtering debug:", [
                'user_mukim' => $userMukim,
                'raw_results_count' => count($kampungResults),
                'raw_ids_count' => count($rawIds),
                'filtered_ids_count' => count($allowedKampungIds),
                'sample_ids' => array_slice($allowedKampungIds, 0, 5)
            ]);
            
        } catch (\Exception $e) {
            \Log::error("Kampung query failed for mukim {$userMukim}: " . $e->getMessage());
            $allowedKampungIds = [];
        }
    }
@endphp

<script>
    $( document ).ready(function(){
        document.title='PETA LOKASI';
    });

    const longKampung = {!! $longKampung !!};
    const latKampung = {!! $latKampung !!};
    // console.log(longKampung + "    -----   " + latKampung);

    const userId = {!! json_encode(auth()->user()->id ?? null) !!};
    const userDaerah = {!! json_encode(auth()->user()->Daerah ?? null) !!};
    const userMukim = {!! json_encode(auth()->user()->Mukim ?? null) !!};
    let allowedKampungIds = {!! json_encode($allowedKampungIds ?? []) !!};
    
    if (allowedKampungIds && typeof allowedKampungIds === 'object' && !Array.isArray(allowedKampungIds)) {
        console.log("Converting object to array...");
        allowedKampungIds = Object.values(allowedKampungIds);
        console.log("Converted to array:", allowedKampungIds);
    }

    // Enhanced debug logging
    console.log("=== FIXED KAMPUNG DEBUG INFO ===");
    console.log("User Mukim:", userMukim);
    console.log("Allowed Kampung IDs Type:", typeof allowedKampungIds);
    console.log("Is Array:", Array.isArray(allowedKampungIds));
    console.log("Allowed Kampung IDs Array:", allowedKampungIds);
    console.log("Array Length:", allowedKampungIds ? allowedKampungIds.length : 'undefined');
    
    if (allowedKampungIds && allowedKampungIds.length > 0) {
        console.log("✅ Sample IDs:", allowedKampungIds.slice(0, 5));
        console.log("✅ All IDs:", allowedKampungIds);
    } else {
        console.log("❌ No kampung IDs available");
    }
    console.log("===========================");

    // FIXED: Function to apply kampung filtering
    function applyKampungFiltering(mapLayer) {
        const kampungLayer = mapLayer.sublayers.find(layer => layer.id === 22);
        
        if (!kampungLayer) {
            console.warn('❌ Kampung layer (ID 22) not found');
            return;
        }

        console.log("🔍 Applying kampung filtering...");
        console.log("Kampung layer found:", kampungLayer.title);

        // Check if we have valid kampung IDs array
        if (allowedKampungIds && Array.isArray(allowedKampungIds) && allowedKampungIds.length > 0) {
            // Filter out empty/null/undefined values
            const validKampungIds = allowedKampungIds.filter(id => {
                return id !== null && id !== undefined && id !== '' && String(id).trim() !== '';
            });
            
            console.log("📊 Total IDs received:", allowedKampungIds.length);
            console.log("📊 Valid IDs after filtering:", validKampungIds.length);
            console.log("📊 Valid IDs sample:", validKampungIds.slice(0, 10));
            
            if (validKampungIds.length > 0) {
                // Create SQL IN clause with allowed kampung IDs
                const kampungFilter = validKampungIds.map(id => `'${String(id).trim()}'`).join(',');
                const definitionExpression = `ID_KG IN (${kampungFilter})`;
                
                // Apply the filter to the layer
                kampungLayer.definitionExpression = definitionExpression;
                kampungLayer.visible = true;
                
                console.log("✅ SUCCESS: Kampung layer filtered!");
                console.log("   - Filtered to:", validKampungIds.length, "kampung");
                console.log("   - Filter expression length:", definitionExpression.length);
                console.log("   - Expression preview:", definitionExpression.substring(0, 150) + "...");
                console.log("   - Layer visible:", kampungLayer.visible);
                
                // Test by logging a few sample filter parts
                console.log("   - Sample filter parts:", kampungFilter.split(',').slice(0, 5));
                
            } else {
                console.log("⚠️ All kampung IDs are empty - trying mukim fallback");
                
                // Try fallback filtering by mukim
                const fallbackExpression = `MUKIM = '${userMukim}' OR mukim_id = '${userMukim}' OR fk_mukim = '${userMukim}'`;
                kampungLayer.definitionExpression = fallbackExpression;
                kampungLayer.visible = true;
                
                console.log("   - Fallback expression:", fallbackExpression);
                console.log("   - Layer visible:", kampungLayer.visible);
            }
        } else {
            // No access or invalid data
            kampungLayer.definitionExpression = "1=0"; // Hide all features
            kampungLayer.visible = false;
            
            console.log("❌ No valid kampung access - layer hidden");
            console.log("   - Reason: allowedKampungIds is", typeof allowedKampungIds, "with length", allowedKampungIds?.length);
        }
        
        // Additional debug: Check if definition expression was applied
        console.log("🔍 Final layer state:");
        console.log("   - Definition Expression:", kampungLayer.definitionExpression);
        console.log("   - Visible:", kampungLayer.visible);
        console.log("   - Opacity:", kampungLayer.opacity);
    }

    async function debugGISFieldNames(mapLayer) {
    console.log("🔍 DEBUGGING GIS LAYER FIELD NAMES AND VALUES");
    
    const kampungLayer = mapLayer.sublayers.find(layer => layer.id === 22);
    if (!kampungLayer) {
        console.log("❌ Kampung layer not found");
        return;
    }
    
    try {
        // Query the kampung layer to see actual field names and values
        const query = kampungLayer.createQuery();
        query.where = "1=1"; // Get all features
        query.outFields = ["*"]; // Get all fields
        query.returnGeometry = false;
        query.num = 100; // Limit to first 20 records for debugging
        
        console.log("📡 Querying GIS layer for field names and sample data...");
        
        const results = await kampungLayer.queryFeatures(query);
        
        console.log("📊 GIS Query Results:");
        console.log("   - Total features found:", results.features.length);
        
        if (results.features.length > 0) {
            // Show field names
            const firstFeature = results.features[0];
            const fieldNames = Object.keys(firstFeature.attributes);
            
            console.log("🏷️ Available field names in GIS layer:");
            fieldNames.forEach(field => {
                console.log(`   - ${field}`);
            });
            
            // Show sample data for potential ID fields
            console.log("🔍 Sample values for potential ID fields:");
            
            const potentialIdFields = fieldNames.filter(field => 
                field.toLowerCase().includes('id') || 
                field.toLowerCase().includes('kg') ||
                field.toLowerCase().includes('kampung') ||
                field.toLowerCase().includes('kod')
            );
            
            console.log("🎯 Potential ID fields found:", potentialIdFields);
            
            // Show first 5 records for each potential ID field
            results.features.slice(0, 5).forEach((feature, index) => {
                console.log(`📝 Record ${index + 1}:`);
                potentialIdFields.forEach(field => {
                    console.log(`   ${field}: "${feature.attributes[field]}"`);
                });
                console.log("---");
            });
            
            // Check if our expected kampung IDs exist in any field
            console.log("🔍 Checking if our database IDs exist in GIS data:");
            const ourKampungIds = ['080403001','080403002','080403003','080403004','080403005','080403006','080403007','080403008','080403009'];
            
            potentialIdFields.forEach(field => {
                console.log(`🔍 Checking field: ${field}`);
                const fieldValues = results.features.map(f => String(f.attributes[field] || '').trim());
                const matches = ourKampungIds.filter(ourId => fieldValues.includes(ourId));
                console.log(`   - Matches found: ${matches.length}/${ourKampungIds.length}`);
                if (matches.length > 0) {
                    console.log(`   - Matching values: ${matches.join(', ')}`);
                }
            });
            
            // Test different filter expressions
            console.log("🧪 Testing alternative filter expressions:");
            
            // Test with different field names
            const testFields = ['ID_KG', 'IdKampung', 'IdKampungBaru', 'IDKAMPUNG', 'id_kg', 'kod_kampung', 'KOD_KAMPUNG'];
            
            for (const testField of testFields) {
                if (fieldNames.includes(testField)) {
                    const testQuery = kampungLayer.createQuery();
                    testQuery.where = `${testField} IN ('080403001','080403002','080403003')`;
                    testQuery.returnCountOnly = true;
                    
                    try {
                        const testResult = await kampungLayer.queryFeatures(testQuery);
                        console.log(`   - ${testField}: ${testResult.features.length} matches`);
                    } catch (error) {
                        console.log(`   - ${testField}: Query failed - ${error.message}`);
                    }
                }
            }
            
        } else {
            console.log("❌ No features found in kampung layer");
        }
        
    } catch (error) {
        console.error("❌ Error debugging GIS layer:", error);
    }
}

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
                }
            ]
        };

        const urlGis = "{{ env('URL_GIS') }}";
        urlMukimGis = urlGis.replace("VARMAP","{{ $kampungdata->mukim->url_gis}}");
         //console.log(urlMukimGis);

        const mapLayer = new MapImageLayer({
            url: urlMukimGis,
            sublayers: [

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
                    id: 20,
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
                    id: 23,
                    title: "Sempadan Pilihanraya (Parlimen)",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content: "<table>" +
                            "<tr> " +
                            "<td>Parlimen</td> " +
                            "<td>: </td> " +
                            "<td>{NAM}</td> " +
                            "</tr> " +
                            "</table>"
                    },
                }, 
                 {
                    id: 24,
                    title: "Sempadan Pilihanraya (Dun)",
                    visible: false,
                    popupTemplate: {
                        title: "{NAM}",
                        content: "<table>" +
                            "<tr> " +
                            "<td>Dun</td> " +
                            "<td>: </td> " +
                            "<td>{NAM}</td> " +
                            "</tr> " +
                            "</table>"
                    },
                },
               
                {
                    id: 26,
                    title: "Sempadan Daerah",
                    visible: true,
                    popupTemplate: {
                        title: "{KODDAERAH}",
                        content: "<table>" +
                            "<tr> " +
                            "<td>Daerah</td> " +
                            "<td>: </td> " +
                            "<td>{KODDAERAH}</td> " +
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
                        content: "<table>" +
                            "<tr> " +
                            "<td>Mukim</td> " +
                            "<td>: </td> " +
                            "<td>{MUKIM}</td> " +
                            "</tr> " +
                            "</table>"
                    },
                },
                 {
                    id: 22,
                    title: "Sempadan Kampung Negeri Perak",
                    visible: true,
                    opacity: 0.5,
                    renderer: renderer,
                    popupTemplate: {
                        title: "{nama} {id_kg}",
                        content: getData,
                        fieldInfos: [{
                                fieldName: "{nama}"
                            },
                            {
                                fieldName: "{id_kg}"
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
let pointGraphicsArray = []; //Edit 20/8/2025

<?php
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
pointGraphicsArray.push(pointGraphic);
//console.log(view.zoom);
<?php
}
?>

function togglePointsVisibility() {
    const currentZoom = view.zoom;
    
    if (currentZoom >= 13) {
        // Show points when zoom level is 16 or higher
        pointGraphicsArray.forEach(graphic => {
            if (!view.graphics.includes(graphic)) {
                view.graphics.add(graphic);
            }
        });
    } else {
        // Hide points when zoom level is below 16
        pointGraphicsArray.forEach(graphic => {
            view.graphics.remove(graphic);
        });
    }
}

        view.when(() => {
            console.log("🎯 Map view loaded - applying kampung filtering...");
            
            try {
                applyKampungFiltering(mapLayer);
                togglePointsVisibility();
                
                console.log("✅ Map initialization complete!");
                console.log(`📊 User "${userMukim}" has access to ${allowedKampungIds ? allowedKampungIds.length : 0} kampung`);
                
                // ADD THIS: Debug GIS field names after a short delay
                setTimeout(() => {
                    debugGISFieldNames(mapLayer);
                }, 3000);
                
            } catch (error) {
                console.error('❌ Error during map initialization:', error);
            }
        });

// ALSO ADD THIS FUNCTION TO TEST DIFFERENT FIELD NAMES MANUALLY
// You can call this from the browser console: testDifferentFieldNames()

window.testDifferentFieldNames = async function() {
    console.log("🧪 MANUAL FIELD NAME TESTING");
    
    const kampungLayer = mapLayer.sublayers.find(layer => layer.id === 22);
    const testIds = ['080403001','080403002','080403003'];
    
    // List of possible field names to test
    const possibleFieldNames = [
        'ID_KG', 'IdKampung', 'IdKampungBaru', 'IDKAMPUNG', 'id_kg', 
        'kod_kampung', 'KOD_KAMPUNG', 'KAMPUNG_ID', 'kampung_id',
        'ID_KAMPUNG', 'KodKampung', 'kodkampung', 'KODKAMPUNG',
        'OBJECTID', 'FID', 'kampung_code', 'KAMPUNG_CODE'
    ];
    
    console.log("Testing field names:", possibleFieldNames);
    
    for (const fieldName of possibleFieldNames) {
        try {
            const testExpression = `${fieldName} IN ('${testIds.join("','")}')`;
            kampungLayer.definitionExpression = testExpression;
            
            // Wait a moment for the layer to update
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            // Check if any features are visible now
            const query = kampungLayer.createQuery();
            query.where = "1=1";
            query.returnCountOnly = true;
            
            const result = await kampungLayer.queryFeatures(query);
            
            console.log(`✅ ${fieldName}: ${result.features.length} features visible`);
            
            if (result.features.length > 0) {
                console.log(`🎯 FOUND WORKING FIELD: ${fieldName}`);
                console.log(`   Expression: ${testExpression}`);
                return fieldName; // Return the working field name
            }
            
        } catch (error) {
            console.log(`❌ ${fieldName}: Failed - ${error.message}`);
        }
    }
    
    console.log("❌ No working field name found");
    
    // Reset to original expression
    const originalExpression = "ID_KG IN ('080403001','080403002','080403003','080403004','080403005','080403006','080403007','080403008','080403009', '080803002')";
    kampungLayer.definitionExpression = originalExpression;
    
    return null;
};
    

        /*****************************************************************
                             END KETUA ISI RUMAH
        *****************************************************************/


        view.ui.add([searchWidget, bgExpand, bgExpand2, bgExpand3], "top-right");

    });

    function getData(feature) {
        //console.log(feature.graphic.attributes);
        var data = {!! $datagis !!};
        //console.log({!!json_encode($datagis)!!});
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
        // console.log("sini meeyyyy");
        var leng_legend = $(".esri-legend__service .esri-legend__layer-table").length;
        // console.log(leng_legend);

        var html_legend = "";

        for(var i = 0; i < leng_legend; i++){
            var icon = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-cell--symbols').html();
            var name = $(".esri-legend__service .esri-legend__layer-table").eq(i).find('.esri-legend__layer-caption').html();
            var firsticon = '<i class="circle icon" style="color: rgb(188, 26, 183);"></i>Ketua Isi Rumah';


            // console.log("\n");
            // console.log(icon);
            // console.log("\n");
            // console.log(name);
            // console.log("\n");

            if(i == 0){
                html_legend = '<div>' + firsticon + '</div>' + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }else{
                html_legend = html_legend + "," + '<div>' + icon + '</div>' + '<div>' + name + '</div>';
            }
            // console.log(html_legend);
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
