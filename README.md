# RabbitMQ com PHP
Este reposítório contem um exemplo simples de um aplicação que utiliza o rabbitmq para envio de pedidos.

## Configuração
Tenha certeza que voê tenha o docker instalado, e rode o seguinte comando no terminal:

```docker-compose up --build -d```


## Gerenciando RabbitMQ
Entre no plugin gerenciador do rabbitmq, utilizando a URL:

```http://localhost:15672```

Neste ambiente será possível criar a fila ``pedidos`` que será usada pela aplicação. É possível criar e gerenciar usuários, filas, exchanges entre outras opções disponíveis no rabbitmq. Consulte a documentação neste [link](https://www.rabbitmq.com/docs/management).

## Rodando a aplicação
### Producer
Após essas configurações, é possível rodar a aplicação utilizando o comando no 
terminal ``php worker.php``, dentro da pasta de instalação. Execute quantos _workers_ achar necessário

### Consumer
Execute o consumer utilizando o comando no terminal ```php realizar_pedido.php```, dentro da pasta de instalação.
