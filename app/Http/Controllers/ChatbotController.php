<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function askAI(Request $request)
    {
        // PENTING: Padam sebarang ralat teks yang bocor dari server
        if (ob_get_length()) ob_clean();

        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        try {
            // URL v1beta dengan model flash 1.5
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

            $response = Http::withoutVerifying()
                ->timeout(60)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($apiUrl, [
                    'contents' => [
                        ['parts' => [['text' => $userMessage]]]
                    ]
                ]);

            if ($response->successful()) {
                $result = $response->json();
                $aiReply = data_get($result, 'candidates.0.content.parts.0.text', 'Maaf, jawapan tidak ditemui.');
                
                // Balas secara manual untuk elak isu JSON invalid
                header('Content-Type: application/json');
                echo json_encode(['reply' => $aiReply]);
                exit;
            }

            header('Content-Type: application/json', true, 500);
            echo json_encode(['reply' => 'AI Response Error: ' . $response->status()]);
            exit;

        } catch (\Exception $e) {
            Log::error("Chatbot Error: " . $e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['reply' => 'Server Error: ' . $e->getMessage()]);
            exit;
        }
    }
}