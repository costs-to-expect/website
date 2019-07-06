FROM php:7.3-apache

COPY . /.docker/app/php
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /.docker/app/php

RUN docker-php-ext-install bcmath \
    && chown -R www-data:www-data /.docker/app/php \
    && a2enmod rewrite
