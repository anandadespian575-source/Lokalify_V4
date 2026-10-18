<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\ConnectionException;

class GeminiController extends Controller
{
    /**
     * Mengirim pertanyaan pengguna ke Gemini melalui backend Laravel.
     * API key tidak dikirim ke browser.
     */
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = trim((string) config('services.gemini.api_key'));

        if ($apiKey === '') {
            return response()->json([
                'message' => 'API key Gemini belum dikonfigurasi. Periksa GEMINI_API_KEY di file .env.',
            ], 500);
        }

        $model = 'gemini-3.8-flash';

        $prompt = implode("\n", [
            'Kamu adalah Lokalify AI Assistant, asisten pariwisata untuk platform Lokalify di Indonesia.',
            'Bantu pengguna mencari destinasi wisata lokal, menyusun itinerary, memberi tips perjalanan, dan menjelaskan hal terkait pariwisata.',
            'Jawab dalam Bahasa Indonesia dengan ramah, ringkas, dan informatif.',
            'Jangan mengarang harga, jam buka, lokasi, atau kondisi terkini yang tidak kamu ketahui.',
            'Jika informasi tidak tersedia, jelaskan bahwa pengguna perlu memeriksanya kembali.',
            'Pertanyaan pengguna: ' . $validated['message'],
        ]);

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 800,
            ],
        ];

        // Maksimal 3 percobaan, hanya untuk error sementara.
        $maxAttempts = 3;
        $response = null;

        try {
            for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                $response = Http::acceptJson()
                    ->asJson()
                    ->withQueryParameters([
                        'key' => $apiKey,
                    ])
                    ->connectTimeout(10)
                    ->timeout(35)
                    ->post($url, $payload);

                $status = $response->status();

                // Berhasil atau error permanen: tidak perlu mengulang.
                if (
                    $response->successful()
                    || !in_array($status, [429, 503], true)
                ) {
                    break;
                }

                // Catat status tanpa mencatat API key.
                Log::warning('Gemini temporary error.', [
                    'status' => $status,
                    'attempt' => $attempt,
                    'max_attempts' => $maxAttempts,
                    'model' => $model,
                ]);

                if ($attempt < $maxAttempts) {
                    // Jeda 1,5 detik, lalu 3 detik.
                    usleep(1500000 * $attempt);
                }
            }

            if ($response === null) {
                return response()->json([
                    'message' => 'Gemini belum memberikan respons. Silakan coba lagi.',
                ], 502);
            }

            if (!$response->successful()) {
                $status = $response->status();

                $providerMessage = (string) data_get(
                    $response->json(),
                    'error.message',
                    'Unknown Gemini API error'
                );

                Log::warning('Gemini API request failed.', [
                    'status' => $status,
                    'provider_message' => $providerMessage,
                    'model' => $model,
                ]);

                if (in_array($status, [400, 401, 403], true)) {
                    return response()->json([
                        'message' => 'Permintaan Gemini ditolak. Periksa API key, akses model, dan konfigurasi project Google AI Studio.',
                    ], 502);
                }

                if ($status === 404) {
                    return response()->json([
                        'message' => 'Model Gemini tidak ditemukan atau tidak tersedia. Periksa nama model dan aksesnya di Google AI Studio.',
                    ], 502);
                }

                if ($status === 429) {
                    return response()->json([
                        'message' => 'Batas permintaan Gemini tercapai. Tunggu sebentar lalu coba lagi.',
                    ], 429);
                }

                if ($status === 503) {
                    return response()->json([
                        'message' => 'Layanan Gemini sedang sibuk. Silakan tunggu sebentar lalu coba lagi.',
                    ], 503);
                }

                return response()->json([
                    'message' => 'Layanan Gemini sedang bermasalah. Coba lagi beberapa saat lagi.',
                ], 502);
            }

            $data = $response->json();

            $reply = data_get(
                $data,
                'candidates.0.content.parts.0.text'
            );

            if (!is_string($reply) || trim($reply) === '') {
                Log::warning('Gemini API returned no text.', [
                    'finish_reason' => data_get(
                        $data,
                        'candidates.0.finishReason'
                    ),
                    'response_feedback' => data_get(
                        $data,
                        'promptFeedback.blockReason'
                    ),
                ]);

                return response()->json([
                    'message' => 'Gemini tidak memberikan jawaban teks. Coba ubah pertanyaanmu.',
                ], 502);
            }

            return response()->json([
                'reply' => trim($reply),
            ]);
        } catch (ConnectionException $exception) {
            Log::error('Gemini API connection failed.', [
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Server tidak dapat terhubung ke Gemini. Periksa koneksi internet server lalu coba lagi.',
            ], 502);
        } catch (\Throwable $exception) {
            Log::error('Unexpected Lokalify AI error.', [
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan pada server AI. Periksa log Laravel untuk detailnya.',
            ], 500);
        }
    }
}
