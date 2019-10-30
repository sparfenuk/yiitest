<?php

namespace app\commands;

use app\controllers\SocketController;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

class SocketStartController extends  Controller
{
    public function actionIndex()
    {
        require dirname(__DIR__) . '/vendor/autoload.php';

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketController()
                )
            ),
            \Yii::$app->params['WSPort']
        );
        $server->run();
    }
}