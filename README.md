# RabbitMQ com PHP
Este repos�t�rio contem um exemplo simples de um aplica��o que utiliza o rabbitmq para envio de pedidos.

## Configura��o
Tenha certeza que vo� tenha o docker instalado, e rode o seguinte comando no terminal:

```docker-compose up --build -d```


## Gerenciando RabbitMQ
Entre no plugin gerenciador do rabbitmq, utilizando a URL:

```http://localhost:15672```

Neste ambiente ser� poss�vel criar a fila ``pedidos`` que ser� usada pela aplica��o. � poss�vel criar e gerenciar usu�rios, filas, exchanges entre outras op��es dispon�veis no rabbitmq. Consulte a documenta��o neste [link](https://www.rabbitmq.com/docs/management).

## Rodando a aplica��o
### Producer
Ap�s essas configura��es, � poss�vel rodar a aplica��o utilizando o comando no 
terminal ``php worker.php``, dentro da pasta de instala��o. Execute quantos _workers_ achar necess�rio

### Consumer
Execute o consumer utilizando o comando no terminal ```php realizar_pedido.php```, dentro da pasta de instala��o.
