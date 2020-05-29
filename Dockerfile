FROM php:7.4-apache

RUN apt-get update \
    && apt-get install -y \
        git \
        zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN docker-php-ext-install \
        pdo_mysql \
        mysqli \
    && a2enmod headers rewrite

COPY .conf/php.ini.develop /usr/local/etc/php/conf.d/001-develop.ini
COPY .conf/apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /app