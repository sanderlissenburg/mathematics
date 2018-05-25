FROM php:7.2.5-fpm

RUN docker-php-ext-install opcache

COPY . /var/www/html

WORKDIR /var/www/html
