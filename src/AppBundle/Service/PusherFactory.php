<?php

namespace AppBundle\Service;

use Pusher\Pusher;

class PusherFactory
{
    public static function createPusher($id, $key, $secret)
    {
        return new Pusher($key, $secret, $id, [
            'cluster' => 'us2',
            'encrypted' => true,
        ]);
    }
}
