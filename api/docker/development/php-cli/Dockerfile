FROM php:7.4-fpm-alpine

RUN apk add --no-cache unzip

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

##Чтобы composer не ругался
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
&& rm -rf /root/.composer/cache

WORKDIR /app
