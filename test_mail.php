<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;

// Créer le stream avec le bon hôte
$stream = new SocketStream();
$stream->setHost('smtp.gmail.com');
$stream->setPort(465);
$stream->setStreamOptions([
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
]);

$transport = new EsmtpTransport('smtp.gmail.com', 465, true);
$transport->setUsername('laboratoiredelamitier4@gmail.com');
$transport->setPassword('hxplldkpaqabktyt');

// Injecter le stream patché
$ref = new ReflectionClass($transport);
$parent = $ref->getParentClass();
$streamProp = $parent->getProperty('stream');
$streamProp->setAccessible(true);
$streamProp->setValue($transport, $stream);

echo "Hôte: " . $transport->getStream()->getHost() . PHP_EOL;
echo "Port: " . $transport->getStream()->getPort() . PHP_EOL;

$mailer = new Mailer($transport);

$email = (new Email())
    ->from('laboratoiredelamitier4@gmail.com')
    ->to('laboratoiredelamitier4@gmail.com')
    ->subject('Test')
    ->text('Test envoi Gmail');

try {
    $mailer->send($email);
    echo "EMAIL ENVOYE AVEC SUCCES !" . PHP_EOL;
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . PHP_EOL;
}