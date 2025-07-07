FROM php:8.2-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    git curl libpq-dev unzip zip \
    && docker-php-ext-install pdo pdo_pgsql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www