FROM php:7.2-fpm-alpine

WORKDIR /var/www

RUN apk add --update --no-cache \
libpng \
libpng-dev \
libzip-dev \
unzip

RUN docker-php-ext-install pdo pdo_mysql gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN adduser -D -u 1000 -G www-data www

USER www