<?php
$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
]);
$sock = stream_socket_client(
    'ssl://smtp.gmail.com:465',
    $errno, $errstr, 30,
    STREAM_CLIENT_CONNECT, $context
);
if ($sock) {
    echo 'CONNEXION SSL OK' . PHP_EOL;
} else {
    echo 'ERREUR: ' . $errstr . PHP_EOL;
}