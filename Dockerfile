FROM dunglas/frankenphp:php8.2-bookworm

RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

ENV SERVER_NAME=":8080"
ENV FRANKENPHP_CONFIG="worker ./public/index.php"

EXPOSE 8080

RUN printf '#!/bin/sh\nset -e\nphp artisan migrate --force\nexec frankenphp run --config /etc/caddy/Caddyfile\n' > /start.sh \
    && chmod +x /start.sh

CMD ["/start.sh"]