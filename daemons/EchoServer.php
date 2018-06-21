<?php
namespace app\daemons;

use consik\yii2websocket\events\WSClientMessageEvent;
use consik\yii2websocket\WebSocketServer;

class EchoServer extends WebSocketServer
{

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_MESSAGE, function (WSClientMessageEvent $e) {
        	$msg = $e->message;
        	echo $msg;
            $e->client->send( $msg .'pp');
        });
    }

}