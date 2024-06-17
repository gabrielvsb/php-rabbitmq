FROM ubuntu:latest

FROM php:7.4-apache
LABEL authors="Gabriel Barbosa"

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get install -y librabbitmq-dev && \
    pecl install amqp && \
    docker-php-ext-enable amqp && \
    docker-php-ext-install sockets

COPY . /var/www/html/

WORKDIR /var/www/html

RUN composer install

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80