<?php

require_once __DIR__ . '/vendor/autoload.php';

echo " [*] Aguardando pedidos.\n";

$callback = function ($msg) {
    $pedido = json_decode($msg->getBody());
    echo ' [x] Pedido recebido em: ', $pedido['data_hora'], "\n";
    echo ' [x] Comida: ', $pedido['comida'], "\n";
    echo ' [x] Email: ', $pedido['email'], "\n";
};

$rabbitmq = new \src\RabbitMQ();
try {
    $rabbitmq->receber('pedidos', $callback);
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}

$rabbitmq->desconectar();