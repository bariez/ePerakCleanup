<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Pastikan ini ada

class MaklumbalasController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'nama' => 'required|string|max:150',
            'emel' => 'required|email|max:100',
            'rating' => 'required',
        ]);

        try {
            // 2. Simpan ke database
            DB::table('maklumbalas')->insert([
                'nama'            => $request->nama,
                'emel'            => $request->emel,
                'rating'          => $request->rating,
                'komen_cadangan'  => $request->komen_cadangan,
                'tarikh'          => Carbon::now()->toDateTimeString(), // Format: 2026-01-06 11:04:35
            ]);

            return back()->with('success', 'Terima kasih! Maklum balas anda telah diterima.');

        } catch (\Exception $e) {
            // Log ralat untuk rujukan developer (storage/logs/laravel.log)
            \Log::error("Ralat simpan maklumbalas: " . $e->getMessage());

            // Tunjukkan mesej ralat yang mesra pengguna
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan maklum balas. Sila cuba lagi.']);
        }
    }
}