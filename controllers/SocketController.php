<?php


namespace app\controllers;


use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;

class SocketController implements WampServerInterface {

   protected $clients;

    /**
     * SocketController constructor.
     * @param $clients
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        $from->send($data['prodId']);
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }

    /**
     * An RPC call has been received
     * @param \Ratchet\ConnectionInterface $conn
     * @param string $id The unique ID of the RPC, required to respond to
     * @param string|Topic $topic The topic to execute the call against
     * @param array $params Call parameters received from the client
     */
    function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // TODO: Implement onCall() method.
    }

    /**
     * A client is attempting to publish content to a subscribed connections on a URI
     * @param \Ratchet\ConnectionInterface $conn
     * @param string|Topic $topic The topic the user has attempted to publish to
     * @param string $event Payload of the publish
     * @param array $exclude A list of session IDs the message should be excluded from (blacklist)
     * @param array $eligible A list of session Ids the message should be send to (whitelist)
     */
    function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // TODO: Implement onPublish() method.
    }
}