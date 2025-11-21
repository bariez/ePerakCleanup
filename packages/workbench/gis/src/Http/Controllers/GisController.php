<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Daerah; 
use App\Models\User; 

class GisController extends Controller
{
    /**
     * Method untuk memulangkan View utama Dashboard GIS.
     * Ini dipanggil oleh route gis.index.
     */
    public function index()
    {
        // Memulangkan View utama yang akan memuatkan komponen peta
        return view('gis.index'); 
    }
    
    /**
     * Method baru untuk memulangkan View yang mengandungi kod peta JavaScript ArcGIS.
     * View ini akan dipanggil oleh AJAX dari indexlocation.blade.php melalui route /location/ajaxindex.
     */
    public function ajaxMapContent()
    {
        // View ini akan mengandungi kod JavaScript ArcGIS yang telah kita bincangkan.
        return view('gis.gis_map_content'); 
    }

    /**
     * Mengambil sempadan (boundary) Daerah dan Bounding Box (Bbox) dalam format JSON.
     * Digunakan oleh frontend untuk melakukan zoom.
     */
    public function getDaerahBoundary($daerahId)
    {
        // Dapatkan data daerah termasuk lajur spatial/GeoJSON
        // Kami menganggap lajur 'boundary_geojson' menyimpan GeoJSON atau Bbox yang dikodkan.
        $daerah = Daerah::where('id', $daerahId)->first(['id', 'NamaDaerah', 'boundary_geojson', 'geom']);

        if (!$daerah) {
            // Fallback ke Bbox seluruh Perak jika ID Daerah tiada/salah
            return response()->json([
                'error' => 'Sempadan daerah tidak ditemui',
                'xmin' => 100.8, 'ymin' => 3.7, 'xmax' => 102.0, 'ymax' => 5.8 
            ]);
        }
        
        // --- LOGIK POSTGIS/BBOX SEBENAR ---
        $response = [
            'id' => $daerah->id,
            'NamaDaerah' => $daerah->NamaDaerah,
            'geoJson' => json_decode($daerah->boundary_geojson ?? '{}'), // Jika GeoJSON disimpan sebagai string
        ];

        // Contoh: Menggunakan koordinat Bbox jika disimpan berasingan atau dikira dari geom (PostGIS)
        try {
            // Anggap anda ada lajur 'bbox' di DB (cth: "100.8,4.0,101.5,5.0")
            if (property_exists($daerah, 'bbox_coords')) {
                 list($xmin, $ymin, $xmax, $ymax) = explode(',', $daerah->bbox_coords);
                 $response['xmin'] = (float)$xmin;
                 $response['ymin'] = (float)$ymin;
                 $response['xmax'] = (float)$xmax;
                 $response['ymax'] = (float)$ymax;
            } else {
                // FALLBACK SAMPLE BBOX (Gantikan dengan data Daerah sebenar)
                $sampleBboxes = [
                    1 => ['xmin' => 100.75, 'ymin' => 4.0, 'xmax' => 101.4, 'ymax' => 4.9], // Manjung Sample
                    // Tambah Daerah lain di sini...
                ];
                $bbox = $sampleBboxes[$daerahId] ?? ['xmin' => 100.8, 'ymin' => 4.0, 'xmax' => 101.5, 'ymax' => 5.0];
                $response = array_merge($response, $bbox);
            }
        } catch (\Throwable $th) {
             // Jika parsing Bbox gagal, guna nilai fallback
             $response = array_merge($response, ['xmin' => 100.8, 'ymin' => 4.0, 'xmax' => 101.5, 'ymax' => 5.0]);
        }
        
        return response()->json($response);
    }

    /**
     * Mengambil data petempatan (contoh: kampung) yang terhad kepada Daerah tersebut.
     */
    public function getDataByDaerah($daerahId)
    {
        // Sila pastikan query ini mengembalikan data dalam format GeoJSON 
        // untuk GeoJSONLayer ArcGIS API.
        $data = DB::table('kampung')
            ->where('daerah_id', $daerahId)
            // Anda MESTI menambah lajur koordinat/geom di sini
            ->get();
            
        // Jika data ini adalah array objek biasa, anda perlu ubah kepada GeoJSON.
        return response()->json($data); 
    }

    /**
     * Mendapatkan ID Daerah untuk pengguna yang sedang log masuk (DO).
     */
    public function getCurrentUserDaerahId()
    {
        // Ini adalah method yang dipanggil di gis_map_content.blade.php
        $user = Auth::user();
        
        return $user->daerah_id ?? 0;
    }
}