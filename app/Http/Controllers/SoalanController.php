<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SoalanController extends Controller
{

    public function postSoalanSaveAdd(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
            'queue'    => 'required|numeric', // Mesti nombor untuk elakkan ralat 'Conversion failed'
            'status'   => 'required',
        ]);

        try {
            DB::table('faq')->insert([
                'Soalan'  => $request->question,
                'Jawapan' => $request->answer,
                'Susunan' => (int)$request->queue, // Paksa ke integer untuk SQL Server
                'Status'  => $request->status,
            ]);

            return redirect('/site/soalan/index')->with('status', 'Data berjaya disimpan!');

        } catch (\Exception $e) {
            // Log ralat untuk rujukan teknikal
            Log::error("Gagal Simpan FAQ: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal Simpan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            // Semak dan padam daripada jadual 'faq'
            $deleted = DB::table('faq')->where('id', $id)->delete();

            if ($deleted) {
                return back()->with('status', 'Soalan telah berjaya dipadamkan.');
            } else {
                return back()->with('error', 'Gagal memadam. Rekod tidak dijumpai.');
            }

        } catch (\Exception $e) {
            // Log ralat jika berlaku ralat SQL
            Log::error("Gagal Padam FAQ (ID: $id): " . $e->getMessage());
            return back()->with('error', 'Ralat Database: ' . $e->getMessage());
        }
    } 
} // 