<?php

require './src/util.php';

$opcoes = [
    '1 - Realizar pedido',
    '2 - Sair'
];

$opcoesPedido = [
    '1 - Hamburguer',
    '2 - Pizza',
    '2 - Cachorro-quente',
];

$sair = false;

while(!$sair){
    limparTerminal();
    echo "\nMenu:\n";
    foreach ($opcoes as $opcao) {
        echo $opcao . "\n";
    }

    $selecao = readline("Selecione uma opção: ");

    switch($selecao) {
        case '1':
            limparTerminal();
            echo "Menu de Comidas:\n";
            foreach ($opcoesPedido as $comida) {
                echo $comida . "\n";
            }

            echo "Selecione uma comida: ";
            $selecao_comida = trim(fgets(STDIN));

            switch ($selecao_comida) {
                case '1':
                    $comida_escolhida = 'Pizza';
                    break;
                case '2':
                    $comida_escolhida = 'Hambúrguer';
                    break;
                case '3':
                    $comida_escolhida = 'Salada';
                    break;
                default:
                    echo "Opção inválida. Voltando ao menu principal.\n";
                    sleep(2);
                    break 2;
            }

            echo "Digite seu e-mail: ";
            $email = trim(fgets(STDIN));

            echo "Pedido realizado com sucesso!\n";
            echo "Comida escolhida: $comida_escolhida\n";
            echo "E-mail: $email\n";
            echo "Estamos enviando seu pedido...";

            $arrEnvio = [
                'pedido' => $comida_escolhida,
                'email' => $email,
                'data_hora' => date("Y-m-d H:i:s")
            ];

            $rabbitmq = new \src\RabbitMQ();
            $rabbitmq->enviar('pedidos', json_encode($arrEnvio));
            $rabbitmq->desconectar();
            echo "Pressione Enter para continuar...";
            fgets(STDIN);
            break;
        case '2':
            echo "Saindo...\n";
            $sair = true;
            break;
        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
}

echo "Obrigado pelo seu pedido.\n";
