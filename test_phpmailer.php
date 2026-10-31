<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'laboratoiredelamitier4@gmail.com';
$mail->Password   = 'hxplldkpaqabktyt';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;
$mail->SMTPDebug  = 2; // Affiche tous les détails
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
];

$mail->setFrom('laboratoiredelamitier4@gmail.com', 'Test');
$mail->addAddress('laboratoiredelamitier4@gmail.com');
$mail->Subject = 'Test';
$mail->Body    = 'Test';

try {
    $mail->send();
    echo "SUCCES !" . PHP_EOL;
} catch (Exception $e) {
    echo "ERREUR: " . $mail->ErrorInfo . PHP_EOL;
}