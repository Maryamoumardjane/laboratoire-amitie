<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public static function send(string $to, string $subject, string $htmlBody): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            // ✅ Utilise le host depuis .env au lieu d'une IP codée en dur
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = env('MAIL_PORT', 465);
            $mail->CharSet    = 'UTF-8';

            // ✅ Active le mode debug temporairement pour voir l'erreur exacte dans les logs
            $mail->SMTPDebug  = 2; // 0 = off, 2 = détails utiles
            $mail->Debugoutput = function ($str, $level) {
                \Log::info("PHPMailer [$level]: $str");
            };

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ];

            // Intégrer le logo comme image CID
            $logoPath = public_path('images/logo.jpg');
            if (file_exists($logoPath)) {
                $mail->addEmbeddedImage($logoPath, 'logo_laboratoire', 'logo.jpg');
            }

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addReplyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = strip_tags($htmlBody);

            $mail->send();
            \Log::info("Email envoyé avec succès à : $to");
            return true;

        } catch (Exception $e) {
            \Log::error('PHPMailer erreur: ' . $mail->ErrorInfo);
            return false;
        }
    }
}