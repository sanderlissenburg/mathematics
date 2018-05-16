FROM php:7.2.5-fpm

RUN docker-php-ext-install opcache

RUN apt-get update && apt-get install -y \
    git \
    zlib1g-dev \
    && apt-get clean

RUN docker-php-ext-install \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY /docker/php-fpm/php.ini $PHP_INI_DIR

WORKDIR /var/www/html
