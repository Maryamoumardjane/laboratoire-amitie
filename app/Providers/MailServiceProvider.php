<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;

class MailServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['mail.manager']->extend('smtp', function () {

            $stream = new SocketStream();
            $stream->setStreamOptions([
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ]);

            $transport = new EsmtpTransport(
                host: config('mail.mailers.smtp.host'),
                port: (int) config('mail.mailers.smtp.port'),
                tls: false,
            );

            $transport->setStream($stream);
            $transport->setUsername(config('mail.mailers.smtp.username'));
            $transport->setPassword(config('mail.mailers.smtp.password'));

            return $transport;
        });
    }
}