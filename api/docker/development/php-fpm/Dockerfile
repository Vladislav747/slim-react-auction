FROM php:7.4-fpm-alpine

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
# shell script внутри php:7.4-fpm-apline
RUN docker-php-ext-install opache

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /app

COPY ./ ./

RUN composer install --no-dev --prefer-dist --no-progress --no-suggest --no-scripts --optimize-autoloader \
    && rm -rf /root/.composer/cache
