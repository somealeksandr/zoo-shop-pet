FROM php:8.2.1-fpm

# Install system dependencies
RUN apt-get -y update && apt-get install -y

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

COPY docker/php/conf.d/* $PHP_INI_DIR/conf.d

# Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["php-fpm"]
