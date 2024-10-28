# PHP Container
FROM php:8.2 AS php

RUN apt-get update -y && \
    apt-get install -y unzip libpq-dev libcurl4-gnutls-dev && \
    docker-php-ext-install pdo pdo_mysql bcmath && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT [ "docker/entrypoint.sh" ]

# Node Container
FROM node:14-alpine AS node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env && \
    npm install

VOLUME /var/www/node_modules
