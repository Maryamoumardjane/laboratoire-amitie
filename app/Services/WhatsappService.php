<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    /**
     * Envoie une notification WhatsApp via un template approuvé par Meta
     */
    public static function sendTemplate(string $to, string $template, array $params): bool
    {
        $token         = env('WHATSAPP_TOKEN');
        $phoneNumberId = env('WHATSAPP_PHONE_NUMBER_ID');

        $components = [
            [
                'type'       => 'body',
                'parameters' => array_map(fn($p) => [
                    'type' => 'text',
                    'text' => $p,
                ], $params),
            ]
        ];

        try {
            $http = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json']);

            if (app()->environment('local')) {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->post(
                "https://graph.facebook.com/v19.0/{$phoneNumberId}/messages",
                [
                    'messaging_product' => 'whatsapp',
                    'to'                => self::formatNumber($to),
                    'type'              => 'template',
                    'template'          => [
                        'name'       => $template,
                        'language'   => ['code' => 'fr'],
                        'components' => $components,
                    ],
                ]
            );

            Log::info('WhatsApp HTTP Status : ' . $response->status());
            Log::info('WhatsApp Response    : ' . $response->body());

            if ($response->successful() && isset($response->json()['messages'])) {
                Log::info("WhatsApp template '{$template}' envoyé avec succès à : $to");
                return true;
            }

            // Si le template échoue → essayer en message texte libre
            // (fonctionne si le patient nous a écrit dans les 24h)
            Log::warning("Template échoué, tentative message texte libre...");
            return self::sendText($to, implode("\n", $params));

        } catch (\Exception $e) {
            Log::error('Erreur WhatsApp: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoie un message texte libre
     * Fonctionne si le patient a envoyé un message dans les 24h
     */
    public static function sendText(string $to, string $message): bool
    {
        $token         = env('WHATSAPP_TOKEN');
        $phoneNumberId = env('WHATSAPP_PHONE_NUMBER_ID');

        try {
            $http = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json']);

            if (app()->environment('local')) {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->post(
                "https://graph.facebook.com/v19.0/{$phoneNumberId}/messages",
                [
                    'messaging_product' => 'whatsapp',
                    'to'                => self::formatNumber($to),
                    'type'              => 'text',
                    'text'              => ['body' => $message],
                ]
            );

            Log::info('WhatsApp Text Status : ' . $response->status());
            Log::info('WhatsApp Text Body   : ' . $response->body());

            if ($response->successful() && isset($response->json()['messages'])) {
                Log::info("WhatsApp texte envoyé avec succès à : $to");
                return true;
            }

            Log::warning("WhatsApp texte non envoyé à $to : " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error('Erreur WhatsApp texte: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Formate le numéro (Meta attend le numéro sans +)
     */
    private static function formatNumber(string $number): string
    {
        $number = preg_replace('/\s+/', '', $number);
        $number = ltrim($number, '+');

        if (strlen($number) === 9) {
            return '237' . $number;
        }

        return $number;
    }
}