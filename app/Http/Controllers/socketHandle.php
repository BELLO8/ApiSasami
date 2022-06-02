<?php

namespace App\Http\Controllers;


use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

use Ratchet\MessageInterface;


class MyCustomWebSocketHandler implements MessageComponentInterface
{

    public function onOpen(ConnectionInterface $connection)
    {
        // TODO: Implement onOpen() method.
    }

    public function onClose(ConnectionInterface $connection)
    {
        // TODO: Implement onClose() method.
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    public function onMessage(ConnectionInterface $connection, $msg)
    {
        // TODO: Implement onMessage() method.

    }

}
