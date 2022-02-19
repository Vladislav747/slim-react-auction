FROM php:7.4-cli-alpine

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

WORKDIR /app

COPY ./ ./
