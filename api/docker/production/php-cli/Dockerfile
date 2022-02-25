FROM php:7.4-fpm-alpine as builder

RUN apk add --no-cache unzip

##Чтобы composer не ругался
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
&& rm -rf /root/.composer/cache

WORKDIR /app

COPY ./composer.json ./composer.lock ./

RUN composer install --no-dev --prefer-dist --no-progress --no-suggest --no-scripts --optimize-autoloader \
    && rm -rf /root/.composer/cache
#Вот это команда ниже не кешируется остальное кешируется
COPY ./ ./


######
FROM php:7.4-fpm-alpine

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /app

COPY --from=builder /app ./

COPY ./ ./
