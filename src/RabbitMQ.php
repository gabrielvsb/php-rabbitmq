<?php

namespace src;

use mysql_xdevapi\Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class RabbitMQ
{
    public $connection;
    public $channel;

    public function __construct()
    {
        if (is_null($this->connection)) {
            $this->connection = new AMQPStreamConnection(
                $_ENV['RABBITMQ_HOST'],
                $_ENV['RABBITMQ_PORT'],
                $_ENV['RABBITMQ_USER'],
                $_ENV['RABBITMQ_PASSWORD'],
                $_ENV['RABBITMQ_VHOST']
            );

            $this->channel = $this->connection->channel();
        }
    }

    public function enviar($routing_key, $msg): void
    {
        $this->channel->queue_declare($routing_key, false, true, false, false);

        $properties = [
            'content_type' => 'application/json',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ];
        $objMsg = new AMQPMessage($msg, $properties);

        $this->channel->basic_publish($objMsg, '', $routing_key);
    }

    public function receber($routing_key, $callback)
    {
        $this->channel->queue_declare($routing_key, false, true, false, false);
        $this->channel->basic_consume($routing_key, '', false, false, false, false, $callback);
        try {
            $this->channel->consume();
        } catch (\Throwable $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function desconectar(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

}