<?php


namespace app\controllers;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketController implements MessageComponentInterface {

    private $userId;
    private $productId;

    public function onOpen(ConnectionInterface $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo json_decode($msg);
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}