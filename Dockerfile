# PHP 8.5 CLI
FROM php:8.5-cli

# Система пакетлари ва PHP kengaytmalari
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Composer ўрнатиш
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel ишчи директория
WORKDIR /var/www/html

# Кодни контейнерга кўчириш
COPY . .

# Composer пакети ўрнатиш
RUN composer install --no-dev --optimize-autoloader

# Порт ва PHP artisan serve
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]