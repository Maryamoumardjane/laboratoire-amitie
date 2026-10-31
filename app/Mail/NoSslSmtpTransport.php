<?php

namespace App\Mail;

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;

class NoSslSmtpTransport extends EsmtpTransport
{
    public function __construct(string $host, int $port, bool $tls)
    {
        parent::__construct($host, $port, $tls);

        // Récupère le stream existant et change ses options SSL
        $stream = $this->getStream();
        if ($stream instanceof SocketStream) {
            $stream->setHost($host);
            $stream->setPort($port);
            $stream->setStreamOptions([
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ]);
        }
    }
}