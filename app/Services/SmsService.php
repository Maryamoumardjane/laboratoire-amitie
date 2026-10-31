<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public static function send(string $to, string $message): bool
    {
        $username = env('AT_USERNAME');
        $apiKey   = env('AT_API_KEY');

        $isSandbox = $username === 'sandbox';
        $baseUrl   = $isSandbox
            ? 'https://api.sandbox.africastalking.com/version1/messaging'
            : 'https://api.africastalking.com/version1/messaging';

        try {
            $http = Http::asForm()
                ->withHeaders([
                    'apiKey' => $apiKey,
                    'Accept' => 'application/json',
                ]);

            if (app()->environment('local')) {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->post($baseUrl, [
                'username' => $username,
                'to'       => self::formatNumber($to),
                'message'  => $message,
            ]);

            // ── DEBUG : logguer la réponse brute complète ──
            Log::info('AT HTTP Status : ' . $response->status());
            Log::info('AT Raw Body    : ' . $response->body());

            $data = $response->json();
            Log::info('AT JSON parsed : ' . json_encode($data));

            $recipients = $data['SMSMessageData']['Recipients'] ?? [];
            if (!empty($recipients) && ($recipients[0]['status'] ?? '') === 'Success') {
                Log::info("SMS envoyé avec succès à : $to");
                return true;
            }

            Log::warning("SMS non envoyé à $to : " . json_encode($data));
            return false;

        } catch (\Exception $e) {
            Log::error('Erreur envoi SMS: ' . $e->getMessage());
            return false;
        }
    }

    private static function formatNumber(string $number): string
    {
        $number = preg_replace('/\s+/', '', $number);
        if (str_starts_with($number, '+'))  return $number;
        if (str_starts_with($number, '237')) return '+' . $number;
        if (strlen($number) === 9)           return '+237' . $number;
        return $number;
    }
}