FROM php:8.0-fpm-alpine

RUN apk --update --no-cache add git

RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ;  php-fpm

EXPOSE 9000