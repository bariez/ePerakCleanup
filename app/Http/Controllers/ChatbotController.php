<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function askAI(Request $request)
    {
        $userMessage = $request->input('message');

        try {
            // PENTING: Gantikan KUNCI_API_ANDA dengan API Key sebenar dari Google AI Studio
            $apiKey = config('services.gemini.key'); // Cara terbaik: Simpan dalam .env
            
            // Jika anda belum setup config, boleh guna env terus sementara waktu:
            // $apiKey = env('GEMINI_API_KEY');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . env('GEMINI_API_KEY'), [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Anda adalah pembantu AI Portal e-Perak/PerakGIS yang pintar dan mesra. Jawab soalan ini dalam Bahasa Melayu: " . $userMessage]
                        ]
                    ]
                ]
            ]);

            $result = $response->json();
            
            // Ambil teks jawapan daripada struktur JSON Gemini
            $aiReply = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat memproses jawapan buat masa ini.';

            return response()->json(['reply' => $aiReply]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Ralat teknikal: Pelayan AI tidak memberi respons.'], 500);
        }
    }
}