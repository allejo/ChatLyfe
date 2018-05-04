<?php

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;
use Pusher\Pusher;

class PusherFactory
{
    public static function createPusher($id, $key, $secret, LoggerInterface $logger)
    {
        $pusher = new Pusher($key, $secret, $id, [
            'cluster' => 'us2',
            'encrypted' => true,
        ]);

        $pusher->setLogger($logger);

        return $pusher;
    }
}
