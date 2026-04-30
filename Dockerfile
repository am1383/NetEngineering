FROM php:8.3-fpm-alpine AS build

RUN apk add --no-cache \
    git \
    unzip \
    zip \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

RUN docker-php-ext-configure gd \
    --with-jpeg \
    --with-freetype \
    && docker-php-ext-install \
    pdo_mysql \
    gd \
    mbstring \
    zip \
    bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


FROM php:8.3-fpm-alpine

WORKDIR /var/www

COPY . .
COPY --from=build /var/www/vendor ./vendor

RUN chown -R www-data:www-data /var/www

USER www-data

CMD ["php-fpm"]
