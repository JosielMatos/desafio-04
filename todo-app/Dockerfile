FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY ./public /var/www/html
COPY ./src /var/www/src

WORKDIR /var/www/html
