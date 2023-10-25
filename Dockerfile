FROM php:8.2-apache

RUN a2enmod rewrite && docker-php-ext-install mysqli

COPY ./app /var/www/html/