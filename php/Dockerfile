FROM php:8.0-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libpng-dev libldap2-dev libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql gd \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu \
    && docker-php-ext-install ldap

WORKDIR /var/www/project

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# && pecl install redis  \
# && docker-php-ext-enable redis \
# ENV TZ Europe/Warsaw
# RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
